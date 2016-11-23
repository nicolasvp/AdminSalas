<?php

namespace App\Http\Controllers;

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
                           ->select('horarios.*','salas.nombre as sala','periodos.bloque as bloque','cursos.seccion as seccion','asignaturas.nombre as asignatura','docentes.nombres as nombre_docente','docentes.apellidos as apellidos_docente')
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
                'dia' => $request->get('dia')
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
                        'dia' => $request->get('dia')]);
                    $lun->save();
                    }

                }
                if($request->get('dia') == 'martes')
                {
                    $martes = new Carbon('this tuesday');
                    if($martes <= $termino)
                    {
                    $mar = new Horario();
                    $mar->fill(['fecha' => $martes,'sala_id' => $request->get('sala'),'periodo_id' => $request->get('periodo'),'curso_id' => $request->get('curso'),'permanencia' => 'semestral','dia' => $request->get('dia')]);
                    $mar->save();
                    }
                }
                if($request->get('dia') == 'miercoles')
                {
                    $miercoles = new Carbon('this wednesday');
                    if($miercoles <= $termino)
                    {
                    $mier = new Horario();
                    $mier->fill(['fecha' => $miercoles,'sala_id' => $request->get('sala'),'periodo_id' => $request->get('periodo'),'curso_id' => $request->get('curso'),'permanencia' => 'semestral','dia' => $request->get('dia')]);
                    $mier->save();
                    }
                }
                if($request->get('dia') == 'jueves')
                {
                    $jueves = new Carbon('this thursday');
                    if($jueves <= $termino)
                    {
                    $jue = new Horario();
                    $jue->fill(['fecha' => $jueves,'sala_id' => $request->get('sala'),'periodo_id' => $request->get('periodo'),'curso_id' => $request->get('curso'),'permanencia' => 'semestral','dia' => $request->get('dia')]);
                    $jue->save();
                    }
                }
                if($request->get('dia') == 'viernes')
                {
                    $viernes = new Carbon('this friday');
                    if($viernes <= $termino)
                    {
                    $vier = new Horario();
                    $vier->fill(['fecha' => $viernes,'sala_id' => $request->get('sala'),'periodo_id' => $request->get('periodo'),'curso_id' => $request->get('curso'),'permanencia' => 'semestral','dia' => $request->get('dia')]);
                    $vier->save();
                    }
                }
                if($request->get('dia') == 'sabado')
                {
                    $sabado = new Carbon('this saturday');
                    if($sabado <= $termino)
                    {
                    $sab = new Horario();
                    $sab->fill(['fecha' => $sabado,'sala_id' => $request->get('sala'),'periodo_id' => $request->get('periodo'),'curso_id' => $request->get('curso'),'permanencia' => 'semestral','dia' => $request->get('dia')]);
                    $sab->save();
                    }
                }
                $inicio->addWeek(1);
                
            }
            Session::flash('message', 'La horario fue asignado exitosamente!');
            
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
                'dia' => $request->get('dia')
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
                        'dia' => $request->get('dia')]);
                    $lun->save();
                    }

                }
                if($request->get('dia') == 'martes')
                {
                    $martes = new Carbon('this tuesday');
                    if($martes <= $termino)
                    {
                    $mar = new Horario();
                    $mar->fill(['fecha' => $martes,'sala_id' => $request->get('sala'),'periodo_id' => $request->get('periodo'),'curso_id' => $request->get('curso'),'permanencia' => 'semestral','dia' => $request->get('dia')]);
                    $mar->save();
                    }
                }
                if($request->get('dia') == 'miercoles')
                {
                    $miercoles = new Carbon('this wednesday');
                    if($miercoles <= $termino)
                    {
                    $mier = new Horario();
                    $mier->fill(['fecha' => $miercoles,'sala_id' => $request->get('sala'),'periodo_id' => $request->get('periodo'),'curso_id' => $request->get('curso'),'permanencia' => 'semestral','dia' => $request->get('dia')]);
                    $mier->save();
                    }
                }
                if($request->get('dia') == 'jueves')
                {
                    $jueves = new Carbon('this thursday');
                    if($jueves <= $termino)
                    {
                    $jue = new Horario();
                    $jue->fill(['fecha' => $jueves,'sala_id' => $request->get('sala'),'periodo_id' => $request->get('periodo'),'curso_id' => $request->get('curso'),'permanencia' => 'semestral','dia' => $request->get('dia')]);
                    $jue->save();
                    }
                }
                if($request->get('dia') == 'viernes')
                {
                    $viernes = new Carbon('this friday');
                    if($viernes <= $termino)
                    {
                    $vier = new Horario();
                    $vier->fill(['fecha' => $viernes,'sala_id' => $request->get('sala'),'periodo_id' => $request->get('periodo'),'curso_id' => $request->get('curso'),'permanencia' => 'semestral','dia' => $request->get('dia')]);
                    $vier->save();
                    }
                }
                if($request->get('dia') == 'sabado')
                {
                    $sabado = new Carbon('this saturday');
                    if($sabado <= $termino)
                    {
                    $sab = new Horario();
                    $sab->fill(['fecha' => $sabado,'sala_id' => $request->get('sala'),'periodo_id' => $request->get('periodo'),'curso_id' => $request->get('curso'),'permanencia' => 'semestral','dia' => $request->get('dia')]);
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
}
