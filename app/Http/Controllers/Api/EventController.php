<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Event::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     * @param  \App\Models\Event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return $event;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }

    /**
     * Editable event
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event
     * @return \Illuminate\Http\Response
     * 
     * api: http://laravel_base.test/api/events/{event}/editable
     */
    public function editable(Request $request, Event $event)
    {
        DB::beginTransaction();
        try {
            // Get event and lock it during updating.
            $event = Event::where('id', $event->id)->lockForUpdate()->first();

            if ($event->editable == 1) {
                $event->editable = 0;
                $event->time_edit = time();
                $event->user_is_editing = Auth::id();
                $event->save();

                DB::commit();
                return response()->json('Allowed edit', 200);
            }
            return response()->json('Not allowed edit', 409);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json('Error', 500);
        }
    }

    /**
     * Release event
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event
     * @return \Illuminate\Http\Response
     * 
     * api: http://laravel_base.test/api/events/{event}/editable/release
     */
    public function release(Request $request, Event $event)
    {
        $event->editable = 1;
        $event->user_is_editing = null;
        $event->time_edit = null;
        $event->save();
        return response()->json('Release Success', 200);
    }

    // api: http://laravel_base.test/api/events/{event}/editable/maintain
    public function maintain(Request $request, Event $event)
    {
        if ($event->editable == 0 && (time() - $event->time_edit > 300)) {  // timeout 5 minutes
            $event->time_edit = Null;
            $event->editable = 1;
            $event->save();
            return response()->json('Success Maintain', 200);
        }
        return response()->json('Error Maintain', 409);
    }
}
