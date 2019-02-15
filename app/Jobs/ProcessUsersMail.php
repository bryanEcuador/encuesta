<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\User;
use Illuminate\Support\Facades\DB;

class ProcessUsersMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $users;
    protected $fecha;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($users,$fecha_id)
    {
        $this->users = $users;
        $this->fecha = $fecha_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        foreach ($this->users as  $user) {
         DB::table('tb_correos')->insert([
            'user_id' => $user->id  ,'email' => $user->email , 'estado' => 0 , 'fecha_id' => $this->fecha , 'token' =>  str_random(16),
         ]);
      }
    }
}
