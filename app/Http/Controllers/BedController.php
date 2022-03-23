<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Http\Requests\Beds\createBedRequest;
use App\Http\Requests\Beds\editBedsRequest;
use App\Models\Room;
use App\Repositories\Beds\BedsRepositoryInterface;

class BedController extends Controller
{
    public function RoomBedsList($placeId, $roomId)
    {
        /** @var BedsRepositoryInterface $repository */
        $repository = app(BedsRepositoryInterface::class);
        $beds = $repository->allBedsInRooms($roomId);

        $room = Room::where(Room::ID,$roomId)->first();

        return view('admin.beds.list', compact('beds','room'));
    }

    public function create(createBedRequest $request, $placeId, $roomId)
    {
        /** @var BedsRepositoryInterface $roomRepository */
        $roomRepository = app(BedsRepositoryInterface::class);
        $roomRepository->createBed($request->all(), $roomId);
        alert()->success('با موفقیت ایجاد شد!');
        return redirect(route('admin.place.rooms.beds.list', [$placeId, $roomId]));
    }

    /**
     * @param $id
     */
    public function edit($placeId, $roomId, $id)
    {
        /** @var BedsRepositoryInterface $repository */
        $repository = app(BedsRepositoryInterface::class);
        $bed = $repository->getBed($id);

        return view('admin.beds.edit', compact('bed'));
    }


    /**
     * @param \App\Http\Requests\Rooms\editRoomRequest $request
     * @param $id
     */
    public function update(editbEDSRequest $request, $placeId, $roomId, $bedId)
    {
        /** @var BedsRepositoryInterface $repository */
        $repository = app(BedsRepositoryInterface::class);
        $repository->updateBed($request->all(), $roomId, $bedId);

        alert()->success('با موفقیت به روزرسانی شد!');
        return redirect(route('admin.place.rooms.beds.list', [$placeId, $roomId]));
    }

    /**
     * @param $id
     */
    public function delete($placeId, $roomId, $bedId)
    {
       $bed = Bed::where(Bed::ID, $bedId)
            ->where(Bed::ASSIGNED,false)
            ->get();

       if ($bed->count() == 0){
           alert()->error('ممکن است تخت به فردی اختصاص یافته باشد.','تخت قابلیت حذف ندارد');
           return redirect(route('admin.place.rooms.beds.list', [$placeId, $roomId]));
       }
        alert()->success('باموفقیت حذف شد');
        return redirect(route('admin.place.rooms.beds.list', [$placeId, $roomId]));
    }
}
