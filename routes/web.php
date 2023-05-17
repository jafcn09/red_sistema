<?php
use App\Events\WebsocketDemoEvent;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

CHATS RUTAS Y CONTROLLER*/
/* Route::get('/', function () {
    broadcast(new WebsocketDemoEvent('some data'));
    return view('welcome');
}); */
Route::get('/chats', 'ChatsController@index')->name('index');
Route::get('/messages', 'ChatsController@fetchMessages');
Route::post('/messages', 'ChatsController@sendMessages');

//Controlador del front-end
Route::get('/', 'WelcomeController@index')->name('welcome');
Auth::routes();
Route::get('/logout','Auth\LoginController@logout');
//Home
Route::group(['middleware' => 'auth'], function () {
	Route::get('/home', 'HomeController@index')->name('home')
		->middleware('permission:home');
	Route::get('/home_cliente', 'HomeController@home_cliente')->name('home_cliente')
		->middleware('permission:home_cliente');
	Route::get('/home_empleado', 'HomeController@home_empleado')->name('home_empleado')
		->middleware('permission:home_empleado');
});

    //Roles
Route::group(['middleware' => 'auth'], function () {
    Route::post('roles/store', 'RoleController@store')->name('roles.store')
        ->middleware('permission:roles.create');

    Route::get('roles/index', 'RoleController@index')->name('roles.index')
        ->middleware('permission:roles.index');

    Route::get('roles/create', 'RoleController@create')->name('roles.create')
        ->middleware('permission:roles.create');

    Route::put('roles/{role}', 'RoleController@update')->name('roles.update')
        ->middleware('permission:roles.edit');

    Route::get('roles/{role}', 'RoleController@show')->name('roles.show')
        ->middleware('permission:roles.show');

    Route::delete('roles/{role}', 'RoleController@destroy')->name('roles.destroy')
        ->middleware('permission:roles.destroy');

    Route::get('roles/{role}/edit', 'RoleController@edit')->name('roles.edit')
        ->middleware('permission:roles.edit');
});
    //Productos
Route::group(['middleware' => 'auth'], function () {
    
    Route::get('productos/inventario', 'ProductoController@inventario')->name('productos.inventario')
    ->middleware('permission:productos.inventario');   
});

//productos 
Route::group(['middleware' => 'auth'], function () {

    Route::post('productos/store', 'ProductoController@store')->name('productos.store')
        ->middleware('permission:productos.create');

    Route::get('productos/index', 'ProductoController@index')->name('productos.index')
        ->middleware('permission:productos.index');

    Route::get('productos/create', 'ProductoController@create')->name('productos.create')
        ->middleware('permission:productos.create');

    Route::put('productos/{producto}', 'ProductoController@update')->name('productos.update')
        ->middleware('permission:productos.edit');

    Route::get('productos/{producto}', 'ProductoController@show')->name('productos.show')
        ->middleware('permission:productos.show');

    Route::delete('productos/{producto}', 'ProductoController@destroy')->name('productos.destroy')
        ->middleware('permission:productos.destroy');

    Route::get('productos/{producto}/edit', 'ProductoController@edit')->name('productos.edit')
        ->middleware('permission:productos.edit');


});
    //User
Route::group(['middleware' => 'auth'], function () {

    Route::get('users/index', 'UserController@index')->name('users.index')
        ->middleware('permission:users.index');

    Route::post('users/store', 'UserController@store')->name('users.store')
        ->middleware('permission:users.create');

    Route::get('users/create', 'UserController@create')->name('users.create')
        ->middleware('permission:users.create');
		
	Route::put('users/{user}', 'UserController@update_role')->name('users.update_role')
        ->middleware('permission:users.edit_role');	

    Route::get('users/{user}', 'UserController@show')->name('users.show')
        ->middleware('permission:users.show');

    Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy')
        ->middleware('permission:users.destroy');
		
	Route::get('users/{user}/edit_role', 'UserController@edit_role')->name('users.edit_role')
        ->middleware('permission:users.edit_role');		
        
    Route::put('users/actualizar_persona/{user}', 'UserController@actualizar_persona')->name('users.actualizar_persona')
    ->middleware('permission:users.editar_persona');
    

    Route::get('users/editar_persona/{user}', 'UserController@editar_persona')->name('users.editar_persona')
        ->middleware('permission:users.editar_persona');

        Route::put('users/{user}', 'UserController@update_clave')->name('users.update_clave')
        ->middleware('permission:users.edit_clave');
        
    Route::get('users/{user}/edit_clave', 'UserController@edit_clave')->name('users.edit_clave')
        ->middleware('permission:users.edit_clave');
});


