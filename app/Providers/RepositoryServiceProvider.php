<?php


namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Repositories\Beds\BedsRepository;
use App\Repositories\Rooms\RoomsRepository;
use App\Repositories\Places\PlacesRepository;
use App\Repositories\Beds\BedsRepositoryInterface;
use App\Repositories\Reseption\ReceptionRepository;
use App\Repositories\Rooms\RoomsRepositoryInterface;
use App\Repositories\Places\PlacesRepositoryInterface;
use App\Repositories\Reseption\ReseptionReposiroryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(PlacesRepositoryInterface::class, function () {
            return new PlacesRepository();
        });

        $this->app->singleton(RoomsRepositoryInterface::class, function () {
            return new RoomsRepository();
        });

        $this->app->singleton(BedsRepositoryInterface::class, function () {
            return new BedsRepository();
        });

        $this->app->singleton(ReseptionReposiroryInterface::class, function () {
            return new ReceptionRepository();
        });
    }

    public function provides()
    {
        return [
            PlacesRepositoryInterface::class
        ];
    }
}
