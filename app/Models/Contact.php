<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function search($keyword)
    {
        return static::query()
                    ->where('name', 'LIKE', "%$keyword%");
    }
}
