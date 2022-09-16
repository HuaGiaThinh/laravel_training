<?php

namespace App\Jobs;

use App\Mail\SendMailQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class HandleEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $emails;

    public function __construct($emails)
    {
        $this->emails = $emails;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $this->emails->each(function ($email) {
            try {
                Mail::to($email->email)->send(new SendMailQueue()); 

                DB::table('emails')->where('id', $email->id)->update(['status' => 'DONE']);
            } catch (\Throwable $th) {
                DB::table('emails')->where('id', $email->id)->update(['status' => 'ERROR']);
            }  
        });    
    }
}
