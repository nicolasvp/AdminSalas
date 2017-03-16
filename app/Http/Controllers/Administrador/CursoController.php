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


    public function create()
    {
        $rol = $this->getRol();

        $docentes = Docente::all();

        $asignaturas = Asignatura::all();

        return view('administrador/curso/create',compact('docentes','asignaturas','rol'));
    }


    public function store(Request $request)
    {
        Curso::create([
            'asignatura_id' => $request->get('asignatura'),
            'docente_id' => $request->get('docente'),
            'semestre' => $request->get('semestre'),
            'anio' => $request->get('anio'),
            'seccion' => $request->get('seccion')
            ]);


        $curso_nombre = Asignatura::where('id',$request->get('asignatura'))->select('nombre')->first();

        Session::flash('message', 'El curso ' .$curso_nombre->nombre.' ha sido creado');

        return redirect()->route('administrador.curso.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $rol = $this->getRol();

        $curso = Curso::find($id);

        $nombre_curso = Asignatura::where('id',$curso->asignatura_id)->select('nombre')->first();

        $docentes = Docente::all();

        $asignaturas = Asignatura::all();

        $semestre = $curso->semestre;

        return view('administrador/curso/edit',compact('curso','docentes','asignaturas','rol','nombre_curso','semestre'));
    }


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

    public function upload(Request $request)
    {
        
        $file = $request->file('file');
    
        $nombre = $file->getClientOriginalName();

        \Storage::disk('local')->put($nombre,  \File::get($file));
        \Excel::load('/storage/app/'.$nombre,function($archivo)
        {
            $result = $archivo->get();
            foreach($result as $key => $value)
            {
                Curso::create([
                    'id' => $value->id,
                    'asignatura_id' => $value->asignatura_id,
                    'docente_id' => $value->docente_id,
                    'semestre' => $value->semestre,
                    'anio' => $value->anio,
                    'seccion' => $value->seccion
                    ]);
                
            }
        })->get();
        \Storage::delete($nombre);
    
        Session::flash('message', 'Los Cursos han sido subidos correctamente!');

        return redirect()->route('administrador.curso.index');
            
    }

    public function excel_download()
    {
        $var = Curso::all();
        \Excel::create('Cursos',function($excel) use ($var)
        {
            $excel->sheet('Sheetname',function($sheet) use ($var)
            {
                $data=[];
                array_push($data, array('ID','ASIGNATURA_ID','DOCENTE_ID','SEMESTRE','ANIO','SECCION'));
                foreach($var as $key => $v)
                {
                    
                    array_push($data, array($v->id, $v->asignatura_id,$v->docente_id,$v->semestre,$v->anio,$v->seccion));
                }       
                $sheet->fromArray($data,null, 'A1', false,false);
            
            });
            
        })->download('xlsx');
            
           return redirect()->route('administrador.curso.index');
    }    

}
