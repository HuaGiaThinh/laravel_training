<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use App\Models\Post;
use App\Models\User;
use App\Notifications\NotifyPostsNotReadOnThatDate;

class PostsNotReadOnThatDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:postsNotReadOnThatDate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to system admin about posts that were not read on that date';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $limit = Carbon::now()->subDay(1);  
        $inactivePosts = Post::where('last_read', '<', $limit)->get()->pluck('name', 'id')->toArray();

        $admins = User::where('level', 'admin')->get();

        foreach ($admins as $admin) {
            $admin->notify(new NotifyPostsNotReadOnThatDate($inactivePosts));
        }
    }
}
