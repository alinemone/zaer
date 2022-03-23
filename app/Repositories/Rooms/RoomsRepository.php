<?php


namespace App\Repositories\Rooms;


use App\Events\Beds\CreateBedsEvent;
use App\Models\AllocatedBed;
use App\Models\Bed;
use App\Models\Room;

class RoomsRepository implements RoomsRepositoryInterface
{

    public function allRoomsPlace($place)
    {
        return Room::where(Room::PLACE_ID, $place)
            ->withCount(['beds' => function ($query) {
                return $query->withoutGlobalScope('isActive');
            }])
            ->withCount([
                'beds as beds_active' => function ($query) {
                    return $query->where(Bed::IS_ACTIVE, true);
                }])
            ->withCount(['beds as beds_disable' => function ($query) {
                return $query->where(Bed::IS_ACTIVE, false)
                    ->withoutGlobalScope('isActive');
            }])
            ->withoutGlobalScope('isActive')
            ->orderBy(Room::FLOOR)
            ->orderBy(Room::ID)
            ->paginate(24);
    }

    public function createRoom($data)
    {
        $room = Room::create($data);

        event(new CreateBedsEvent($data['capacity'], $room->id));
    }

    public function getRoom($roomId)
    {
        return Room::withoutGlobalScope('isActive')
            ->where(Room::ID, $roomId)
            ->first();
    }

    public function updateRoom($data, $placeId, $roomId)
    {
        $allocated = AllocatedBed::where(AllocatedBed::ROOM_ID,$roomId)->count();

        if ($allocated == 0){
             Room::where(Room::ID, $roomId)
                ->withoutGlobalScope('isActive')
                ->update([
                    'title'     => $data['title'],
                    'place_id'  => $placeId,
                    'floor'     => $data['floor'],
                    'is_active' => $data['is_active'],
                ]);
            return $allocated;
        }else{
            return $allocated;
        }
    }
}
