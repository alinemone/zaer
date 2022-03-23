<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->register(ViewServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        if (app()->environment('local')) {
//            DB::listen(function ($query) {
//                File::append(
//                    storage_path('/logs/query.log'),
//                    $query->sql .
//                    ' [' . implode(', ', $query->bindings) . ']' . PHP_EOL
//                );
//            });
//        }
    }
}
