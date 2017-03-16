<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Session;

use App\Asignatura;

use App\Departamento;

class AsignaturaController extends Controller
{

    public function index()
    {
        $rol = $this->getRol();

        $asignaturas = Asignatura::join('departamentos','departamentos.id','=','asignaturas.departamento_id')
                                ->select('asignaturas.*','departamentos.nombre as departamento')
                                ->get();

        return view('administrador/asignatura/index',compact('asignaturas','rol'));
    }

    public function create()
    {
        $rol = $this->getRol();

        $departamentos = Departamento::all('id','nombre');

        return view('administrador/asignatura/create',compact('departamentos','rol'));
    }

    public function store(Request $request)
    {

        $last_id = Asignatura::select('id')->orderBy('id','desc')->first();

        Asignatura::create([
                'id' => $last_id->id + 1,
                'departamento_id' => $request->get('departamento'),
                'codigo' => $request->get('codigo'),
                'nombre' => $request->get('nombre'),
                'descripcion' => $request->get('descripcion')
            ]);

         Session::flash('message', 'La Asignatura ' .$request->get('nombre').' ha sido creada');

        return redirect()->route('administrador.asignatura.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $rol = $this->getRol();

        $asignatura = Asignatura::find($id);

        $departamentos = Departamento::all('id','nombre');

        return view('administrador/asignatura/edit',compact('asignatura','departamentos','rol'));
    }

    public function update(Request $request, $id)
    {
        $asignatura = Asignatura::find($id);

        $asignatura->departamento_id = $request->get('departamento');
        $asignatura->codigo = $request->get('codigo');
        $asignatura->nombre = $request->get('nombre');
        $asignatura->descripcion = $request->get('descripcion');

        $asignatura->save();

        Session::flash('message', 'La Asignatura ' .$asignatura->nombre.' ha sido actualizada');

        return redirect()->route('administrador.asignatura.index');
    }

    public function destroy(Request $request,$id)
    {
        if($request->ajax()){

            $asignatura = Asignatura::find($id);
       
            if($asignatura)// Si está el registro
            {
                $asignatura->delete();
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
                Asignatura::create([
                    'id' => $value->id,
                    'departamento_id' => $value->departamento_id,
                    'nombre' => $value->nombre,
                    'codigo' => $value->codigo,
                    'descripcion' => $value->descripcion
                    ]);
                
            }
        })->get();
        \Storage::delete($nombre);
    
        Session::flash('message', 'Las Asignaturas han sido subidas correctamente!');

        return redirect()->route('administrador.asignatura.index');
            
    }

    public function excel_download()
    {
        $var = Asignatura::all();
        \Excel::create('Asignaturas',function($excel) use ($var)
        {
            $excel->sheet('Sheetname',function($sheet) use ($var)
            {
                $data=[];
                array_push($data, array('ID','NOMBRE','CODIGO','DESCRIPCION','DEPARTAMENTO_ID'));
                foreach($var as $key => $v)
                {
                    
                    array_push($data, array($v->id,$v->nombre,$v->codigo,$v->descripcion, $v->departamento_id));
                }       
                $sheet->fromArray($data,null, 'A1', false,false);
            
            });
            
        })->download('xlsx');
            
           return redirect()->route('administrador.asignatura.index');
    }
}
