<?php

namespace App\Listeners;

use App\Events\ViewPostDetail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrackingUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ViewPostDetail  $event
     * @return void
     */
    public function handle(ViewPostDetail $event)
    {
        if (Auth::user()) {
            DB::table('tracking_user')->insert([
                'user_id'       => Auth::id(), 
                'post_id'       => $event->post->id,
                'created_at'    => now()
            ]);
        }
    }
}
