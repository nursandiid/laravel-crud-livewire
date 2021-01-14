<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public static function search($keyword)
    {
        return static::query()
                    ->where('name', 'LIKE', "%$keyword%");
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
