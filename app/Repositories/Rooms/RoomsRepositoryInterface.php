<?php


namespace App\Repositories\Rooms;


interface RoomsRepositoryInterface
{
    public function allRoomsPlace($place);

    public function createRoom($data);

    public function getRoom($roomId);

    public function updateRoom($data,$placeId,$roomId);
}
