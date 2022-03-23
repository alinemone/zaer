<?php

namespace App\Http\Controllers;

use App\Models\AllocatedBed;
use App\Models\People;
use App\Models\Place;
use App\Models\Servant;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $places = Place::all();
        $provinces = get_provinces();
        $degrees = get_degrees();


        $allocated = AllocatedBed::selectRaw('
          allocated_beds.id,
          allocated_beds.start_at,
          allocated_beds.expired_at,
          allocated_beds.people_type,
          places.name,
          places.id as place_id,
          rooms.id as room_id,
          rooms.title as room_title,
          rooms.floor as room_floor,
          beds.id as bed_id,
          beds.bed_number,
          people.name_family,
          people.mobile,
          people.birthday,
          people.country,
          people.province,
          people.city,
          people.degree,
          servants.name_family as s_name_family,
          servants.mobile as s_mobile,
          servants.birthday as s_birthday,
          servants.country as s_country,
          servants.province as s_province,
          servants.city as s_city,
          servants.degree as s_degree

                ')
            ->join('places', 'places.id', 'allocated_beds.place_id')
            ->join('rooms', 'rooms.id', 'allocated_beds.room_id')
            ->join('beds', 'beds.id', 'allocated_beds.bed_id')
            ->leftJoin('people', function ($join) {
                $join->where('allocated_beds.people_type', People::class)
                    ->on('people.id', 'allocated_beds.people_id');
            })
            ->leftJoin('servants', function ($join) {
                $join->where('allocated_beds.people_type', Servant::class)
                    ->on('servants.id', 'allocated_beds.people_id');
            })
            ->Filter($request->all())
            ->get();

        return view('admin.report.index',compact('provinces','degrees','places','allocated'));
    }

}
