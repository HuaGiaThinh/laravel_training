<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\HandleEmails;
use Illuminate\Http\Request;
use App\Http\Requests\EmailRequest as MainRequest;
use App\Models\Email as MainModel;
use App\Models\Email;
class EmailController extends Controller
{
    public function __construct()
    {
        $this->pathView         = 'admin.pages.email.';
        $this->controllerName   = 'email';
        $this->routeName        = 'emails';
        $this->model            = new MainModel();
        $this->params['pagination']['totalItemsPerPage'] = 10;
        view()->share('controllerName', $this->controllerName);
        view()->share('routeName', $this->routeName);
    }

    public function index(Request $request)
    {
        $this->params['filter']['status']   = $request->input('filter_status', 'all');

        $items = $this->model->listItems($this->params, ['task' => 'admin-list-items']);
        $itemsStatusCount = $this->model->countItemsStatus($this->params);
        $params = $this->params;

        return view($this->pathView . 'index', compact('items', 'itemsStatusCount', 'params'));
    }

    public function form(Request $request)
    {
        $item = null;
        if ($request->id) {
            $item = $this->model->getItem($request->id); 
        }

        return view($this->pathView . 'form', compact('item'));
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

    public function delete(Request $request)
    {
        $this->model->deleteItem($request->id);
        return redirect()->route($this->routeName)->with('notify', config('myConfig.notify.delete'));
    }

    public function handleEmail()
    {
        $emails = Email::where('status', 'PENDING')->get();
        
        $emails->each(function ($email) {
            Email::where('id', $email->id)->update(['status' => 'SENDING']);
        });
        
        HandleEmails::dispatch($emails);
        // HandleEmails::dispatch($emails)->delay(now()->addMinutes(5));

        return back()->with('notify', config('myConfig.notify.sendMailQueue'));
    }
}
