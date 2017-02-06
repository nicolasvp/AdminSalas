<?php

namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Horario;

use App\Curso;

use App\Periodo;

use App\Sala;

use App\Asignatura;

use App\Docente;

use Carbon\Carbon;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rol = $this->getRol();

        return view('docente/index',compact('rol'));
    }

    public function horario(Request $request)
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

        return view('encdocente/horario',compact('horarios','rol','fecha_seleccionada','dia','bloque')); 
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

        return view('docente/horario',compact('horarios','rol','fecha_seleccionada','dia','bloque')); 
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

        return view('docente/horario',compact('horarios','rol','fecha_seleccionada','dia','bloque')); 
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

        return view('docente/horario',compact('horarios','rol','fecha_seleccionada','dia','bloque')); 
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

        return view('docente/horario',compact('horarios','rol','fecha_seleccionada','dia','bloque')); 
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


      return view('docente/horario',compact('horarios','rol','fecha_seleccionada','dia','bloque'));          
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
