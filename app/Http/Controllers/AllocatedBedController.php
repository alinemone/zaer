<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bed;
use App\Models\People;
use App\Models\Servant;
use App\Enumerations\Gender;
use App\Models\AllocatedBed;
use App\Providers\BedIsClearanced;
use Illuminate\Support\Facades\Auth;
use App\Providers\ReserveIsSuccessfully;
use App\Http\Requests\AllocatedToPersonRequest;
use App\Http\Requests\UpdateAllocatedBedRequest;
use App\Repositories\Reseption\ReseptionReposiroryInterface;

class AllocatedBedController extends Controller
{
    public function getFreeRooms($gender)
    {

        /** @var ReseptionReposiroryInterface $repository */
        $repository = app(ReseptionReposiroryInterface::class);
        $places = $repository->getFreeBeds($gender);
        $provinces = get_provinces();
        $degrees = get_degrees();

        return view('admin.reception.reception-create', compact('places', 'provinces', 'degrees'));
    }

    public function allocateBedToPerson(AllocatedToPersonRequest $request, $gender)
    {
        if ($request->type == 1) {
            try {
                $people = People::updateOrCreate(
                    [
                        People::NATIONAL_CODE => $request->national_code
                    ],
                    [
                        'name_family'   => $request->name_family,
                        'national_code' => $request->national_code,
                        'mobile'        => $request->mobile,
                        'birthday'      => $request->birthday,
                        'gender'        => Gender::getGenderEnum($gender),
                        'country'       => $request->country,
                        'province'      => $request->province,
                        'city'          => $request->city,
                        'degree'        => $request->degree,
                        'job'           => $request->job,
                        'how_to'        => $request->how_to,
                    ]
                );

                $allocatedBed = AllocatedBed::create([
                    AllocatedBed::PLACE_ID    => $request->place,
                    AllocatedBed::ROOM_ID     => $request->room,
                    AllocatedBed::BED_ID      => $request->bed,
                    AllocatedBed::PEOPLE_ID   => $people->{People::ID},
                    AllocatedBed::PEOPLE_TYPE => $request->type == 2 ? Servant::class : People::class,
                    AllocatedBed::START_AT    => $request->start_at ?? Carbon::now(),
                    AllocatedBed::EXPIRED_AT  => $request->expired_at ?? Carbon::now()->addDays(getSetting('days_reserve')),
                    AllocatedBed::CREATED_BY  => Auth::id(),
                ]);

                return redirect()->route('admin.reception.cart', $allocatedBed);
            } catch (\Exception $exception) {

                alert()->error(__('messages.allocated_bed.error'));

                return back();
            }
        } else {

            try {

                $people = Servant::where(Servant::NATIONAL_CODE, request()->post('national_code'))->first();

                if (is_null($people)) {
                    alert()->error(__('messages.servant.not_find'));
                }

                if (!is_null($request->referrer_user)) {
                    $allocatedBed = AllocatedBed::where(AllocatedBed::PEOPLE_ID, $request->referrer_user)
                        ->where(AllocatedBed::PEOPLE_TYPE, Servant::class)
                        ->first();

                    $people_use_quota = AllocatedBed::where(AllocatedBed::REFERRER_USER, $request->referrer_user)
                        ->where(AllocatedBed::PEOPLE_TYPE, Servant::class)
                        ->get();

                    if (!is_null($allocatedBed)) {
                        $start = Carbon::parse($allocatedBed->{AllocatedBed::START_AT});
                        $expire = Carbon::parse($allocatedBed->{AllocatedBed::EXPIRED_AT});
                        $allAllowDays = $start->diffInDays($expire);

                        if (!empty($people_use_quota)) {
                            $useDay = null;
                            foreach ($people_use_quota as $people) {
                                $start = Carbon::parse($people->{AllocatedBed::START_AT});
                                $expire = Carbon::parse($people->{AllocatedBed::EXPIRED_AT});
                                $useDay += $start->diffInDays($expire);
                            }
                        }

                        if (!is_null($useDay)) {
                            $allAllowDays += $useDay;
                        }

                        $allow_days = $people->quota - $allAllowDays;

                        if ($allow_days > 0) {

                            $start_request = Carbon::parse(request()->post('start_at', Carbon::now()));
                            $expire_request = Carbon::parse(request()->post('expired_at', Carbon::now()->addDays(getSetting('servant_capacity'))));

                            $days_stay = $start_request->diffInDays($expire_request);

                            if ($allow_days < $days_stay) {

                                alert()->error('تعداد سهمیه مجاز شما ' . $allow_days . ' روز است اما شما درحال رزور ' . $days_stay . ' روز هستید!');

                                return back();
                            }
                        }

                        if ($allow_days <= 0) {
                            alert()->error('تعداد سهمیه مجاز شما اتمام رسیده اشت');

                            return back();
                        }

                    }
                }

                $allocatedBed = AllocatedBed::create([
                    AllocatedBed::PLACE_ID      => request()->post('place'),
                    AllocatedBed::ROOM_ID       => request()->post('room'),
                    AllocatedBed::BED_ID        => request()->post('bed'),
                    AllocatedBed::REFERRER_USER => request()->post('referrer_user', null),
                    AllocatedBed::PEOPLE_ID     => $people->id,
                    AllocatedBed::PEOPLE_TYPE   => Servant::class,
                    AllocatedBed::START_AT      => request()->post('start_at', Carbon::now()),
                    AllocatedBed::EXPIRED_AT    => request()->post('expired_at', Carbon::now()->addDays(getSetting('servant_capacity'))),
                    AllocatedBed::CREATED_BY    => Auth::id(),
                ]);

                if ($allocatedBed) {
                    event(new ReserveIsSuccessfully($allocatedBed));
                }

                return redirect()->route('admin.reception.cart', $allocatedBed);
            } catch (\Exception $exception) {
                alert()->error(__('messages.allocated_bed.error'));

                return back();
            }
        }
    }

    public function receptionCart(AllocatedBed $reception)
    {
        $reception = $reception->load(['place', 'people', 'room', 'bed', 'servant']);

        $text = route('admin.reception.check', $reception->{AllocatedBed::ID});

        return view('admin.reception.cart', compact('reception', 'text'));
    }


    public function receptionCheck(AllocatedBed $reception)
    {
        $reception = $reception->load(['place', 'people', 'room', 'bed']);

        return view('admin.reception.check', compact('reception'));
    }

    public function receptionClearance(AllocatedBed $reception)
    {
        try {
            $reception->delete();

            event(new BedIsClearanced($reception));

            alert()->success(__('messages.allocated_bed.clearance'));

            return back();
        } catch (\Exception $exception) {

        }

    }

    public function receptionEdit($receptionId)
    {
        $reception = AllocatedBed::where(AllocatedBed::ID, $receptionId)
            ->with(['people', 'place', 'bed'])
            ->first();

        $provinces = get_provinces();
        $degrees = get_degrees();
        $gender = $reception->people->{People::GENDER} ? 'male' : 'female';
        $places = $this->getFreeBeds($gender, [$reception->bed->{Bed::ID}]);

        return view('admin.reception.reception-edit',
            compact('reception', 'provinces', 'degrees', 'places'));
    }

    public function receptionList()
    {
        $receptions = AllocatedBed::with([
            'place',
            'room',
            'bed',
            'people',
            'servant'

        ])
            ->orderByDesc('id')
            ->paginate();

        return view('admin.reception.accepted', compact('receptions'));

    }


    public function updateReception(UpdateAllocatedBedRequest $request)
    {
//        dd($request->all());
    }
}
