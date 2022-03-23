<?php


namespace App\Repositories\Beds;


use App\Models\Bed;

class BedsRepository implements BedsRepositoryInterface
{

    public function allBedsInRooms($roomId)
    {
        return Bed::where(Bed::ROOM_ID, $roomId)
            ->withoutGlobalScope('isActive')
            ->paginate(24);
    }

    public function createBed($data, $roomId)
    {
        return Bed::create([
            'room_id'    => $roomId,
            'bed_number' => $data['bed_number'],
            'assigned'   => $data['assigned'],
            'is_active'  => $data['is_active'],
        ]);
    }

    public function getBed($id)
    {
        return Bed::where(Bed::ID, $id)
            ->withoutGlobalScope('isActive')
            ->first();
    }

    public function updateBed($data, $roomId, $bedId)
    {
        return Bed::where(Bed::ID, $bedId)
            ->withoutGlobalScope('isActive')
            ->update([
                'room_id'    => $roomId,
                'bed_number' => $data['bed_number'],
                'assigned'   => $data['assigned'],
                'is_active'  => $data['is_active'],
            ]);
    }
}
