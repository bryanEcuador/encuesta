<?php

namespace App\Core\Modelos;

use Illuminate\Database\Eloquent\Model;

class Correos extends Model
{
    public $timestamps = false;
      protected $table = "tb_correos";
   
      public function user(){
          return $this->belongsTo('\App\User');
      }
}