Route::get('/home', 'HomeController@index')->name('home')->middleware('permission:home');



	Route::get('youtube', function () {
		return view('pages.youtube');
	})->name('pages.youtube')->middleware('permission:pages.youtube');

	Route::get('pages.emby', function () {
		return view('pages.emby');
	})->name('pages.emby')->middleware('permission:pages.emby');

	Route::get('pages.emby-musica', function () {
		return view('pages.emby-musica');
	})->name('pages.emby-musica')->middleware('permission:pages.emby-musica');

	Route::get('pages.notifications', function () {
		return view('pages.notifications');
	})->name('pages.notifications')->middleware('permission:pages.notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
    })->name('upgrade');

//Rutas de front-end
Route::get('/sobre_nosotros', 'WelcomeController@sobre_nosotros')->name('sobre_nosotros');
Route::get('/planes', 'WelcomeController@planes')->name('planes');
Route::get('/servicios', 'WelcomeController@servicios')->name('servicios');
Route::get('/productos', 'WelcomeController@productos')->name('productos');
Route::get('/promociones', 'WelcomeController@promociones')->name('promociones');
Route::get('/contacto', 'WelcomeController@contacto')->name('contacto');
//Guardar en base de datos
Route::post('/contacto_store', 'WelcomeController@contacto_store')->name('contacto_store');

//Rutas para las acciones de usuarios del sistema
Route::group(['middleware' => 'auth'], function () {
    //Route::resource('users', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit'])
	->middleware('permission:profile.edit');
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update'])
	->middleware('permission:profile.update');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password'])
	->middleware('permission:profile.password');
});


// Rutas de clientes
//Acceso a lista de clientes
Route::group(['middleware' => 'auth'], function () {

    Route::get('clientes/index', 'UserController@verClientes')->name('clientes.index')
    ->middleware('permission:clientes.index');

    Route::get('clientes/show/{cliente}', 'UserController@showCliente')->name('clientes.show')
    ->middleware('permission:clientes.show');

    Route::get('clientes/edit/{cliente}', 'UserController@editCliente')->name('clientes.edit')
    ->middleware('permission:clientes.edit');

    Route::put('clientes/actualizarCliente/{cliente}', 'UserController@actualizarCliente')->name('clientes.actualizar')
    ->middleware('permission:clientes.edit');

    Route::put('clientes/{user}update_clave_cliente', 'UserController@update_clave_cliente')->name('clientes.update_clave_cliente')
    ->middleware('permission:clientes.edit_clave_cliente');

    Route::get('clientes/{cliente}/edit_clave_cliente', 'UserController@edit_clave_cliente')->name('clientes.edit_clave_cliente')
        ->middleware('permission:clientes.edit_clave_cliente');
});

// Rutas contratos
Route::group(['middleware' => 'auth'], function () {
Route::get('contratos/index', 'ContratoController@index')->name('contratos.index')
->middleware('permission:contratos.index');

Route::get('contratos/create', 'ContratoController@create')->name('contratos.create')
->middleware('permission:contratos.create');

Route::get('contratos/show/{contrato}', 'ContratoController@show')->name('contratos.show')
->middleware('permission:contratos.show');

Route::get('contratos/edit/{contrato}', 'ContratoController@edit')->name('contratos.edit')
->middleware('permission:contratos.edit');

Route::put('contratos/update/{contrato}', 'ContratoController@update')->name('contratos.update')
->middleware('permission:contratos.edit');

Route::delete('contratos/{contrato}', 'ContratoController@destroy')->name('contratos.destroy')
->middleware('permission:contratos.destroy');

Route::post('contratos/store', 'ContratoController@store')->name('contratos.store')
->middleware('permission:contratos.store');
//Pdf de contrato
Route::get('pdf/contrato/{id}', 'ContratoController@pdf')->name('pdf.contrato')
->middleware('permission:pdf.contrato');
});

