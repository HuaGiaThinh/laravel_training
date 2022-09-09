<?php

namespace App\Listeners;

use App\Events\ViewPostDetail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Post;

class InsertLastRead
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
        Post::where('id', $event->post->id)->update(['last_read' => now()]);
    }
}
