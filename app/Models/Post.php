<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public static function search($keyword)
    {
        return static::query()
                    ->where('title', 'LIKE', "%$keyword%");
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
