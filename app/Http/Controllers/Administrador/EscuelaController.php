<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use App\Http\Requests;

use App\Escuela;

use App\Departamento;

class EscuelaController extends Controller
{

    public function index()
    {
        $rol = $this->getRol();

        $escuelas = Escuela::join('departamentos','escuelas.departamento_id','=','departamentos.id')
                            ->select('escuelas.*','departamentos.nombre as departamento')
                            ->get();
        return view('administrador/escuela/index',compact('escuelas','rol'));
    }

    public function create()
    {
        $rol = $this->getRol();

        $escuelas = Escuela::all('id','nombre');

        $departamentos = Departamento::all();

        return view('administrador/escuela/create',compact('escuelas','departamentos','rol'));
    }

    public function store(Request $request)
    {
        Escuela::create([
            'nombre' => $request->get('nombre'),
            'departamento_id' => $request->get('departamento'),
            'descripcion' => $request->get('descripcion')
            ]);

        Session::flash('message', 'La Escuela ' .$request->get('nombre').' ha sido creada');

        return redirect()->route('administrador.escuela.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $rol = $this->getRol();

        $escuela = Escuela::find($id);

        $departamentos = Departamento::all('id','nombre');

        return view('administrador/escuela/edit',compact('departamentos','escuela','rol'));
    }

    public function update(Request $request, $id)
    {
        $escuela = Escuela::find($id);

        $escuela->nombre = $request->get('nombre');
        $escuela->departamento_id = $request->get('departamento');
        $escuela->descripcion = $request->get('descripcion');

        $escuela->save();

        Session::flash('message', 'La Escuela ' .$escuela->nombre.' ha sido actualizada');

        return redirect()->route('administrador.escuela.index');
    }

    public function destroy(Request $request,$id)
    {
        if($request->ajax()){

            $escuela = Escuela::find($id);
       
            if($escuela)// Si está el registro
            {
                $escuela->delete();
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
                Escuela::create([
                    'id' => $value->id,
                    'nombre' => $value->nombre,
                    'departamento_id' => $value->departamento_id,
                    'descripcion' => $value->descripcion
                    ]);
                
            }
        })->get();
        \Storage::delete($nombre);
    
        Session::flash('message', 'Las Escuelas han sido subidas correctamente!');

        return redirect()->route('administrador.escuela.index');
            
    }

    public function excel_download()
    {
        $var = Escuela::all();
        \Excel::create('Escuelas',function($excel) use ($var)
        {
            $excel->sheet('Sheetname',function($sheet) use ($var)
            {
                $data=[];
                array_push($data, array('ID','NOMBRE','DEPARTAMENTO_ID','DESCRIPCION'));
                foreach($var as $key => $v)
                {
                    
                    array_push($data, array($v->id, $v->nombre,$v->departamento_id,$v->descripcion));
                }       
                $sheet->fromArray($data,null, 'A1', false,false);
            
            });
            
        })->download('xlsx');
            
           return redirect()->route('administrador.escuela.index');
    }

}
