<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\Room;
use App\Models\AllocatedBed;
use Illuminate\Http\Request;
use App\Http\Requests\Rooms\editRoomRequest;
use App\Http\Requests\Rooms\createRoomRequest;
use App\Repositories\Rooms\RoomsRepositoryInterface;
use App\Repositories\Places\PlacesRepositoryInterface;

class RoomController extends Controller
{

    public function placeRoomList($place)
    {
        /** @var RoomsRepositoryInterface $roomRepository */
        $roomRepository = app(RoomsRepositoryInterface::class);
        $rooms = $roomRepository->allRoomsPlace($place);

        /** @var PlacesRepositoryInterface $placeRepository */
        $placeRepository = app(PlacesRepositoryInterface::class);
        $placeName = $placeRepository->nameOfPlace($place);

        return view('admin.rooms.list', compact(['rooms', 'placeName']));
    }

    public function create()
    {
        return view('admin.rooms.create-room');
    }

    public function store(createRoomRequest $request)
    {
        /** @var RoomsRepositoryInterface $roomRepository */
        $roomRepository = app(RoomsRepositoryInterface::class);
        $roomRepository->createRoom($request->all());

        return redirect(route('admin.place.rooms.list', $request->place));
    }

    /**
     * @param $id
     */
    public function edit($placeId, $id)
    {
        /** @var RoomsRepositoryInterface $repository */
        $repository = app(RoomsRepositoryInterface::class);
        $room = $repository->getRoom($id);

        return view('admin.rooms.edit', compact('room'));
    }


    /**
     * @param \App\Http\Requests\Rooms\editRoomRequest $request
     * @param $id
     */
    public function update(editRoomRequest $request, $placeId, $roomId)
    {
        /** @var RoomsRepositoryInterface $repository */
        $repository = app(RoomsRepositoryInterface::class);
        $res = $repository->updateRoom($request->all(), $placeId, $roomId);

        if ($res == 0){
            alert()->success('با موفقیت به روزرسانی شد!');
        }else{
            alert()->error('این اتاق قابلیت غیرفعال سازی ندارد!');
        }

        return redirect(route('admin.place.rooms.list', $placeId));
    }

    /**
     * @param $id
     */
    public function delete($placeId, $roomId)
    {
        $room = Room::where(Room::ID, $roomId)
            ->with(['beds' => function ($query) {
                return $query->where(Bed::ASSIGNED, true);
            }])
            ->first();

        if ($room->beds->count() > 0) {
            alert()->error('برخی از تخت های این اتاق رزرو می‌باشد.');

            return redirect(route('admin.place.rooms.list', $placeId));
        }

        $room->delete();

        alert()->success('اتاق باموفقیت حذف شد');

        return redirect(route('admin.place.rooms.list', $placeId));
    }

    public function beds(Request $request, $id)
    {

        $start_at = jalali_to_carbon($request->get('start_at'));

        $expired_at = jalali_to_carbon($request->get('expired_at'));

        return Bed::whereNotIn(Bed::ID, function ($query) use ($start_at, $expired_at) {
            $query->select(AllocatedBed::BED_ID)->from('allocated_beds')
                ->whereBetween(AllocatedBed::START_AT, [$start_at, $expired_at])
                ->orWhereBetween(AllocatedBed::EXPIRED_AT, [$start_at, $expired_at]);
        })
            ->where(Bed::ROOM_ID, $id)
            ->get();
    }

    public function allbeds(Request $request, $id)
    {
        return Bed::where(Bed::ROOM_ID, $id)
            ->get();
    }

}
