<?php


namespace App\Repositories\Reseption;


use App\Enumerations\Gender;
use App\Models\AllocatedBed;
use App\Models\Bed;
use App\Models\Place;
use App\Models\Room;

class ReceptionRepository implements ReseptionReposiroryInterface
{

    public function getFreeBeds($gender, array $except = null)
    {
        $startAt = request()->post('start_at');
        if (is_null($startAt)) {
            $startAt = !is_null(request()->old('start_at')) ? jalali_to_carbon(request()->old('start_at')) : now();
        }

        $expiredAt = request()->post('expired_at');
        if (is_null($expiredAt)) {
            $expiredAt = !is_null(request()->old('expired_at')) ? jalali_to_carbon(request()->old('expired_at')) :
                now()->addDays(config('reception.default_period'));
        }

        if (request()->isJson()) {
            $startAt = jalali_to_carbon($startAt);
            $expiredAt = jalali_to_carbon($expiredAt);
        }

        return Place::with([
            'rooms'      => function ($query) {
                $query->orderBy(Room::FLOOR);
            },
            'rooms.beds' => function ($query) use ($startAt, $expiredAt, $except) {
                $query->WhereNotIn(Bed::ID, function ($query) use ($startAt, $expiredAt) {
                    $query->select('bed_id')->from('allocated_beds')
                        ->whereBetWeen(AllocatedBed::START_AT, [$startAt, $expiredAt])
                        ->orWhereBetWeen(AllocatedBed::EXPIRED_AT, [$startAt, $expiredAt]);
                })->when(!is_null($except), function ($query) use ($except) {
                    $query->orWhereIn(Bed::ID, $except);
                })
                    ->where(Bed::ASSIGNED,0);
            },
        ])
            ->where(Place::GENDER_TYPE, Gender::getGenderEnum($gender))
            ->get();
    }
}
