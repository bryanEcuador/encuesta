<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\User;
use App\Core\Modelos\Correos;
use App\Mail\EncuestaMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

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
        $users = Correos::whereYear('fecha_creacion',2019)->get();
        # envia los correos a todos los usuarios que deben responder la encuesta
        foreach ( $users as $user) {
            # code...
            Mail::to($user)->send(new EncuestaMail($user));
        }
                             
    }
}
