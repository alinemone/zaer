<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bed extends Model
{
    use SoftDeletes;

    protected $table = 'beds';

    const ID = 'id';
    const BED_NUMBER = 'bed_number';
    const ROOM_ID = 'room_id';
    const ASSIGNED = 'assigned';
    const IS_ACTIVE = 'is_active';


    protected $fillable = [
        self::BED_NUMBER,
        self::ROOM_ID,
        self::ASSIGNED,
        self::IS_ACTIVE,
    ];

    protected $casts = [
        self::ASSIGNED  => 'bool',
        self::IS_ACTIVE => 'bool',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('isActive', function (Builder $builder) {
            $builder->where('beds.' . self::IS_ACTIVE, true);
        });
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function allocatedBed()
    {
        return $this->hasOne(AllocatedBed::class);
    }
}
