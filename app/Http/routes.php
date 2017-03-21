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
/*
Route::get('/', function () {
    return view('index');
});
*/



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

Route::group(['middleware' => ['web']], function () { 

	Route::auth();

	Route::get('/home', 'HomeController@index');

	Route::get('/','HomeController@index');

	Route::group(['prefix' => 'administrador',  'namespace' => 'Administrador', 'middleware' => ['auth','IsAdmin']], function(){

		Route::get('/inicio',function(){

	    $rol_usuario = \App\Rol_usuario::join('roles','roles_usuarios.rol_id','=','roles.id')
	            ->where('roles_usuarios.rut','=',Auth::user()->rut)
	            ->select('roles.nombre')
	            ->get(); 
        
        $rol = $rol_usuario->first()->nombre;

			return view('administrador/index',compact('rol'));
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
		Route::resource('/contacto','ContactoController');
		Route::resource('/estadistica','EstadisticaController');
		Route::post('/tipo_sala/create/upload',['uses' => 'TipoSalaController@upload', 'as' => 'administrador.tipo_sala.upload']);
		Route::post('/periodo/create/upload',['uses' => 'PeriodoController@upload', 'as' => 'administrador.periodo.upload']);
		Route::post('/facultad/create/upload',['uses' => 'FacultadController@upload', 'as' => 'administrador.facultad.upload']);
		Route::post('/departamento/create/upload',['uses' => 'DepartamentoController@upload', 'as' => 'administrador.departamento.upload']);
		Route::post('/escuela/create/upload',['uses' => 'EscuelaController@upload', 'as' => 'administrador.escuela.upload']);
		Route::post('/carrera/create/upload',['uses' => 'CarreraController@upload', 'as' => 'administrador.carrera.upload']);
		Route::post('/asignatura/create/upload',['uses' => 'AsignaturaController@upload', 'as' => 'administrador.asignatura.upload']);
		Route::post('/docente/create/upload',['uses' => 'DocenteController@upload', 'as' => 'administrador.docente.upload']);
		Route::post('/sala/create/upload',['uses' => 'SalaController@upload', 'as' => 'administrador.sala.upload']);
		Route::post('/curso/create/upload',['uses' => 'CursoController@upload', 'as' => 'administrador.curso.upload']);
		Route::post('/campus/create/upload',['uses' => 'CampusController@upload', 'as' => 'administrador.campus.upload']);

		Route::get('/horario/display/diario',['uses' => 'HorarioController@display_horario', 'as' => 'administrador.horario.display']);
		Route::get('/campus_download',['uses' => 'CampusController@excel_download','as' => 'administrador.campus.download']);
		Route::get('/facultad_download',['uses' => 'FacultadController@excel_download','as' => 'administrador.facultad.download']);
		Route::get('/departamento_download',['uses' => 'DepartamentoController@excel_download','as' => 'administrador.departamento.download']);
		Route::get('/escuela_download',['uses' => 'EscuelaController@excel_download','as' => 'administrador.escuela.download']);
		Route::get('/carrera_download',['uses' => 'CarreraController@excel_download','as' => 'administrador.carrera.download']);	
		Route::get('/asignatura_download',['uses' => 'AsignaturaController@excel_download','as' => 'administrador.asignatura.download']);
		Route::get('/docente_download',['uses' => 'DocenteController@excel_download','as' => 'administrador.docente.download']);
		Route::get('/curso_download',['uses' => 'CursoController@excel_download','as' => 'administrador.curso.download']);
		Route::get('/estadistica_download',['uses' => 'EstadisticaController@excel_download','as' => 'administrador.estadistica.download']);
		//Route::get('/rol_download',['uses' => 'RolController@excel_download','as' => 'administrador.rol.download']);
		Route::get('/tipo_sala_download',['uses' => 'TipoSalaController@excel_download','as' => 'administrador.tipo_sala.download']);	
		Route::get('/sala_download',['uses' => 'SalaController@excel_download','as' => 'administrador.sala.download']);	
		Route::get('/periodo_download',['uses' => 'PeriodoController@excel_download','as' => 'administrador.periodo.download']);	
		Route::get('/usuario_download',['uses' => 'UsuarioController@excel_download','as' => 'administrador.usuario.download']);
		Route::get('/horario_download',['uses' => 'HorarioController@excel_download','as' => 'administrador.horario.download']);
		Route::get('/estadistica_tipo',['uses' => 'EstadisticaController@tipos','as' => 'administrador.estadistica.tipos']);
		Route::get('/estadistica_salas',['uses' => 'EstadisticaController@salas','as' => 'administrador.estadistica.salas']);
		Route::get('/estadistica_cursos',['uses' => 'EstadisticaController@cursos','as' => 'administrador.estadistica.cursos']);
		Route::get('/estadistica_asistencia',['uses' => 'EstadisticaController@asistencia','as' => 'administrador.estadistica.asistencia']);
		Route::get('/estadistica_carreras',['uses' => 'EstadisticaController@carreras','as' => 'administrador.estadistica.carreras']);
		Route::get('/estadistica_estado_salas',['uses' => 'EstadisticaController@estado_salas','as' => 'administrador.estadistica.estado_salas']);
	});	

	Route::group(['prefix' => 'encargado', 'namespace' => 'Encargado', 'middleware' => ['auth','IsEncargado']], function(){

		Route::get('/inicio',function(){
			
			$rol_usuario = \App\Rol_usuario::join('roles','roles_usuarios.rol_id','=','roles.id')
										    ->where('roles_usuarios.rut','=',Auth::user()->rut)
										    ->select('roles.nombre')
										    ->get(); 
	        
	        $rol = $rol_usuario->first()->nombre;

	    	$campus = \App\Campus::where('rut_encargado',Auth::user()->rut)
					    	->select('nombre')
					    	->get();

			if($campus->isEmpty()){
				$campus = '';
			}
			else
			{
				$campus = $campus->first()->nombre;
			}
					    	
			return view('encargado/index',compact('rol','campus'));
		});
		
		Route::resource('/horario','HorarioController');
		Route::resource('/contacto','ContactoController');
		Route::get('/horario/display/diario',['uses' => 'HorarioController@display_horario', 'as' => 'encargado.horario.display']);
		Route::get('/horario_download',['uses' => 'HorarioController@excel_download','as' => 'encargado.horario.download']);
	});

	Route::group(['prefix' => 'alumno', 'namespace' => 'Alumno', 'middleware' => ['auth','IsEstudiante']], function(){
		Route::resource('/','AlumnoController');
		Route::resource('/contacto','ContactoController');
		Route::get('horario',['uses' => 'AlumnoController@horario', 'as' => 'alumno.horario']);
	});

	Route::group(['prefix' => 'docente', 'namespace' => 'Docente', 'middleware' => ['auth','IsDocente']], function(){
		Route::resource('/','DocenteController');
		Route::resource('/contacto','ContactoController');
		Route::get('horario',['uses' => 'DocenteController@horario', 'as' => 'docente.horario']);
	});

	

});



Route::get('/rest',function(){

	//dd(bcrypt('12345678'));
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





