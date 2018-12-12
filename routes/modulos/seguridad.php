<?php
Auth::routes();
Route::group(['prefix' => 'seguridad' , 'as' => 'seguridad.' ], function() {

    // permisos
        Route::get('permisos','PermisosController@index')->name('permisos.index');
        Route::get('permisos/datos/{paginacion}/{page?}/{nombre?}','PermisosController@loadData');
        Route::post('permisos/store','PermisosController@store')->name('permisos.guardar');
        Route::put('permisos/update','PermisosController@update')->name('permisos.update');        
        Route::get('show/permisos/{id}','PermisosController@show')->name('permisos.show')->where('id' , '[0-9]+');
                
    // Roles
    Route::get('roles','RolesController@index')->name('roles.index');
    route::get('roles/create','RolesController@create')->name('roles.create');
    route::get('rol/permisos','RolesController@permisos');
    route::post('/roles/store','RolesController@store')->name('roles.store');
    route::get('/roles/show/{id}','RolesController@show')->name('roles.show');
    route::get('/rolesedit/{id}','RolesController@edit')->name('roles.edit');
    route::post('/roles/{id}/update','RolesController@update')->name('roles.update');
    route::get('/rolestables','RolesController@table')->name('roles.table');
     route::get('validar/update/rol/{name}/{id}/slug','RolesController@uniqueSlugUpdate')->name('validar.rol.update.slug');
     route::get('validar/update/rol/{name}/{id}/name','RolesController@uniqueNameUpdate')->name('validar.rol.update.name');

     /* pendientes de saber para que son TODO */
    // route::get('/validar/rol/{name}/slug','Seguridad\RolController@uniqueSlug')->name('validar.rol.slug')->middleware('permission:roles.index');
    // route::get('/validar/rol/{name}/name','Seguridad\RolController@uniqueName')->name('validar.rol.name')->middleware('permission:roles.index');
    // route::get('/rolespermisos/{id}','Seguridad\RolController@rolesPermisos')->name('roles.permisos');
    // route::post('/roles/{id}/delete','Seguridad\RolesController@destroy')->name('roles.estado')->middleware('permission:roles.index');

    // Usuarios
        Route::get('usuarios','UserController@index')->name('user.index');
        Route::get('usuarios/datos/{paginacion}/{page?}/{rol?}/{name?}','UserController@loadData');
        Route::post('usuarios/store','UserController@store')->name('user.guardar');
        Route::put('usuarios/update','UserController@update')->name('user.update');     
        route::get('usuarios/delete/{id}','UserController@destroy')->name('user.delete');   
        Route::get('usuarios/show/{id}','UserController@show')->name('user.show')->where('id' , '[0-9]+');
        route::get('usuarios/roles','UserController@cmbRoles')->name('user.roles');
         route::get('validar/usuario/{dato}/{tipo}/{metodo}/{id?}','UserController@validarUsuario')->name('validar.usuario');

    Route::get('permisos/datos/{paginacion}/{page?}/{nombre?}','PermisosController@loadData');
    
});
