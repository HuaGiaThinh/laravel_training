<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category as MainModel;   

class CategoryController extends Controller
{
    private $pathViewController = 'frontend.pages.category.';
    private $params             = [];
    private $model;

    public function __construct()
    {
        $this->model = new MainModel();
    }

    public function index(Request $request)
    {   
        $item = $this->model::with('posts')->find($request->category_id);  

        if(empty($item))  return redirect()->route('home');
        return view($this->pathViewController . 'index', compact('item'));
    }

 
}