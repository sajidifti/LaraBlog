<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function slugify($title)
    {
        return Str::slug($title, '-');
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($post) {
            if (empty($post->slug)) {
                $post->slug = $post->slugify($post->title);
            }
        });
    }
}
