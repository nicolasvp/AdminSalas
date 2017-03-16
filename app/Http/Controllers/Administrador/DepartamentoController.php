<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use App\Http\Requests;

use App\Departamento;

use App\Facultad;

class DepartamentoController extends Controller
{

    public function index()
    {
        $rol = $this->getRol();

        $departamentos = Departamento::join('facultades','facultades.id','=','departamentos.facultad_id')
                        ->select('departamentos.*','facultades.nombre as facultad')
                        ->get();

        return view('administrador/departamento/index',compact('departamentos','rol'));
    }

    public function create()
    {
        $rol = $this->getRol();

        $facultades = Facultad::all('id','nombre');

        return view('administrador/departamento/create',compact('facultades','rol'));
    }

    public function store(Request $request)
    {
        Departamento::create([
            'nombre' => $request->get('nombre'),
            'facultad_id' => $request->get('facultad'),
            'descripcion' => $request->get('descripcion')
            ]);

        Session::flash('message', 'El Departamento ' .$request->get('nombre').' ha sido creado');

        return redirect()->route('administrador.departamento.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $rol = $this->getRol();

        $departamento = Departamento::find($id);

        $facultades = Facultad::all('id','nombre');

        return view('administrador/departamento/edit',compact('facultades','departamento','rol'));
    }

    public function update(Request $request, $id)
    {
        $departamento = Departamento::find($id);

        $departamento->nombre = $request->get('nombre');
        $departamento->facultad_id = $request->get('facultad');
        $departamento->descripcion = $request->get('descripcion');

        $departamento->save();

        Session::flash('message', 'El Departamento ' .$departamento->nombre.' ha sido actualizado');

        return redirect()->route('administrador.departamento.index');
    }

    public function destroy(Request $request, $id)
    {
        if($request->ajax()){

            $departamento = Departamento::find($id);
       
            if($departamento)// Si está el registro
            {
                $departamento->delete();
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
                Departamento::create([
                    'id' => $value->id,
                    'nombre' => $value->nombre,
                    'facultad_id' => $value->facultad_id,
                    'descripcion' => $value->descripcion
                    ]);
                
            }
        })->get();
        \Storage::delete($nombre);
    
        Session::flash('message', 'Los Departamentos han sido subidos correctamente!');

        return redirect()->route('administrador.departamento.index');
            
    }

    public function excel_download()
    {
        $var = Departamento::all();
        \Excel::create('Departamentos',function($excel) use ($var)
        {
            $excel->sheet('Sheetname',function($sheet) use ($var)
            {
                $data=[];
                array_push($data, array('ID','NOMBRE','FACULTAD_ID','DESCRIPCION'));
                foreach($var as $key => $v)
                {
                    
                    array_push($data, array($v->id,$v->nombre,$v->facultad_id,$v->descripcion));
                }       
                $sheet->fromArray($data,null, 'A1', false,false);
            
            });
            
        })->download('xlsx');
            
           return redirect()->route('administrador.departamento.index');
    }


}
