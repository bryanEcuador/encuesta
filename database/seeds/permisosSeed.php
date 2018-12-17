<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class permisosSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::created([
            ['name' => 'roles create' , 'slug' => 'roles.create','permite crear roles'],
            ['name' => 'roles update', 'slug' => 'roles.update', 'permite acutalizar los roles'],
            ['name' => 'roles view', 'slug' => 'roles.view', 'permite ver los roles'],
            ['name' => 'roles index', 'slug' => 'roles.index', 'permite ver la vista principal de los de roles'],

            ['name' => 'permisos create', 'slug' => 'permisos.create', 'permite crear permisos'],
            ['name' => 'permisos update', 'slug' => 'permisos.update', 'permite acutalizar los permisos'],
            ['name' => 'permisos view', 'slug' => 'permisos.view', 'permite ver los permisos'],
            ['name' => 'permisos index', 'slug' => 'permisos.index', 'permite ver la vista principal de los permisos'],


            ['name' => 'usuarios create', 'slug' => 'usuarios.create', 'permite crear usuarios'],
            ['name' => 'usuarios update', 'slug' => 'usuarios.update', 'permite acutalizar los usuarios'],
            ['name' => 'usuarios view', 'slug' => 'usuarios.view', 'permite ver los usuarios'],
            ['name' => 'usuarios index', 'slug' => 'usuarios.index', 'permite ver la vista principal de los usuarios']
        ]);
    }
}
