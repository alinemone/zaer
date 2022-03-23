<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class setting extends Model
{
    use HasFactory;

    const ID = 'id';
    const TITLE = 'title';
    const KEY = 'key';
    const VALUE = 'value';


    protected $fillable = [
        self::ID,
        self::TITLE,
        self::KEY,
        self::VALUE,
    ];
}
