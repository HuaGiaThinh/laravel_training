<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category as MainModel;
use App\Http\Requests\CategoryRequest as MainRequest;
use Illuminate\Support\Facades\Config;

class CategoryController extends Controller
{
    private $params;

    public function __construct()
    {
        $this->pathView         = 'admin.pages.category';
        $this->controllerName   = 'category';
        $this->routeName        = 'categories';
        $this->model            = new MainModel();
        $this->params['pagination']['totalItemsPerPage'] = 5;
        view()->share('controllerName', $this->controllerName);
        view()->share('routeName', $this->routeName);
    }
    
    public function index(Request $request)
    {
        // $test = $this->model::find(6)->posts;
        // dd($test->toArray());

        $items = $this->model->listItems($this->params, ['task' => 'admin-list-items']);
        $params = $this->params;
        return view($this->pathView . '/index', compact('items', 'params'));
    }

    public function form(Request $request)
    {
        $item       = null;
        $itemParent = null;
        if ($request->id) {
            $this->params['id'] = $request->id;
            $item       = $this->model->getItem($this->params); 
            $itemParent = $this->model::find($item->parent_id);
        }

        $categories = $this->model->listItems($this->params, ['task' => 'admin-list-categories-in-selectbox']);
        $categories = $categories->pluck('name_with_depth', 'id'); // accessor

        return view($this->pathView . '/form', compact('item', 'categories', 'itemParent'));
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

    public function updateTree(Request $request)
    {
        $root = $this->model::find(1);
        $data = $request->dataClient;

        $nodes = $this->model::rebuildSubtree($root, $data);
        return $nodes;
    }

    public function delete(Request $request)
    {
        $params["id"] = $request->id;
        $this->model->deleteItem($params, ['task' => 'delete-nodes']);
        return redirect()->route($this->routeName)->with('notify', config('myConfig.notify.delete'));
    }
}
