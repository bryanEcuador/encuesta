<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;

class rolesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::created([
           ['name'=> 'administrador','slug'=>'administrador','descripction'=>'Puede ver toda la información del sitio','speciall' =>'all-acces'],
           ['name'=> 'seguridad','slug'=>'seguridad','descripction'=>'Puede gestionar la seguridad del sitio', 'speciall' => null],
           ['name'=> 'visualizador','slug'=>'visualizador','descripction'=>'Puede ver los graficos estadistincos', 'speciall' => null],
           ['name' => 'edicion','slug'=>'editor','description'=>'Puede modificar datos de la encuesta', 'speciall' => null]
        ]);
    }
}
