<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/events",
     *      tags={"Events"},
     *      description="Returns list of events",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       )
     *     )
     */
    public function index(Request $request)
    {
        return Event::all();
    }

    public function store(Request $request)
    {
    }

    /**
     * @OA\Get(
     *     path="/api/events/{event}",
     *     description="Get a single event from the ID",
     *     tags={"Events"},
     *     @OA\Parameter(
     *         description="Event ID",
     *         in="path",
     *         name="event",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Get event success"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="unexpected error",
     *     )
     * )
     */
    public function show(Event $event)
    {
        return $event;
    }

    public function update(Request $request, Event $event)
    {
    }

    public function destroy(Event $event)
    {
    }

    /**
     * @OA\Post(
     *     path="/api/events/{event}/editable",
     *     description="Check if that event is still editable",
     *     tags={"Events"},
     *     @OA\Parameter(
     *         description="Event ID",
     *         in="path",
     *         name="event",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Allowed edit event"
     *     ),
     *     @OA\Response(
     *         response="409",
     *         description="conflict",
     *     )
     * )
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
     * @OA\Post(
     *     path="/api/events/{event}/editable/release",
     *     description="Release event",
     *     tags={"Events"},
     *     @OA\Parameter(
     *         description="Event ID",
     *         in="path",
     *         name="event",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Release event successfully"
     *     ),
     * )
     */
    public function release(Request $request, Event $event)
    {
        $event->editable = 1;
        $event->user_is_editing = null;
        $event->time_edit = null;
        $event->save();
        return response()->json('Release Success', 200);
    }

    /**
     * @OA\Post(
     *     path="/api/events/{event}/editable/maintain",
     *     description="Maintain event",
     *     tags={"Events"},
     *     @OA\Parameter(
     *         description="Event ID",
     *         in="path",
     *         name="event",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Maintain success"
     *     ),
     *     @OA\Response(
     *         response="409",
     *         description="conflict",
     *     )
     * )
     */
    public function maintain(Event $event)
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
