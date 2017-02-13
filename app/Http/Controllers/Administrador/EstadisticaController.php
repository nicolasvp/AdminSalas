<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Http\Requests;

use App\Horario;

use DB;

class EstadisticaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rol = $this->getRol();

        if($request->ajax())
        {
            if($request->get('dato') == 'cursos')
            {
                //Cantidad de horarios por cursos
                $horarios = DB::select("select c.nombre, count(a.curso_id) as cantidad
                                        from
                                        horarios a
                                        inner join cursos b on a.curso_id = b.id
                                        inner join asignaturas c on c.id = b.asignatura_id
                                        group by c.nombre order by cantidad desc");                
            }

            if($request->get('dato') == 'salas')
            {            

                //Cantidad de horarios por salas
                $horarios = DB::select("select b.nombre, count(a.sala_id) as cantidad
                            from
                            horarios a
                            inner join salas b on a.sala_id = b.id
                            group by b.nombre order by cantidad desc");
             
            }

            if($request->get('dato') == 'asistencia_docente')
            {
                //Cantidad de horarios por asistencia de docente
                $horarios = DB::select("select a.asistencia_docente, count(a.sala_id) as cantidad
                                    from
                                    horarios a
                                    inner join salas b on a.sala_id = b.id
                                    where a.asistencia_docente is not null
                                    group by a.asistencia_docente order by cantidad desc");
            }

            $arreglo = [];
            foreach ($horarios as $key => $value) {
               // print_r($value);
                $arreglo[] = [$value->nombre,$value->cantidad];

            }
               
        
            return response()->json($arreglo);        
        }

        return view('administrador.estadisticas.index',compact('rol'));
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
