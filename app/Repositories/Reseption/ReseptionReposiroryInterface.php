<?php


namespace App\Repositories\Reseption;


interface ReseptionReposiroryInterface
{
    public function getFreeBeds($gender, array $except = null);
}
