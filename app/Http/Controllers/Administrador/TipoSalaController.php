<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use App\Http\Requests;

use App\TipoSala;

class TipoSalaController extends Controller
{

    public function index()
    {
        $rol = $this->getRol();

        $tipos = TipoSala::all();

        return view('administrador/tipo_sala/index',compact('tipos','rol'));
    }


    public function create()
    {
        $rol = $this->getRol();

        return view('administrador/tipo_sala/create',compact('rol'));
    }


    public function store(Request $request)
    {
        TipoSala::create([
            'nombre' => $request->get('nombre'),
            'descripcion' => $request->get('descripcion')
            ]);

        Session::flash('message', 'El Tipo de Sala ' .$request->get('nombre').' ha sido creado');

        return redirect()->route('administrador.tipo_sala.index');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $rol = $this->getRol();

        $tipo = TipoSala::find($id);

        return view('administrador/tipo_sala/edit',compact('tipo','rol'));
    }


    public function update(Request $request, $id)
    {
        $tipo = TipoSala::find($id);

        $tipo->nombre = $request->get('nombre');
        $tipo->descripcion = $request->get('descripcion');

        $tipo->save();

        Session::flash('message', 'El Tipo de Sala ' .$tipo->nombre.' ha sido actualizado');

        return redirect()->route('administrador.tipo_sala.index');       
    }


    public function destroy(Request $request,$id)
    {
        if($request->ajax()){

            $tipo = TipoSala::find($id);
       
            if($tipo)// Si está el registro
            {
                $tipo->delete();
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
                TipoSala::create([
                    'id' => $value->id,
                    'nombre' => $value->nombre,
                    'descripcion' => $value->descripcion
                    ]);
            }
        })->get();
        \Storage::delete($nombre);
    
        return redirect()->route('administrador.tipo_sala.index');
            
    }

    public function excel_download()
    {
        $var = TipoSala::all();
        \Excel::create('TiposSalas',function($excel) use ($var)
        {
            $excel->sheet('Sheetname',function($sheet) use ($var)
            {
                $data=[];
                array_push($data, array('ID','NOMBRE','DESCRIPCION'));
                foreach($var as $key => $v)
                {
                    array_push($data, array($v->id, $v->nombre,$v->descripcion));
                }       
                $sheet->fromArray($data,null, 'A1', false,false);
            
            });
            
        })->download('xlsx');
            
           return redirect()->route('administrador.tipo_sala.index');
    }    

}