// Rutas planes de servicio
Route::group(['middleware' => 'auth'], function () {

Route::get('planes/index', 'PlaneController@index')->name('planes.index')
->middleware('permission:planes.index');

Route::get('planes/create', 'PlaneController@create')->name('planes.create')
->middleware('permission:planes.create');

Route::get('planes/show/{plane}', 'PlaneController@show')->name('planes.show')
->middleware('permission:planes.show');

Route::get('planes/edit/{plane}', 'PlaneController@edit')->name('planes.edit')
->middleware('permission:planes.edit');

Route::post('planes/update/{plane}', 'PlaneController@update')->name('planes.update')
->middleware('permission:planes.edit');

Route::delete('planes/{plane}', 'PlaneController@destroy')->name('planes.destroy')
->middleware('permission:planes.destroy');

Route::post('planes/store', 'PlaneController@store')->name('planes.store')
->middleware('permission:planes.store');
});

// Rutas categorias de productos
Route::group(['middleware' => 'auth'], function () {

Route::get('categorias/index', 'CategoriaController@index')->name('categorias.index')
->middleware('permission:categorias.index');

Route::get('categorias/create', 'CategoriaController@create')->name('categorias.create')
->middleware('permission:categorias.create');

Route::get('categorias/show/{plane}', 'CategoriaController@show')->name('categorias.show')
->middleware('permission:categorias.show');

Route::get('categorias/edit/{categoria}', 'CategoriaController@edit')->name('categorias.edit')
->middleware('permission:categorias.edit');

Route::put('categorias/update/{categoria}', 'CategoriaController@update')->name('categorias.update')
->middleware('permission:categorias.edit');

Route::delete('categorias/{categoria}', 'CategoriaController@destroy')->name('categorias.destroy')
->middleware('permission:categorias.destroy');

Route::post('categorias/store', 'CategoriaController@store')->name('categorias.store')
->middleware('permission:categorias.store');
});

// Rutas de productos
Route::group(['middleware' => 'auth'], function () {

Route::get('productos/index', 'ProductoController@index')->name('productos.index')
->middleware('permission:productos.index');

Route::get('productos/create/', 'ProductoController@create')->name('productos.create')
->middleware('permission:productos.create');

Route::get('productos/show/{producto}', 'ProductoController@show')->name('productos.show')
->middleware('permission:productos.show');

Route::get('productos/{producto}/edit', 'ProductoController@edit')->name('productos.edit')
->middleware('permission:productos.edit');

Route::post('productos/update/{producto}', 'ProductoController@update')->name('productos.update')
->middleware('permission:productos.edit');

Route::delete('productos/{producto}', 'ProductoController@destroy')->name('productos.destroy')
->middleware('permission:productos.destroy');

Route::post('productos/store', 'ProductoController@store')->name('productos.store')
->middleware('permission:productos.store');

Route::get('productos/inventario', 'ProductoController@inventario')->name('productos.inventario')
->middleware('permission:productos.inventario'); 
});

// Rutas de servicios
Route::group(['middleware' => 'auth'], function () {

Route::get('servicios/index', 'ProductoController@servicio_index')->name('servicios.index')
->middleware('permission:servicios.index');

Route::get('servicios/create', 'ProductoController@servicio_create')->name('servicios.create')
->middleware('permission:servicios.create');

Route::get('servicios/show/{servicio}', 'ProductoController@servicio_show')->name('servicios.show')
->middleware('permission:servicios.show');

Route::get('servicios/{servicio}/edit', 'ProductoController@servicio_edit')->name('servicios.edit')
->middleware('permission:servicios.edit');

Route::post('servicios/update/{servicio}', 'ProductoController@servicio_update')->name('servicios.update')
->middleware('permission:servicios.edit');

Route::delete('servicios/{servicio}', 'ProductoController@servicio_destroy')->name('servicios.destroy')
->middleware('permission:servicios.destroy');

Route::post('servicios/store', 'ProductoController@servicio_store')->name('servicios.store')
->middleware('permission:servicios.store');
});

