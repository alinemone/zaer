<?php


namespace App\Repositories\Places;


interface PlacesRepositoryInterface
{
    public function allPlaces();

    public function allPlacesWithRoom();

    public function createPlaces($data);

    public function nameOfPlace($placeId);

    public function getPlace($placeId);

    public function updatePlace($data,$id);
}
