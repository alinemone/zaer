<?php

namespace App\Http\Controllers;

use App\Models\AllocatedBed;
use App\Models\Bed;
use App\Models\Room;
use App\Models\Group;
use App\Models\Place;
use App\Models\People;
use App\Enumerations\Gender;
use App\Http\Requests\Group\GroupRequest;
use App\Repositories\Reseption\ReseptionReposiroryInterface;
use App\Rules\BedIsAllocatingToPerson;
use App\Rules\BedIsNotAllocated;
use App\Rules\CheckExpiredAtTime;
use App\Rules\CheckStartAtTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $groups = Group::paginate(24);

        return view('admin.group.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('admin.group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(GroupRequest $request)
    {
        group::create([
            Group::TITLE        => $request->{Group::TITLE},
            Group::OWNER_NAME   => $request->{Group::OWNER_NAME},
            Group::OWNER_MOBILE => $request->{Group::OWNER_MOBILE},
        ]);

        alert()->success('کاروان با موفقیت ایجاد شد');

        return redirect(route('admin.group.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function reception($gender)
    {
        /** @var ReseptionReposiroryInterface $repository */
        $repository = app(ReseptionReposiroryInterface::class);
        $places = $repository->getFreeBeds($gender);

        return view('admin.group.reception', compact('places'));
    }


    public function createReception(Request $request, $gender)
    {
        // Find the Group Member
        $groupMembers = Group::find($request->group_id)
            ->people()
            ->where(People::GENDER, Gender::getGenderEnum($gender))
            ->get();

        // Check has free beds per each person.
        $beds = $this->getFreeBeds($gender);

        if ($beds->count() < $groupMembers->count()) {

            alert()->error('ظرفیت کافی برای این کاروان در تاریخ انتخابی وجود ندارد.');

            return back();
        }

        $index = 0;

        foreach ($groupMembers as $member) {
            $request->merge($member->toArray())
                ->merge([
                    'type'  => 1,
                    'place' => $beds[$index]->room->{Room::PLACE_ID},
                    'room'  => $beds[$index]->{Bed::ROOM_ID},
                    'bed'   => $beds[$index]->{Bed::ID}
                ]);

            // Assign the bed to a person
            $this->allocateBedToPerson($request, $gender);

            $index++;
        }

        alert()->success('رزرو کاروان با موفقیت انجام شد.');

        return redirect(route('admin.group.member.index', $request->group_id));
    }


    /**
     * @param $gender
     * @return mixed
     */
    private function getFreeBeds($gender)
    {
        $startAt = jalali_to_carbon(request()->post('start_at'));
        if (is_null($startAt)) {
            $startAt = !is_null(request()->old('start_at')) ? jalali_to_carbon(request()->old('start_at')) : now();
        }

        $expiredAt = jalali_to_carbon(request()->post('expired_at'));
        if (is_null($expiredAt)) {
            $expiredAt = !is_null(request()->old('expired_at')) ? jalali_to_carbon(request()->old('expired_at')) :
                now()->addDays(config('reception.default_period'));
        }

        return Bed::WhereNotIn(Bed::ID, function ($query) use ($startAt, $expiredAt) {
            $query->select('bed_id')->from('allocated_beds')
                ->whereBetWeen(AllocatedBed::START_AT, [$startAt, $expiredAt])
                ->orWhereBetWeen(AllocatedBed::EXPIRED_AT, [$startAt, $expiredAt]);
        })->with(['room.place' => function ($query) use ($gender) {
            return $query->where(Place::GENDER_TYPE, $gender);
        }])
            ->get();
    }

    private function allocateBedToPerson(Request $request, $gender)
    {
        $validator = Validator::make($request->all(), [
            'id'         => ['nullable', 'integer', new BedIsAllocatingToPerson()],
            'bed'        => ['required', 'integer', new BedIsNotAllocated()],
            'start_at'   => ['required', 'date', new CheckStartAtTime()],
            'expired_at' => ['required', 'date', new CheckExpiredAtTime()],
        ]);

        if ($validator->fails()) {
            return;
        }

        AllocatedBed::create([
            AllocatedBed::PLACE_ID    => $request->place,
            AllocatedBed::ROOM_ID     => $request->room,
            AllocatedBed::BED_ID      => $request->bed,
            AllocatedBed::PEOPLE_ID   => $request->id,
            AllocatedBed::PEOPLE_TYPE => People::class,
            AllocatedBed::START_AT    => $request->start_at ?? Carbon::now(),
            AllocatedBed::EXPIRED_AT  => $request->expired_at ?? Carbon::now()->addDays(getSetting('days_reserve')),
            AllocatedBed::CREATED_BY  => Auth::id(),
        ]);
    }
}
