<?php

namespace App\Mail;

use App\Core\Modelos\Correos;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class EncuestaMail extends Mailable 
{
    use Queueable, SerializesModels ;
    public $user;
    public $promocion;
    public $url;
    /**
     * Create a new message instance.
     *
     * @return void
     */


    public function __construct($user = null)
    {
        if($user != null){
            $this->user = $user->toArray();
            $this->promocion = $this->user[0]['promocion'];
            $this->url = 'http://encuesta.test:8090/encuesta/'.$this->user[0]['token'].'/'.$this->user[0]['promocion'];
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       return $this->subject('Seguimiento a graduados')->markdown('emails.encuesta',['promocion' => $this->promocion, 'url' => $this->url]);
        //return $this->subject('Seguimiento a graduados')->markdown('emails.encuesta');
    }
}
