<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $pathViewController = 'frontend.pages.home.'; 

    public function index()
    {
        $items = Category::with('posts')
            ->where('status', 'active')
            ->get();  

        return view($this->pathViewController . 'index', compact('items'));
    }
}
?>