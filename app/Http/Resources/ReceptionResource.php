<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReceptionResource extends JsonResource
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
            'id'          => $this->id,
            'people_name' => $this->people->name . ' ' . $this->people->family,
            'created_at'  => $this->created_at,
            'expired_at'  => $this->expired_at,
        ];
    }
}