//Facturas rutas
Route::group(['middleware' => 'auth'], function () {

Route::get('/facturas/index', 'FacturaController@index')->name('facturas.index')
->middleware('permission:facturas.index');

Route::get('/facturas/create', 'FacturaController@create')->name('facturas.create')
->middleware('permission:facturas.create');

Route::get('/facturas/show/{id}', 'FacturaController@show')->name('facturas.show')
->middleware('permission:facturas.show');

Route::get('/facturas/{id}/edit', 'FacturaController@edit')->name('facturas.edit')
->middleware('permission:facturas.edit');

Route::post('/facturas/update/{id}', 'FacturaController@update')->name('facturas.update')
->middleware('permission:facturas.edit');

Route::delete('/facturas/{id}', 'FacturaController@destroy')->name('facturas.destroy')
->middleware('permission:facturas.destroy');

Route::post('/facturas/store', 'FacturaController@store')->name('facturas.store')
->middleware('permission:facturas.store');

Route::get('pdf/factura/{id}', 'FacturaController@pdf')->name('pdf.factura')
->middleware('permission:pdf.factura');
});
Route::resource('facturas', 'FacturaController');


//Rutas para los nodos
Route::group(['middleware' => 'auth'], function () {

Route::get('nodos/index', 'NodoController@index')->name('nodos.index')
->middleware('permission:nodos.index');

Route::get('nodos/create', 'NodoController@create')->name('nodos.create')
->middleware('permission:nodos.create');

Route::get('nodos/show/{nodo}', 'NodoController@show')->name('nodos.show')
->middleware('permission:nodos.show');

Route::get('nodos/{nodo}/edit', 'NodoController@edit')->name('nodos.edit')
->middleware('permission:nodos.edit');

Route::put('nodos/update/{nodo}', 'NodoController@update')->name('nodos.update')
->middleware('permission:nodos.edit');

Route::delete('nodos/{nodo}', 'NodoController@destroy')->name('nodos.destroy')
->middleware('permission:nodos.destroy');

Route::post('nodos/store', 'NodoController@store')->name('nodos.store')
->middleware('permission:nodos.store');

Route::get('pdf/nodo/{id}', 'NodoController@pdf')->name('pdf.nodo')
->middleware('permission:pdf.nodo');
});

//Rutas para los torres
Route::group(['middleware' => 'auth'], function () {

Route::get('torres/index', 'TorreController@index')->name('torres.index')
->middleware('permission:torres.index');

Route::get('torres/create', 'TorreController@create')->name('torres.create')
->middleware('permission:torres.create');

Route::get('torres/show/{torre}', 'TorreController@show')->name('torres.show')
->middleware('permission:torres.show');

Route::get('torres/{torre}/edit', 'TorreController@edit')->name('torres.edit')
->middleware('permission:torres.edit');

Route::put('torres/update/{torre}', 'TorreController@update')->name('torres.update')
->middleware('permission:torres.edit');

Route::delete('torres/{torre}', 'TorreController@destroy')->name('torres.destroy')
->middleware('permission:torres.destroy');

Route::post('torres/store', 'TorreController@store')->name('torres.store')
->middleware('permission:torres.store');

Route::get('pdf/torre/{id}', 'TorreController@pdf')->name('pdf.torre')
->middleware('permission:pdf.torres');
});

//Rutas para los enlaces
Route::group(['middleware' => 'auth'], function () {

Route::get('enlaces/index', 'EnlaceController@index')->name('enlaces.index')
->middleware('permission:enlaces.index');

Route::get('enlaces/create', 'EnlaceController@create')->name('enlaces.create')
->middleware('permission:enlaces.create');

Route::get('enlaces/show/{enlace}', 'EnlaceController@show')->name('enlaces.show')
->middleware('permission:enlaces.show');

Route::get('enlaces/edit/{enlace}', 'EnlaceController@edit')->name('enlaces.edit')
->middleware('permission:enlaces.edit');

Route::put('enlaces/update/{enlace}', 'EnlaceController@update')->name('enlaces.update')
->middleware('permission:enlaces.edit');

Route::delete('enlaces/{enlace}', 'EnlaceController@destroy')->name('enlaces.destroy')
->middleware('permission:enlaces.destroy');

Route::post('enlaces/store', 'EnlaceController@store')->name('enlaces.store')
->middleware('permission:enlaces.store');

Route::get('pdf/enlace/{enlace}', 'EnlaceController@pdf')->name('pdf.enlace')
->middleware('permission:pdf.enlaces');
//Activa desactiva enlace del cliente
Route::get('enlaces/activa_desactiva/{enlace}', 'EnlaceController@activa_desactiva')->name('enlaces.activa_desactiva')
->middleware('permission:enlaces.activa_desactiva');
});

