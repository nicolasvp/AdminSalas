<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use App\Http\Requests;

use App\Curso;

use App\Asignatura;

use App\Docente;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rol = $this->getRol();

        $cursos = Curso::join('asignaturas','asignaturas.id','=','cursos.asignatura_id')
                        ->join('docentes','docentes.id','=','cursos.docente_id')
                        ->select('cursos.*','asignaturas.nombre as asignatura','docentes.nombres as nombres',
                            'docentes.apellidos as apellidos')
                        ->get();

        return view('administrador/curso/index',compact('cursos','rol'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rol = $this->getRol();

        $docentes = Docente::all();

        $asignaturas = Asignatura::all();

        return view('administrador/curso/create',compact('docentes','asignaturas','rol'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Curso::create([
            'asignatura_id' => $request->get('asignatura'),
            'docente_id' => $request->get('docente'),
            'semestre' => $request->get('semestre'),
            'anio' => $request->get('anio'),
            'seccion' => $request->get('seccion')
            ]);

        return redirect()->route('administrador.curso.index');
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
        $rol = $this->getRol();

        $curso = Curso::find($id);

        $docentes = Docente::all();

        $asignaturas = Asignatura::all();

        return view('administrador/curso/edit',compact('curso','docentes','asignaturas','rol'));
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

        $curso = Curso::find($id);

        $curso->asignatura_id = $request->get('asignatura');
        $curso->docente_id = $request->get('docente');
        $curso->semestre = $request->get('semestre');
        $curso->anio = $request->get('anio');
        $curso->seccion = $request->get('seccion');
        $curso->save();

        $curso_nombre = Curso::join('asignaturas','asignaturas.id','=','cursos.asignatura_id')
                            ->where('cursos.id','=',$id)
                            ->select('asignaturas.nombre')
                            ->get();
                            
        Session::flash('message', 'El curso ' .$curso_nombre->first()->nombre.' ha sido actualizado');

        return redirect()->route('administrador.curso.index');
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

            $curso = Curso::find($id);
       
            if($curso)// Si está el registro
            {
                $curso->delete();
                return response()->json('ok');
            }
            else
            {
                return response()->json('fail');       
            }

        }
    }

    public function excel_download()
    {
        $var = Curso::all();
        \Excel::create('Cursos',function($excel) use ($var)
        {
            $excel->sheet('Sheetname',function($sheet) use ($var)
            {
                $data=[];
                array_push($data, array('ASIGNATURA','DOCENTE','SEMESTRE','ANIO','SECCION'));
                foreach($var as $key => $v)
                {
                    
                    array_push($data, array($v->asignatura_id,$v->docente_id,$v->semestre,$v->anio,$v->seccion));
                }       
                $sheet->fromArray($data,null, 'A1', false,false);
            
            });
            
        })->download('xlsx');
            
           return redirect()->route('administrador.curso.index');
    }    

}
