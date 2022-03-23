<?php

namespace App\Repositories\Places;

use App\Models\Bed;
use App\Models\Place;
use App\Models\Room;
use Illuminate\Support\Facades\DB;

class PlacesRepository implements PlacesRepositoryInterface
{

    public function allPlaces()
    {
        return Place::withCount(['rooms' => function ($query) {
            return $query->withoutGlobalScope('isActive');
        }])
            ->withCount(['rooms as rooms_active' => function ($query) {
                return $query->where(Room::IS_ACTIVE, true);
            }])
            ->withCount(['rooms as rooms_disable' => function ($query) {
                return $query->where(Room::IS_ACTIVE, false)
                    ->withoutGlobalScope('isActive');
            }])
            ->withCount(['beds as beds' => function ($query) {
                return $query->withoutGlobalScope('isActive');
            }])
            ->withCount(['beds as beds_active' => function ($query) {
                return $query->withoutGlobalScope('isActive')
                    ->whereRaw(DB::raw('rooms.is_active = true'))
                    ->whereRaw(DB::raw('beds.is_active = true'));
            }])
            ->withCount(['beds as beds_disable' => function ($query) {
                return $query->withoutGlobalScope('isActive')
                    ->whereRaw(DB::raw('rooms.is_active = false'))
                    ->orWhereRaw(DB::raw('beds.is_active = false'));
            }])
//            ->selectRaw('(select beds.id from beds left join allocated_beds ab on beds.id = ab.bed_id group by beds.id having max(expired_at) <= now() + interval 30 day or max(expired_at) is null) as allocating_beds')
            ->latest()
            ->paginate(24);
    }

    public function allPlacesWithRoom()
    {
        return Place::with(['rooms'])->get();
    }

    public function createPlaces($data)
    {
        return Place::create($data);
    }

    public function nameOfPlace($placeId)
    {
        $place = Place::where(Place::ID, $placeId)
            ->withoutGlobalScope('isActive')
            ->first();

        return $place['name'];
    }

    public function getPlace($placeId)
    {
        return Place::where(Place::ID, $placeId)
            ->withoutGlobalScope('isActive')
            ->first();
    }

    public function updatePlace($data, $id)
    {
        return Place::where(Place::ID, $id)
            ->withoutGlobalScope('isActive')
            ->update([
                'name'        => $data['name'],
                'address'     => $data['address'],
                'phone'       => $data['phone'],
                'floor_count' => $data['floor_count'],
                'gender_type' => $data['gender_type'],
                'is_active'   => $data['is_active']
            ]);
    }


}
