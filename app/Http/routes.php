<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/login',function() {
	return view('login');
});




/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
/*
Route::group(['middleware' => ['web']], function () { 


});
*/
Route::get('/rest',function(){

	$client = new GuzzleHttp\Client();

	$res = $client->request('GET', 'https://sepa.utem.cl/rest/api/v1/sepa/autenticar/181179252/116fc7635034c3310f21d95e5ca48ea1f59d58296b074e4740b6003b8edc6182', [
    'auth' => ['HJPD4IceDT', '4e878edc156b244dfc99e7433447de6b']
	]);

	$body = json_decode($res->getBody(true));
	
	if($body->ok == true)
	{
		$res = $client->request('GET', 'https://sepa.utem.cl/rest/api/v1/utem/estudiante/181179252', [
	    'auth' => ['HJPD4IceDT', '4e878edc156b244dfc99e7433447de6b']
		]);	

		$info = json_decode($res->getBody(true));

		dd($info);
	}
	else
	{
		dd($body->ok);
	}

});

Route::get('/',function(){
	return view('login');
});

Route::group(['prefix' => 'administrador', 'namespace' => 'Administrador'], function(){

	Route::get('/dashboard',function(){
		return view('administrador/index');
	});
	Route::resource('/campus','CampusController');
	Route::resource('/facultad','FacultadController');
	Route::resource('/departamento','DepartamentoController');
	Route::resource('/escuela','EscuelaController');
	Route::resource('/carrera','CarreraController');
	Route::resource('/asignatura','AsignaturaController');
	Route::resource('/rol','RolController');
	Route::resource('/docente','DocenteController');
	Route::resource('/curso','CursoController');
	Route::resource('/tipo_sala','TipoSalaController');
	Route::resource('/sala','SalaController');
	Route::resource('/periodo','PeriodoController');
	Route::resource('/horario','HorarioController');
	Route::resource('/usuario','UsuarioController');

	Route::post('/periodo/create/upload',['uses' => 'PeriodoController@upload', 'as' => 'administrador.periodo.upload']);
	Route::get('/horario/display/diario',['uses' => 'HorarioController@display_horario', 'as' => 'administrador.horario.display']);
});


Route::group(['prefix' => 'alumno', 'namespace' => 'Alumno'], function(){
	Route::resource('/','AlumnoController');
	Route::get('horario',['uses' => 'AlumnoController@horario', 'as' => 'alumno.horario']);
});

Route::group(['prefix' => 'docente', 'namespace' => 'Docente'], function(){
	Route::resource('/','DocenteController');
	Route::get('horario',['uses' => 'DocenteController@horario', 'as' => 'docente.horario']);
});