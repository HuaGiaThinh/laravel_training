<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User as MainModel;
use App\Http\Requests\UserRequest as MainRequest;
use Illuminate\Support\Facades\Config;


use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $params;

    public function __construct()
    {
        $this->pathView         = 'admin.pages.user';
        $this->controllerName   = 'user';
        $this->routeName        = 'users';
        $this->model            = new MainModel();
        $this->params['pagination']['totalItemsPerPage'] = 3;
        view()->share('controllerName', $this->controllerName);
        view()->share('routeName', $this->routeName);
    }
    
    public function index(Request $request)
    {
        $this->params['filter']['status']   = $request->input('filter_status', 'all');
        $this->params['filter']['level']    = $request->input('level', 'default');

        $items = $this->model->listItems($this->params);
        $itemsStatusCount = $this->model->countItemsStatus($this->params);
        $params = $this->params;
        return view($this->pathView . '/index', compact('items', 'itemsStatusCount', 'params'));
    }

    public function form(Request $request)
    {
        $item = null;
        if ($request->id) {
            $params['id'] = $request->id;
            $item = $this->model->getItem($params); 
        }

        return view($this->pathView . '/form', compact('item'));
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

    public function delete(Request $request)
    {
        $this->model::where('id', $request->id)->delete();
        return redirect()->route($this->routeName)->with('notify', config('myConfig.notify.delete'));
    }
}
