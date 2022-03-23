<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvinceCity extends Model
{
    const ID = 'id';
    const PARENT = 'parent';
    const TITLE = 'title';
    const SORT = 'sort';

    protected $fillable = [
        self::ID,
        self::PARENT,
        self::TITLE,
        self::SORT,
    ];
}
