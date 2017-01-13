<?php

namespace App\Http\Controllers\Alumno;

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

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('alumno/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function horario(Request $request)
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

            return view('alumno/horario',compact('horarios')); 
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

        return view('alumno/horario',compact('horarios'));    
    }

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
