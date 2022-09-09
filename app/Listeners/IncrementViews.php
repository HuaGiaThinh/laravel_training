<?php

namespace App\Listeners;

use App\Events\ViewPostDetail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Post;

class IncrementViews
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
        // $post = $event->post;
        // $viewCount = $post->view_count;
        // Post::where('id', $post->id)->update(['view_count' => ++$viewCount]);

        $event->post->increment('view_count');
    }
}
