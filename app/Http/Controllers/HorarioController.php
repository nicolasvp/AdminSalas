<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Session;

use App\Horario;

use App\Curso;

use App\Periodo;

use App\Sala;

use App\Asignatura;

use App\Docente;

use Carbon\Carbon;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horarios = Horario::join('cursos','horarios.curso_id','=','cursos.id')
                           ->join('salas','salas.id','=','horarios.sala_id')
                           ->join('periodos','periodos.id','=','horarios.periodo_id')
                           ->join('asignaturas','asignaturas.id','=','cursos.asignatura_id')
                           ->join('docentes','docentes.id','=','cursos.docente_id')
                           ->select('horarios.*','salas.nombre as sala','periodos.bloque as bloque','cursos.seccion as seccion','asignaturas.nombre as asignatura','docentes.nombres as nombres_docente','docentes.apellidos as apellidos_docente')
                           ->get();

        return view('horario/index',compact('horarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cursos = Curso::join('asignaturas','asignaturas.id','=','cursos.asignatura_id')
                        ->select('cursos.*','asignaturas.nombre as asignatura')
                        ->get();

        $docentes = Docente::all();

        $salas = Sala::all();

        $periodos = Periodo::all();

        return view('horario/create',compact('cursos','docentes','salas','periodos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


    	//Comprobacion de las fechas para duracion semestral, si existe alguna entonces devuelve un mensaje y no guarda ningun horario
 		if($request->get('duracion') == 'semestral')
        {
	        foreach($request->get('dias') as $dia)
	        {	
	            $inicio = new Carbon($request->get('fecha_inicio'));
	            $termino = new Carbon($request->get('fecha_termino'));
	   
	            while($inicio <= $termino)
	            {
	                Carbon::setTestNow($inicio);

	                if($dia == 'lunes')
	                {

	                    $lunes = new Carbon('this monday');
						
						if($lunes <= $termino)
	                    {
							$v = Horario::where('fecha',$lunes)
										->where('periodo_id',$request->get('periodo'))
										->where('sala_id',$request->get('sala'))
										->get();

						 	if(count($v) > 0){
						 		Session::flash('message', 'La sala se encuentra ocupada en la fecha '.$lunes);
  					        	return redirect()->route('horario.index');
						 	}
	                    }

	                }
	                if($dia == 'martes')
	                {
	                    $martes = new Carbon('this tuesday');

	                    if($martes <= $termino)
	                    {
							$v = Horario::where('fecha',$martes)
										->where('periodo_id',$request->get('periodo'))
										->where('sala_id',$request->get('sala'))
										->get();

						 	if(count($v) > 0){
						 		Session::flash('message', 'La sala se encuentra ocupada en la fecha '.$martes);
  					        	return redirect()->route('horario.index');
						 	}
	                    }
	                    
	                }
	                if($dia == 'miercoles')
	                {
	                    $miercoles = new Carbon('this wednesday');
	                    if($miercoles <= $termino)
	                    {
							$v = Horario::where('fecha',$miercoles)
										->where('periodo_id',$request->get('periodo'))
										->where('sala_id',$request->get('sala'))
										->get();

						 	if(count($v) > 0){
						 		Session::flash('message', 'La sala se encuentra ocupada en la fecha '.$miercoles);
  					        	return redirect()->route('horario.index');
						 	}
	                    }
	                }
	                if($dia == 'jueves')
	                {
	                    $jueves = new Carbon('this thursday');
	                    if($jueves <= $termino)
	                    {
							$v = Horario::where('fecha',$jueves)
										->where('periodo_id',$request->get('periodo'))
										->where('sala_id',$request->get('sala'))
										->get();

						 	if(count($v) > 0){
						 		Session::flash('message', 'La sala se encuentra ocupada en la fecha '.$jueves);
  					        	return redirect()->route('horario.index');
						 	}
	                    }
	                }
	                if($dia == 'viernes')
	                {
	                    $viernes = new Carbon('this friday');
	                    if($viernes <= $termino)
	                    {
							$v = Horario::where('fecha',$viernes)
										->where('periodo_id',$request->get('periodo'))
										->where('sala_id',$request->get('sala'))
										->get();

						 	if(count($v) > 0){
						 		Session::flash('message', 'La sala se encuentra ocupada en la fecha '.$viernes);
  					        	return redirect()->route('horario.index');
						 	}
	                    }
	                }
	                if($dia == 'sabado')
	                {
	                    $sabado = new Carbon('this saturday');
	                    if($sabado <= $termino)
	                    {
							$v = Horario::where('fecha',$sabado)
										->where('periodo_id',$request->get('periodo'))
										->where('sala_id',$request->get('sala'))
										->get();

						 	if(count($v) > 0){
						 		Session::flash('message', 'La sala se encuentra ocupada en la fecha '.$sabado);
  					        	return redirect()->route('horario.index');
						 	}
	                    }
	            	}
                	$inicio->addWeek(1);    
            	}
        	}
                       
        }


        if($request->get('duracion') == 'dia')
        {
            $fecha_separada = explode("-",$request->get('fecha'));
            $fecha_formateada = $fecha_separada[2]."-".$fecha_separada[1]."-".$fecha_separada[0];

      			$v = Horario::where('fecha',$fecha_formateada)
      				->where('periodo_id',$request->get('periodo'))
      				->where('sala_id',$request->get('sala'))
      				->get();

      			if(count($v) > 0){
      				Session::flash('message', 'La sala se encuentra ocupada en la fecha '.$fecha_formateada);
      				return redirect()->route('horario.index');
      			}

            Horario::create([
                'fecha' => $fecha_formateada,
                'sala_id' => $request->get('sala'),
                'periodo_id' => $request->get('periodo'),
                'curso_id' => $request->get('curso'),
                'permanencia' => 'dia',
                'dia' => $request->get('dia'),
                'comentario' => $request->get('comentario')
                ]);
            
            return redirect()->route('horario.index');            
        }




        if($request->get('duracion') == 'semestral')
        {
	        foreach($request->get('dias') as $dia)
	        {	
	            $inicio = new Carbon($request->get('fecha_inicio'));
	            $termino = new Carbon($request->get('fecha_termino'));
	   
	            while($inicio <= $termino)
	            {
	                Carbon::setTestNow($inicio);

	                if($dia == 'lunes')
	                {

	                    $lunes = new Carbon('this monday');
						
						          if($lunes <= $termino)
	                    {
		                    $lun = new Horario();
		                    $lun->fill(['fecha' => $lunes,
		                        'sala_id' => $request->get('sala'),
		                        'periodo_id' => $request->get('periodo'),
		                        'curso_id' => $request->get('curso'),
		                        'permanencia' => 'semestral',
		                        'dia' => $dia,
                            'comentario' => $request->get('comentario')]);
		                    $lun->save();
	                    }

	                }
	                if($dia == 'martes')
	                {
	                    $martes = new Carbon('this tuesday');

	                    if($martes <= $termino)
	                    {
		                    $mar = new Horario();
		                    $mar->fill(['fecha' => $martes,'sala_id' => $request->get('sala'),'periodo_id' => $request->get('periodo'),'curso_id' => $request->get('curso'),'permanencia' => 'semestral','dia' => $dia,'comentario' => $request->get('comentario')]);
		                    $mar->save();
	                    }
	                    
	                }
	                if($dia == 'miercoles')
	                {
	                    $miercoles = new Carbon('this wednesday');
	                    if($miercoles <= $termino)
	                    {
		                    $mier = new Horario();
		                    $mier->fill(['fecha' => $miercoles,'sala_id' => $request->get('sala'),'periodo_id' => $request->get('periodo'),'curso_id' => $request->get('curso'),'permanencia' => 'semestral','dia' => $dia,'comentario' => $request->get('comentario')]);
		                    $mier->save();
	                    }
	                }
	                if($dia == 'jueves')
	                {
	                    $jueves = new Carbon('this thursday');
	                    if($jueves <= $termino)
	                    {
		                    $jue = new Horario();
		                    $jue->fill(['fecha' => $jueves,'sala_id' => $request->get('sala'),'periodo_id' => $request->get('periodo'),'curso_id' => $request->get('curso'),'permanencia' => 'semestral','dia' => $dia,'comentario' => $request->get('comentario')]);
		                    $jue->save();
	                    }
	                }
	                if($dia == 'viernes')
	                {
	                    $viernes = new Carbon('this friday');
	                    if($viernes <= $termino)
	                    {
		                    $vier = new Horario();
		                    $vier->fill(['fecha' => $viernes,'sala_id' => $request->get('sala'),'periodo_id' => $request->get('periodo'),'curso_id' => $request->get('curso'),'permanencia' => 'semestral','dia' => $dia,'comentario' => $request->get('comentario')]);
		                    $vier->save();
	                    }
	                }
	                if($dia == 'sabado')
	                {
	                    $sabado = new Carbon('this saturday');
	                    if($sabado <= $termino)
	                    {
		                    $sab = new Horario();
		                    $sab->fill(['fecha' => $sabado,'sala_id' => $request->get('sala'),'periodo_id' => $request->get('periodo'),'curso_id' => $request->get('curso'),'permanencia' => 'semestral','dia' => $dia,'comentario' => $request->get('comentario')]);
		                    $sab->save();
	                    }
	            	}
                	$inicio->addWeek(1);    
            	}
        	}
            Session::flash('message', 'El horario fue asignado exitosamente!');
            
            return redirect()->route('horario.index');            
        }  
            
        return redirect()->route('horario.index'); 

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $horario = Horario::find($id);

        $cursos = Curso::join('asignaturas','asignaturas.id','=','cursos.asignatura_id')
                        ->select('cursos.*','asignaturas.nombre as asignatura')
                        ->get();
        $fecha_inicio = Horario::where('curso_id',$horario->curso_id)
                                ->min('fecha');
        $fecha_termino = Horario::where('curso_id',$horario->curso_id) 
                                ->max('fecha');
                          

        $docentes = Docente::all();

        $salas = Sala::all();

        $periodos = Periodo::all();

        return view('horario/edit',compact('horario','cursos','docentes','salas','periodos','fecha_inicio','fecha_termino'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $horario_eliminado = Horario::where('curso_id',$request->get('curso'))->get();
        foreach($horario_eliminado as $horario)
        {
            $horario->delete();  
        }

        if($request->get('duracion') == 'dia')
        {
            $fecha_separada = explode("-",$request->get('fecha'));
            $fecha_formateada = $fecha_separada[2]."-".$fecha_separada[1]."-".$fecha_separada[0];

            Horario::create([
                'fecha' => $fecha_formateada,
                'sala_id' => $request->get('sala'),
                'periodo_id' => $request->get('periodo'),
                'curso_id' => $request->get('curso'),
                'permanencia' => 'dia',
                'dia' => $request->get('dia'),
                'comentario' => $request->get('comentario'),
                'asistencia_docente' => $request->get('asistencia_docente'),
                'cantidad_alumnos' => $request->get('cantidad_alumnos')
                ]);
            
            return redirect()->route('horario.index');            
        }


        if($request->get('duracion') == 'semestral')
        {
        
            $inicio = new Carbon($request->get('fecha_inicio'));
            $termino = new Carbon($request->get('fecha_termino'));
   
            while($inicio <= $termino)
            {
                Carbon::setTestNow($inicio);

                if($request->get('dia') == 'lunes')
                {

                    $lunes = new Carbon('this monday');
                    if($lunes <= $termino)
                    {
                    $lun = new Horario();
                    $lun->fill(['fecha' => $lunes,
                        'sala_id' => $request->get('sala'),
                        'periodo_id' => $request->get('periodo'),
                        'curso_id' => $request->get('curso'),
                        'permanencia' => 'semestral',
                        'dia' => $request->get('dia'),
                        'comentario' => $request->get('comentario'),
                        'asistencia_docente' => $request->get('asistencia_docente'),
                        'cantidad_alumnos' => $request->get('cantidad_alumnos')]);
                    $lun->save();
                    }

                }
                if($request->get('dia') == 'martes')
                {
                    $martes = new Carbon('this tuesday');
                    if($martes <= $termino)
                    {
                    $mar = new Horario();
                    $mar->fill(['fecha' => $martes,'sala_id' => $request->get('sala'),'periodo_id' => $request->get('periodo'),'curso_id' => $request->get('curso'),'permanencia' => 'semestral','dia' => $request->get('dia'),'comentario' => $request->get('comentario'),'asistencia_docente' => $request->get('asistencia_docente'),'cantidad_alumnos' => $request->get('cantidad_alumnos')]);
                    $mar->save();
                    }
                }
                if($request->get('dia') == 'miercoles')
                {
                    $miercoles = new Carbon('this wednesday');
                    if($miercoles <= $termino)
                    {
                    $mier = new Horario();
                    $mier->fill(['fecha' => $miercoles,'sala_id' => $request->get('sala'),'periodo_id' => $request->get('periodo'),'curso_id' => $request->get('curso'),'permanencia' => 'semestral','dia' => $request->get('dia'),'comentario' => $request->get('comentario'),'asistencia_docente' => $request->get('asistencia_docente'),'cantidad_alumnos' => $request->get('cantidad_alumnos')]);
                    $mier->save();
                    }
                }
                if($request->get('dia') == 'jueves')
                {
                    $jueves = new Carbon('this thursday');
                    if($jueves <= $termino)
                    {
                    $jue = new Horario();
                    $jue->fill(['fecha' => $jueves,'sala_id' => $request->get('sala'),'periodo_id' => $request->get('periodo'),'curso_id' => $request->get('curso'),'permanencia' => 'semestral','dia' => $request->get('dia'),'comentario' => $request->get('comentario'),'asistencia_docente' => $request->get('asistencia_docente'),'cantidad_alumnos' => $request->get('cantidad_alumnos')]);
                    $jue->save();
                    }
                }
                if($request->get('dia') == 'viernes')
                {
                    $viernes = new Carbon('this friday');
                    if($viernes <= $termino)
                    {
                    $vier = new Horario();
                    $vier->fill(['fecha' => $viernes,'sala_id' => $request->get('sala'),'periodo_id' => $request->get('periodo'),'curso_id' => $request->get('curso'),'permanencia' => 'semestral','dia' => $request->get('dia'),'comentario' => $request->get('comentario'),'asistencia_docente' => $request->get('asistencia_docente'),'cantidad_alumnos' => $request->get('cantidad_alumnos')]);
                    $vier->save();
                    }
                }
                if($request->get('dia') == 'sabado')
                {
                    $sabado = new Carbon('this saturday');
                    if($sabado <= $termino)
                    {
                    $sab = new Horario();
                    $sab->fill(['fecha' => $sabado,'sala_id' => $request->get('sala'),'periodo_id' => $request->get('periodo'),'curso_id' => $request->get('curso'),'permanencia' => 'semestral','dia' => $request->get('dia'),'comentario' => $request->get('comentario'),'asistencia_docente' => $request->get('asistencia_docente'),'cantidad_alumnos' => $request->get('cantidad_alumnos')]);
                    $sab->save();
                    }
                }
                $inicio->addWeek(1);
                
            }
            Session::flash('message', 'El horario fue editado exitosamente!');
            
            return redirect()->route('horario.index');            
        }  
            
        return redirect()->route('horario.index'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        if($request->ajax()){

            $horario = Horario::find($id);
       
            if($horario)// Si está el registro
            {
                $horario->delete();
                return response()->json('ok');
            }
            else
            {
                return response()->json('fail');       
            }

        }
    }

    public function display_horario(Request $request)
    {


      if($request->get('dia') || $request->get('bloque'))
      {
        $horarios = Horario::join('cursos','horarios.curso_id','=','cursos.id')
                           ->join('salas','salas.id','=','horarios.sala_id')
                           ->join('periodos','periodos.id','=','horarios.periodo_id')
                           ->join('asignaturas','asignaturas.id','=','cursos.asignatura_id')
                           ->join('docentes','docentes.id','=','cursos.docente_id')
                           ->where('horarios.dia',$request->get('dia'))
                           ->where('periodos.bloque',$request->get('bloque'))
                           ->select('horarios.*','salas.nombre as sala','periodos.bloque as bloque','cursos.seccion as seccion','asignaturas.nombre as asignatura','docentes.nombres as nombres_docente','docentes.apellidos as apellidos_docente')
                           ->get();     

        return view('horario/display',compact('horarios')); 
      }

      $fecha_actual = Carbon::now();
      $fecha = $fecha_actual->format('Y-m-d');

      $horarios = Horario::join('cursos','horarios.curso_id','=','cursos.id')
                         ->join('salas','salas.id','=','horarios.sala_id')
                         ->join('periodos','periodos.id','=','horarios.periodo_id')
                         ->join('asignaturas','asignaturas.id','=','cursos.asignatura_id')
                         ->join('docentes','docentes.id','=','cursos.docente_id')
                         ->where('horarios.fecha',$fecha)
                         ->select('horarios.*','salas.nombre as sala','periodos.bloque as bloque','cursos.seccion as seccion','asignaturas.nombre as asignatura','docentes.nombres as nombres_docente','docentes.apellidos as apellidos_docente')
                         ->orderBy('periodos.bloque','asc')
                         ->get(); 


      return view('horario/display',compact('horarios'));      
    }
}
