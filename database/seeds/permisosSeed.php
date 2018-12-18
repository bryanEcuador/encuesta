<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Support\Facades\DB;

class permisosSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'roles create' , 'slug' => 'roles.create','description' => 'permite crear roles'],
            ['name' => 'roles update', 'slug' => 'roles.update', 'description' =>  'permite acutalizar los roles'],
            ['name' => 'roles view', 'slug' => 'roles.view', 'description' =>  'permite ver los roles'],
            ['name' => 'roles index', 'slug' => 'roles.index', 'description' =>  'permite ver la vista principal de los de roles'],

            ['name' => 'permisos create', 'slug' => 'permisos.create', 'description' =>  'permite crear permisos'],
            ['name' => 'permisos update', 'slug' => 'permisos.update', 'description' =>  'permite acutalizar los permisos'],
            ['name' => 'permisos view', 'slug' => 'permisos.view', 'description' =>  'permite ver los permisos'],
            ['name' => 'permisos index', 'slug' => 'permisos.index', 'description' =>  'permite ver la vista principal de los permisos'],


            ['name' => 'usuarios create', 'slug' => 'usuarios.create', 'description' =>  'permite crear usuarios'],
            ['name' => 'usuarios update', 'slug' => 'usuarios.update', 'description' =>  'permite acutalizar los usuarios'],
            ['name' => 'usuarios view', 'slug' => 'usuarios.view', 'description' =>  'permite ver los usuarios'],
            ['name' => 'usuarios index', 'slug' => 'usuarios.index', 'description' =>  'permite ver la vista principal de los usuarios']
        ]);
    }
}
