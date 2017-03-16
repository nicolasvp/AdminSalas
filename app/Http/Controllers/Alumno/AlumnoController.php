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

use App\Campus;

use DB;

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
        $rol = $this->getRol();

        return view('alumno/index',compact('rol'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function horario(Request $request)
    {

      $rol = $this->getRol();
      $campus = Campus::select('id','nombre')->get();
      $bloques = Periodo::select('id','bloque')->get();
      $fecha_seleccionada = $request->get('fecha');
      $bloque_seleccionado = "";
      $campus_seleccionado = "";
      $dia_seleccionado = "";

      $condicion = '0 = 0';

      if($fecha_seleccionada)
      {
        $fecha_formateada = date_format(date_create($fecha_seleccionada),"Y-m-d"); 
        $condicion .= " and a.fecha = to_date('".$fecha_formateada."','YYYY-MM-DD')"; 
      }    

      if($request->get('campus'))
      {
        $condicion .= " and c.campus_id = ".$request->get('campus');
        $campus_seleccionado = $request->get('campus');
      }

      if($request->get('bloque'))
      {
        $condicion .= " and a.periodo_id = ".$request->get('bloque');
        $bloque_seleccionado = $request->get('bloque');
      }

      if($request->get('dia'))
      {
        $condicion .= " and a.dia = '".$request->get('dia')."'";
        $dia_seleccionado = $request->get('dia');
      }

      $horarios = DB::select("select a.*, c.nombre as sala, d.bloque, b.seccion, e.nombre as asignatura, 
                              f.nombres as nombres_docente, f.apellidos as apellidos_docente
                              from horarios a
                              join cursos b on a.curso_id = b.id
                              join salas c on c.id = a.sala_id
                              join periodos d on d.id = a.periodo_id
                              join asignaturas e on e.id = b.asignatura_id
                              join docentes f on f.id = b.docente_id
                              where ".$condicion."
                              order by a.fecha desc
                              ");   


      return view('alumno/horario',compact('horarios','rol','fecha_seleccionada','bloques','campus','campus_seleccionado','bloque_seleccionado','dia_seleccionado'));      
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
