<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Notifications\NotifyInactiveUsers;

class InactiveUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:inactiveUsers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to Inactive Users';

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
        $inactiveUsers = User::where('last_login', '<', $limit)->get();
        foreach ($inactiveUsers as $user) {
            $user->notify(new NotifyInactiveUsers());
        }

        // return 0;
    }
}
