<?php


namespace App\Repositories\Beds;


interface BedsRepositoryInterface
{
    public function allBedsInRooms($roomId);

    public function createBed($data,$roomId);

    public function getBed($id);

    public function updateBed($data,$roomId,$bedId);
}
