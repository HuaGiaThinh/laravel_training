<?php

namespace App\Helpers;
use Illuminate\Support\Str;

class URL
{
    public static function linkCategory($id, $name) 
    {
        return route('categories.index', [
            'id'   => $id, 
            'name' => Str::slug($name) 
        ]);
    }

    public static function linkPost($id, $name) 
    {
        return route('posts.index', [
            'id'   => $id, 
            'name' => Str::slug($name) 
        ]);

    }
}