// Rutas empresa del sistema
Route::group(['middleware' => 'auth'], function () {

Route::get('empresas/index', 'EmpresaController@index')->name('empresas.index')
->middleware('permission:empresas.index');

Route::get('empresas/create', 'EmpresaController@create')->name('empresas.create')
->middleware('permission:empresas.create');

Route::get('empresas/show/{empresa}', 'EmpresaController@show')->name('empresas.show')
->middleware('permission:empresas.show');

Route::get('empresas/edit/{empresa}', 'EmpresaController@edit')->name('empresas.edit')
->middleware('permission:empresas.edit');

Route::post('empresas/update/{empresa}', 'EmpresaController@update')->name('empresas.update')
->middleware('permission:empresas.edit');

Route::delete('empresas/{empresa}', 'EmpresaController@destroy')->name('empresas.destroy')
->middleware('permission:empresas.destroy');

Route::post('empresas/store', 'EmpresaController@store')->name('empresas.store')
->middleware('permission:empresas.store');
});
//Acceso a lista de empleados
Route::group(['middleware' => 'auth'], function () {

    Route::get('empleados/index', 'UserController@verEmpleado')->name('empleados.index')
        ->middleware('permission:empleados.index');
    
    Route::get('empleados/show/{empleado}', 'UserController@showEmpleado')->name('empleados.show')
        ->middleware('permission:empleados.show');

    Route::get('empleados/edit/{empleado}', 'UserController@editEmpleado')->name('empleados.edit')
        ->middleware('permission:empleados.edit');

    Route::post('empleados/update/{empleado}', 'UserController@updateEmpleado')->name('empleados.update')
        ->middleware('permission:empleados.edit');
});
        // Mikrotik API functions
Route::group(['middleware' => 'auth'], function () {
    
    Route::get('mikrotik/index', 'Mikrotik@index')->name('mikrotik.index')
	->middleware('permission:mikrotik.index');
    Route::get('mikrotik/dhcpleases', 'Mikrotik@dhcpleases')->name('mikrotik.dhcpleases')
	->middleware('permission:mikrotik.dhcpleases');
    Route::get('mikrotik/dnscache', 'Mikrotik@dnscache')->name('mikrotik.dnscache')
	->middleware('permission:mikrotik.dnscache');
    Route::get('mikrotik/dnsstatic', 'Mikrotik@dnsstatic')->name('mikrotik.dhcpleases')
	->middleware('permission:mikrotik.dhcpleases');
    Route::get('mikrotik/interface', 'Mikrotik@interface')->name('mikrotik.interface')
	->middleware('permission:mikrotik.interface');
    Route::get('mikrotik/queue', 'Mikrotik@queue')->name('mikrotik.queue')
	->middleware('permission:mikrotik.queue');
    Route::get('mikrotik/thedudemap', 'Mikrotik@thedudemap')->name('mikrotik.thedudemap')
	->middleware('permission:mikrotik.thedudemap');
});
Route::group(['middleware' => 'auth'], function () {
    //Rutas para los tareas
    Route::get('tareas/index', 'TareaController@index')->name('tareas.index')
    ->middleware('permission:tareas.index');

    Route::get('tareas/create', 'TareaController@create')->name('tareas.create')
    ->middleware('permission:tareas.create');

    Route::get('tareas/show/{tarea}', 'TareaController@show')->name('tareas.show')
    ->middleware('permission:tareas.show');

    Route::get('tareas/edit/{tarea}', 'TareaController@edit')->name('tareas.edit')
    ->middleware('permission:tareas.edit');

    Route::put('tareas/update/{tarea}', 'TareaController@update')->name('tareas.update')
    ->middleware('permission:tareas.edit');

    Route::delete('tareas/{tarea}', 'TareaController@destroy')->name('tareas.destroy')
    ->middleware('permission:tareas.destroy');

    Route::post('tareas/store', 'TareaController@store')->name('tareas.store')
    ->middleware('permission:tareas.store');
//Modal para finalizar tareas
    Route::put('tareas/finalizar/{tarea}', 'TareaController@finalizar')->name('tareas.finalizar')
    ->middleware('permission:tareas.edit');
//Modal para actualizar tareas
    Route::put('tareas/actualizar/{tarea}', 'TareaController@actualizar')->name('tareas.actualizar')
    ->middleware('permission:tareas.edit');
});