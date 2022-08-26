<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostModel as MainModel;
use App\Http\Requests\PostRequest as MainRequest;
use Illuminate\Support\Facades\Config;
use App\Models\CategoryModel;

class PostController extends Controller
{
    private $params;

    public function __construct()
    {
        $this->pathView         = 'admin.pages.post';
        $this->controllerName   = 'post';
        $this->routeName        = 'posts';
        $this->model            = new MainModel();
        $this->params['pagination']['totalItemsPerPage'] = 5;
        view()->share('controllerName', $this->controllerName);
        view()->share('routeName', $this->routeName);
    }

    public function index(Request $request)
    {
        $this->params['filter']['status'] = $request->input('filter_status', 'all');

        $items = $this->model->listItems($this->params);
        $itemsStatusCount = $this->model->countItemsStatus($this->params);
        $categories = $this->getCategories();
        $params = $this->params;

        return view($this->pathView . '/index', compact('items', 'itemsStatusCount', 'params', 'categories'));
    }

    public function form(Request $request)
    {
        $item = null;
        if ($request->id) {
            $params['id'] = $request->id;
            $item = $this->model->getItem($params);
        }

        // get list categories
        $categories = $this->getCategories();

        return view($this->pathView . '/form', compact('item', 'categories'));
    }

    public function save(MainRequest $request)
    {
        $params = $request->all();

        $task = 'add-item';
        $notify = config('myConfig.notify.add');

        if ($params['id']) {
            $task = 'edit-item';
            $notify = config('myConfig.notify.edit');
        }

        $this->model->saveItem($params, ['task' => $task]);
        return redirect()->route($this->routeName)->with('notify', $notify);
    }

    public function getCategories()
    {
        $categories = new CategoryModel();
        $categories = $categories->listItems($this->params, ['task' => 'admin-list-categories-in-selectbox']);
        $categories = $categories->pluck('name_with_depth_no_root', 'id');
        unset($categories[1]);

        return $categories;
    }

    public function changeStatus(Request $request)
    {
        try {
            $params['status']   = $request->status;
            $params['id']       = $request->id;

            $result = $this->model->handleAjax($params, ['task' => 'change-status']);
        } catch (\Throwable $th) {
            return ['type' => 'error', 'message' => config('myConfig.notify.ajaxError')];
        }

        return [
            'type'      => 'success', 
            'message'   => config('myConfig.notify.status'), 
            'data'      => response()->json($result)
        ];
    }

    public function changeSelectBox(Request $request)
    {
        try {
            $params['category_id'] = $request->category_id;
            $params['id'] = $request->id;

            $this->model->handleAjax($params, ['task' => 'change-selectBox']);
        } catch (\Throwable $th) {
            return ['type' => 'error', 'message' => config('myConfig.notify.ajaxError')];
        }

        return ['type' => 'success', 'message' => config('myConfig.notify.category')];
    }

    public function delete(Request $request)
    {
        $this->model::where('id', $request->id)->delete();
        return redirect()->route($this->routeName)->with('notify', config('myConfig.notify.delete'));
    }
}
