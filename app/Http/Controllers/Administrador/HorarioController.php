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
        $rol = $this->getRol();

        $horarios = Horario::join('cursos','horarios.curso_id','=','cursos.id')
                           ->join('salas','salas.id','=','horarios.sala_id')
                           ->join('periodos','periodos.id','=','horarios.periodo_id')
                           ->join('asignaturas','asignaturas.id','=','cursos.asignatura_id')
                           ->join('docentes','docentes.id','=','cursos.docente_id')
                           ->select('horarios.*','salas.nombre as sala','periodos.bloque as bloque','cursos.seccion as seccion','asignaturas.nombre as asignatura','docentes.nombres as nombres_docente','docentes.apellidos as apellidos_docente')
                           ->get();

        return view('administrador/horario/index',compact('horarios','rol'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rol = $this->getRol();
        
        $cursos = Curso::join('asignaturas','asignaturas.id','=','cursos.asignatura_id')
                        ->join('docentes','docentes.id','=','cursos.docente_id')
                        ->select('cursos.*','asignaturas.nombre as asignatura','docentes.nombres as docente_nombres','docentes.apellidos as docente_apellidos')
                        ->get();

        //$docentes = Docente::all();

        $salas = Sala::where('estado','Disponible')
                      ->select('*')
                      ->get();

        $periodos = Periodo::all();

        return view('administrador/horario/create',compact('cursos','salas','periodos','rol'));
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

                  if($dia == 'Lunes')
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
                      return redirect()->route('administrador.horario.index');
              }
                      }

                  }
                  if($dia == 'Martes')
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
                      return redirect()->route('administrador.horario.index');
              }
                      }
                      
                  }
                  if($dia == 'Miercoles')
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
                      return redirect()->route('administrador.horario.index');
              }
                      }
                  }
                  if($dia == 'Jueves')
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
                      return redirect()->route('administrador.horario.index');
              }
                      }
                  }
                  if($dia == 'Viernes')
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
                      return redirect()->route('administrador.horario.index');
              }
                      }
                  }
                  if($dia == 'Sabado')
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
                      return redirect()->route('administrador.horario.index');
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
            
            $dia = $this->get_nombre_dia($fecha_formateada);

            $v = Horario::where('fecha',$fecha_formateada)
                          ->where('periodo_id',$request->get('periodo'))
                          ->where('sala_id',$request->get('sala'))
                          ->get();

            if(count($v) > 0){
              Session::flash('message', 'La sala se encuentra ocupada en la fecha '.$fecha_formateada);
              return redirect()->route('administrador.horario.index');
            }

            Horario::create([
                        'fecha' => $fecha_formateada,
                        'sala_id' => $request->get('sala'),
                        'periodo_id' => $request->get('periodo'),
                        'curso_id' => $request->get('curso'),
                        'permanencia' => 'dia',
                        'dia' => $dia,
                        'comentario' => $request->get('comentario')
                        ]);
            
            return redirect()->route('administrador.horario.index');            
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

                  if($dia == 'Lunes')
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
                  if($dia == 'Martes')
                  {
                      $martes = new Carbon('this tuesday');

                      if($martes <= $termino)
                      {
                        $mar = new Horario();
                        $mar->fill(['fecha' => $martes,'sala_id' => $request->get('sala'),'periodo_id' => $request->get('periodo'),'curso_id' => $request->get('curso'),'permanencia' => 'semestral','dia' => $dia,'comentario' => $request->get('comentario')]);
                        $mar->save();
                      }
                      
                  }
                  if($dia == 'Miercoles')
                  {
                      $miercoles = new Carbon('this wednesday');
                      if($miercoles <= $termino)
                      {
                        $mier = new Horario();
                        $mier->fill(['fecha' => $miercoles,'sala_id' => $request->get('sala'),'periodo_id' => $request->get('periodo'),'curso_id' => $request->get('curso'),'permanencia' => 'semestral','dia' => $dia,'comentario' => $request->get('comentario')]);
                        $mier->save();
                      }
                  }
                  if($dia == 'Jueves')
                  {
                      $jueves = new Carbon('this thursday');
                      if($jueves <= $termino)
                      {
                        $jue = new Horario();
                        $jue->fill(['fecha' => $jueves,'sala_id' => $request->get('sala'),'periodo_id' => $request->get('periodo'),'curso_id' => $request->get('curso'),'permanencia' => 'semestral','dia' => $dia,'comentario' => $request->get('comentario')]);
                        $jue->save();
                      }
                  }
                  if($dia == 'Viernes')
                  {
                      $viernes = new Carbon('this friday');
                      if($viernes <= $termino)
                      {
                        $vier = new Horario();
                        $vier->fill(['fecha' => $viernes,'sala_id' => $request->get('sala'),'periodo_id' => $request->get('periodo'),'curso_id' => $request->get('curso'),'permanencia' => 'semestral','dia' => $dia,'comentario' => $request->get('comentario')]);
                        $vier->save();
                      }
                  }
                  if($dia == 'Sabado')
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
            
            return redirect()->route('administrador.horario.index');            
        }  
            
        return redirect()->route('administrador.horario.index'); 

    }

    protected function get_nombre_dia($fecha){

       $fechats = strtotime($fecha); //pasamos a timestamp
     
      //el parametro w en la funcion date indica que queremos el dia de la semana
      //lo devuelve en numero 0 domingo, 1 lunes,....
      switch (date('w', $fechats)){
          case 0: return "Domingo"; break;
          case 1: return "Lunes"; break;
          case 2: return "Martes"; break;
          case 3: return "Miercoles"; break;
          case 4: return "Jueves"; break;
          case 5: return "Viernes"; break;
          case 6: return "Sabado"; break;
      }
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
        $rol = $this->getRol();

        $horario = Horario::find($id);

        $cursos = Curso::join('asignaturas','asignaturas.id','=','cursos.asignatura_id')
                        ->join('docentes','docentes.id','=','cursos.docente_id')
                        ->select('cursos.*','asignaturas.nombre as asignatura','docentes.nombres as docente_nombres','docentes.apellidos as docente_apellidos')
                        ->get();

        $fecha_inicio = Horario::where('curso_id',$horario->curso_id)
                                ->min('fecha');
        $fecha_termino = Horario::where('curso_id',$horario->curso_id) 
                                ->max('fecha');
                          
        $salas = Sala::where('estado','Disponible')
                      ->select('*')
                      ->get();

        $periodos = Periodo::all();

        return view('administrador/horario/edit',compact('horario','cursos','docentes','salas','periodos','fecha_inicio','fecha_termino','rol'));
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

      $fecha_separada = explode("-",$request->get('fecha'));
      $fecha_formateada = $fecha_separada[2]."-".$fecha_separada[1]."-".$fecha_separada[0];

      $dia = $this->get_nombre_dia($fecha_formateada);

      $horario = Horario::find($id);

      $horario->fecha = $fecha_formateada;
      $horario->sala_id = $request->get('sala');
      $horario->periodo_id = $request->get('periodo');
      $horario->curso_id = $request->get('curso');
      $horario->dia = $dia;
      $horario->comentario = $request->get('comentario'); 
      $horario->asistencia_docente = $request->get('asistencia_docente');
      $horario->cantidad_alumnos = $request->get('cantidad_alumnos');

      $horario->save();
          
      return redirect()->route('administrador.horario.index');            

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

      $rol = $this->getRol();
      
      $fecha_seleccionada = $request->get('fecha');
      $dia = $request->get('dia');
      $bloque = $request->get('bloque');

      if($fecha_seleccionada && $bloque)
      {

        $horarios = Horario::join('cursos','horarios.curso_id','=','cursos.id')
                           ->join('salas','salas.id','=','horarios.sala_id')
                           ->join('periodos','periodos.id','=','horarios.periodo_id')
                           ->join('asignaturas','asignaturas.id','=','cursos.asignatura_id')
                           ->join('docentes','docentes.id','=','cursos.docente_id')
                           ->where('horarios.fecha',$fecha_seleccionada)
                           ->where('periodos.bloque',$bloque)
                           ->select('horarios.*','salas.nombre as sala','periodos.bloque as bloque','cursos.seccion as seccion','asignaturas.nombre as asignatura','docentes.nombres as nombres_docente','docentes.apellidos as apellidos_docente')
                           ->get();     

        return view('administrador/horario/display',compact('horarios','rol','fecha_seleccionada','dia','bloque')); 
      }

      if($fecha_seleccionada)
      {

        $horarios = Horario::join('cursos','horarios.curso_id','=','cursos.id')
                           ->join('salas','salas.id','=','horarios.sala_id')
                           ->join('periodos','periodos.id','=','horarios.periodo_id')
                           ->join('asignaturas','asignaturas.id','=','cursos.asignatura_id')
                           ->join('docentes','docentes.id','=','cursos.docente_id')
                           ->where('horarios.fecha',$fecha_seleccionada)
                           ->select('horarios.*','salas.nombre as sala','periodos.bloque as bloque','cursos.seccion as seccion','asignaturas.nombre as asignatura','docentes.nombres as nombres_docente','docentes.apellidos as apellidos_docente')
                           ->get();     

        return view('administrador/horario/display',compact('horarios','rol','fecha_seleccionada','dia','bloque')); 
      }

      if($dia && $bloque)
      {

        $horarios = Horario::join('cursos','horarios.curso_id','=','cursos.id')
                           ->join('salas','salas.id','=','horarios.sala_id')
                           ->join('periodos','periodos.id','=','horarios.periodo_id')
                           ->join('asignaturas','asignaturas.id','=','cursos.asignatura_id')
                           ->join('docentes','docentes.id','=','cursos.docente_id')
                           ->where('horarios.dia',$dia)
                           ->where('periodos.bloque',$bloque)
                           ->select('horarios.*','salas.nombre as sala','periodos.bloque as bloque','cursos.seccion as seccion','asignaturas.nombre as asignatura','docentes.nombres as nombres_docente','docentes.apellidos as apellidos_docente')
                           ->get();     

        return view('administrador/horario/display',compact('horarios','rol','fecha_seleccionada','dia','bloque')); 
      }

      if($dia)
      {

        $horarios = Horario::join('cursos','horarios.curso_id','=','cursos.id')
                           ->join('salas','salas.id','=','horarios.sala_id')
                           ->join('periodos','periodos.id','=','horarios.periodo_id')
                           ->join('asignaturas','asignaturas.id','=','cursos.asignatura_id')
                           ->join('docentes','docentes.id','=','cursos.docente_id')
                           ->where('horarios.dia',$dia)
                           ->select('horarios.*','salas.nombre as sala','periodos.bloque as bloque','cursos.seccion as seccion','asignaturas.nombre as asignatura','docentes.nombres as nombres_docente','docentes.apellidos as apellidos_docente')
                           ->get();     

        return view('administrador/horario/display',compact('horarios','rol','fecha_seleccionada','dia','bloque')); 
      }

      if($bloque)
      {

        $horarios = Horario::join('cursos','horarios.curso_id','=','cursos.id')
                           ->join('salas','salas.id','=','horarios.sala_id')
                           ->join('periodos','periodos.id','=','horarios.periodo_id')
                           ->join('asignaturas','asignaturas.id','=','cursos.asignatura_id')
                           ->join('docentes','docentes.id','=','cursos.docente_id')
                           ->where('periodos.bloque',$bloque)
                           ->select('horarios.*','salas.nombre as sala','periodos.bloque as bloque','cursos.seccion as seccion','asignaturas.nombre as asignatura','docentes.nombres as nombres_docente','docentes.apellidos as apellidos_docente')
                           ->get();     

        return view('administrador/horario/display',compact('horarios','rol','fecha_seleccionada','dia','bloque')); 
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


      return view('administrador/horario/display',compact('horarios','rol','fecha_seleccionada','dia','bloque'));      
    }

    public function excel_download()
    {
      $var = Horario::all();
      \Excel::create('Horarios',function($excel) use ($var)
      {
        $excel->sheet('Sheetname',function($sheet) use ($var)
        {
          $data=[];
          array_push($data, array('FECHA','SALA','PERIODO','CURSO','PERMANENCIA','DIA','COMENTARIO','ASISTENCIA_DOCENTE','CANTIDAD_ALUMNOS'));
          foreach($var as $key => $v)
          {
            
            array_push($data, array($v->fecha,$v->sala_id,$v->periodo_id,$v->curso_id,$v->permanencia,$v->dia,$v->comentario,$v->asistencia_docente,$v->cantidad_alumnos));
          }   
          $sheet->fromArray($data,null, 'A1', false,false);
        
        });
        
      })->download('xlsx');
        
           return redirect()->route('administrador.horario.index');
    }
}
