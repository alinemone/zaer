<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Place extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'places';

    const ID = 'id';
    const NAME = 'name';
    const ADDRESS = 'address';
    const PHONE = 'phone';
    const FLOOR_COUNT = 'floor_count';
    const GENDER_TYPE = 'gender_type';
    const IS_ACTIVE = 'is_active';

    protected $fillable = [
        self::NAME,
        self::ADDRESS,
        self::PHONE,
        self::FLOOR_COUNT,
        self::GENDER_TYPE,
        self::IS_ACTIVE,
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('isActive', function (Builder $builder) {
            $builder->where('places.' . self::IS_ACTIVE, true);
        });
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function beds()
    {
        return $this->hasManyThrough(Bed::class, Room::class);
    }
}
