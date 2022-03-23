<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Room extends Model
{
    use SoftDeletes;

    protected $table = 'rooms';

    const ID = 'id';
    const TITLE = 'title';
    const PLACE_ID = 'place_id';
    const FLOOR = 'floor';
    const IS_ACTIVE = 'is_active';

    protected $fillable = [
        self::TITLE,
        self::PLACE_ID,
        self::FLOOR,
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
            $builder->where('rooms.' . self::IS_ACTIVE, true);
        });
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function beds()
    {
        return $this->hasMany(Bed::class);
    }

    public function AllocatedBeds()
    {
        return $this->hasMany(AllocatedBed::class);
    }
}
