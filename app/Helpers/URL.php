<?php

namespace App\Helpers;
use Illuminate\Support\Str;

class URL
{
    public static function linkCategory($id, $name) 
    {
        return route('categories.index', [
            'category_id'   => $id, 
            'category_name' => Str::slug($name) 
        ]);

    }

    public static function linkPost($id, $name) 
    {
        return route('posts.index', [
            'post_id'   => $id, 
            'post_name' => Str::slug($name) 
        ]);

    }
}