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

        DB::table('roles')->insert([
           ['name'=> 'administrador','slug'=>'administrador','descripction'=>'Puede ver toda la información del sitio','speciall' =>'all-acces'],
           ['name'=> 'seguridad','slug'=>'seguridad','description'=>'Puede gestionar la seguridad del sitio', 'special' => null],
           ['name'=> 'visualizador','slug'=>'visualizador','description'=>'Puede ver los graficos estadistincos', 'special' => null],
           ['name' => 'edicion','slug'=>'editor','description'=>'Puede modificar datos de la encuesta', 'special' => null]
        ]);
    }
}
