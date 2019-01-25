<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\User;
use App\Mail\EncuestaMail;
use Illuminate\Support\Facades\Mail;

class ProcessMailEncuesta implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
           
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = \DB::table('user')->where('id',4)->get();
         
        Mail::to($user)->send(new EncuestaMail($user));
    }
}
