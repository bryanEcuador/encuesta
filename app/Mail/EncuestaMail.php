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


    public function __construct(Correos $user)
    {
            $this->user = $user;
            $this->promocion = $this->user['promocion'];
            $this->url = 'http://encuesta.test:8090/encuesta/'.$this->user['token'].'/'.$this->promocion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       return $this->subject('Seguimiento a graduados')->markdown('emails.encuesta',['promocion' => $this->promocion, 'url' => $this->url]);
    }
}
