<?php

namespace App\Core\Modelos;

use Illuminate\Database\Eloquent\Model;

class Correos extends Model
{
      protected $table = "tb_correos";
   
      public function user(){
          return $this->belongsTo('\App\User');
      }
}
