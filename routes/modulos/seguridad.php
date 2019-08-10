<?php
Auth::routes();
Route::group(['prefix' => 'seguridad' , 'as' => 'seguridad.' ], function() {

    Route::middleware(['auth'])->group(function () {
            /* ->middleware ('permission:user.index'); */
        // permisos
            Route::get('permisos','PermisosController@index')->name('permisos.index')/*->middleware('permission:permisos.index')*/ ;
            Route::get('permisos/datos/{paginacion}/{page?}/{nombre?}','PermisosController@loadData')/* ->middleware('permission:permisos.index') */;
            Route::post('permisos/store','PermisosController@store')->name('permisos.guardar')/* ->middleware('permission:permisos.create') */;
            Route::put('permisos/update','PermisosController@update')->name('permisos.update')/* ->middleware('permission:permisos.update') */;        
            Route::get('show/permisos/{id}','PermisosController@show')->name('permisos.show')/* ->where('id' , '[0-9]+')->middleware('permission:permisos.view') */;
                    
        // Roles
        Route::get('roles','RolesController@index')->name('roles.index')/*->middleware('permission:roles.index')*/;
        route::get('roles/create','RolesController@create')->name('roles.create')/*->middleware('permission:roles.create')*/;
        route::get('rol/permisos','RolesController@permisos');
        route::post('/roles/store','RolesController@store')->name('roles.store')/*->middleware('permission:roles.create')*/;
        route::get('/roles/show/{id}','RolesController@show')->name('roles.show')/*->middleware('permission:roles.view')*/;
        route::get('/rolesedit/{id}','RolesController@edit')->name('roles.edit')/*->middleware('permission:roles.update')*/;
        route::post('/roles/{id}/update','RolesController@update')->name('roles.update')/*->middleware('permission:roles.update')*/;
        route::get('/rolestables','RolesController@table')->name('roles.table');
        route::get('validar/update/rol/{name}/{id}/slug','RolesController@uniqueSlugUpdate')->name('validar.rol.update.slug');
        route::get('validar/update/rol/{name}/{id}/name','RolesController@uniqueNameUpdate')->name('validar.rol.update.name');

        /* pendientes de saber para que son TODO */
        // route::get('/validar/rol/{name}/slug','Seguridad\RolController@uniqueSlug')->name('validar.rol.slug')->middleware('permission:roles.index');
        // route::get('/validar/rol/{name}/name','Seguridad\RolController@uniqueName')->name('validar.rol.name')->middleware('permission:roles.index');
        // route::get('/rolespermisos/{id}','Seguridad\RolController@rolesPermisos')->name('roles.permisos');
        // route::post('/roles/{id}/delete','Seguridad\RolesController@destroy')->name('roles.estado')->middleware('permission:roles.index');

        // Usuarios
            Route::get('usuarios','UserController@index')->name('user.index')/*->middleware('permission:usuarios.index')*/;
            Route::get('usuarios/datos/{paginacion}/{page?}/{rol?}/{name?}','UserController@loadData')/*->middleware('permission:usuarios.index')*/;
            Route::post('usuarios/store','UserController@store')->name('user.guardar')/*->middleware('permission:usuarios.create')*/;
            Route::put('usuarios/update','UserController@update')->name('user.update')/*->middleware('permission:usuarios.update')*/;
            route::get('usuarios/delete/{id}','UserController@destroy')->name('user.delete');   
            Route::get('usuarios/show/{id}','UserController@show')->name('user.show')->where('id' , '[0-9]+')/*->middleware('permission:usuarios.view')*/;
            route::get('usuarios/roles','UserController@cmbRoles')->name('user.roles');
            route::get('validar/usuario/{dato}/{tipo}/{metodo}/{id?}','UserController@validarUsuario')->name('validar.usuario');

        Route::get('permisos/datos/{paginacion}/{page?}/{nombre?}','PermisosController@loadData');

        route::get('/prueba', 'UserController@prueba');
    });
});
