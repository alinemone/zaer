<?php

use Morilog\Jalali\Jalalian;
use \App\Models\ProvinceCity;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

if (!function_exists('get_cities')) {
    /**
     * Return a collection from the Cities.
     *
     * @param mixed $value
     * @return Collection
     */
    function get_cities(int $parentId): Collection
    {
        return Cache::rememberForever('cities-' . $parentId, function () use ($parentId) {
            return ProvinceCity::where(ProvinceCity::PARENT, $parentId)->pluck('id', 'title');
        });
    }
}

if (!function_exists('get_provinces')) {
    /**
     * Return a collection from the Cities.
     *
     * @param mixed $value
     * @return Collection
     */
    function get_provinces(): Collection
    {
        return Cache::rememberForever('provinces', function () {
            return ProvinceCity::where(ProvinceCity::PARENT, 0)->pluck('id', 'title');
        });
    }
}

if (!function_exists('get_degrees')) {
    /**
     * Return a collection from the Cities.
     *
     * @param mixed $value
     * @return Collection
     */
    function get_degrees(): Collection
    {
        return Cache::rememberForever('degree', function () {
            return config('degree');
        });

    }
}

if (!function_exists('jalali_to_carbon')) {

    function jalali_to_carbon($jalaliDate)
    {
        $jalaliDate = explode('/', $jalaliDate);

        return (new Jalalian($jalaliDate[0], $jalaliDate[1], $jalaliDate[2]))
            ->toCarbon();
    }
}

if (!function_exists('getSetting')) {

    function getSetting($key)
    {
        $setting = \App\Models\setting::where('key', $key)->first();

        return $setting->value;
    }
}

if (!function_exists('getProvinceCity')) {

    function getProvinceCity($key)
    {
        return Cache::rememberForever('provinceCity-' . (int)$key, function () use ($key) {
            $provinceCity = \App\Models\ProvinceCity::where('id', (int)$key)->first();

            return $provinceCity->title;
        });
    }
}

if (!function_exists('getTitleDegree')) {

    function getTitleDegree($key)
    {
        return config('degree')[$key];
    }
}


if (!function_exists('Jaygah')) {

    function Jaygah($reception)
    {
        $place = $reception->place->id;
        $room = $reception->room->id;
        $bed = $reception->bed->id;


        if ($place < 10) {
            $place = 0 . $place;
        }

        if ($room < 10) {
            $room = 0 . $room;
        }

        if ($bed < 10) {
            $bed = 0 . $bed;
        }

        return $place . $room . $bed;
    }


}
