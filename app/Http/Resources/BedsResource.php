<?php

namespace App\Http\Resources;

use App\Models\Bed;
use App\Models\Place;
use App\Models\Room;
use Illuminate\Http\Resources\Json\JsonResource;

class BedsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->{Bed::ID},
            'name'        => $this->{Bed::BED_NUMBER},
            'room_id'     => $this->{Bed::ROOM_ID},
            'room_name'   => $this->room->{Room::TITLE},
            'palce_id'    => $this->room->place->{Place::ID},
            'place_title' => $this->room->place->{Place::NAME},
        ];
    }
}
