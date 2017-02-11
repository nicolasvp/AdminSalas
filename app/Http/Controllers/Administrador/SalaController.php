<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use App\Http\Requests;

use App\Sala;

use App\Campus;

use App\TipoSala;

class SalaController extends Controller
{

    public function index()
    {
        $rol = $this->getRol();

        $salas = Sala::join('campus','campus.id','=','salas.campus_id')
                    ->join('tipos_salas','tipos_salas.id','=','salas.tipo_sala_id')
                    ->select('salas.*','campus.nombre as campus','tipos_salas.nombre as tipo')
                    ->get();

        return view('administrador/sala/index',compact('salas','rol'));
    }


    public function create()
    {
        $rol = $this->getRol();

        $campus = Campus::all();

        $tipos = TipoSala::all();

        return view('administrador/sala/create',compact('campus','tipos','rol'));
    }


    public function store(Request $request)
    {

        Sala::create([
            'campus_id' => $request->get('campus'),
            'tipo_sala_id' => $request->get('tipo'),
            'nombre' => $request->get('nombre'),
            'descripcion' => $request->get('descripcion'),
            'capacidad' => $request->get('capacidad'),
            'estado' => $request->get('estado')
            ]);

        return redirect()->route('administrador.sala.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $rol = $this->getRol();
        
        $sala = Sala::find($id);

        $campus = Campus::all();

        $tipos = TipoSala::all();

        return view('administrador/sala/edit',compact('sala','campus','tipos','rol'));
    }


    public function update(Request $request, $id)
    {

        $sala = Sala::find($id);

        $sala->campus_id = $request->get('campus');
        $sala->tipo_sala_id = $request->get('tipo');
        $sala->nombre = $request->get('nombre');
        $sala->descripcion = $request->get('descripcion');
        $sala->capacidad = $request->get('capacidad');
        $sala->estado = $request->get('estado');
        $sala->save();
                            
        Session::flash('message', 'La sala ' .$sala->nombre.' ha sido actualizada');

        return redirect()->route('administrador.sala.index');
    }


    public function destroy(Request $request,$id)
    {
        if($request->ajax()){

            $sala = Sala::find($id);
       
            if($sala)// Si está el registro
            {
                $sala->delete();
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
        $var = Sala::all();
        \Excel::create('Salas',function($excel) use ($var)
        {
            $excel->sheet('Sheetname',function($sheet) use ($var)
            {
                $data=[];
                array_push($data, array('CAMPUS','TIPO_SALA','NOMBRE','DESCRIPCION','CAPACIDAD','ESTADO'));
                foreach($var as $key => $v)
                {
                    
                    array_push($data, array($v->campus_id,$v->tipo_sala_id,$v->nombre,$v->descripcion,$v->capacidad,$v->estado));
                }       
                $sheet->fromArray($data,null, 'A1', false,false);
            
            });
            
        })->download('xlsx');
            
           return redirect()->route('administrador.sala.index');
    }

}
