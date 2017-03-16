<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use App\Http\Requests;

use App\Periodo;

class PeriodoController extends Controller
{

    public function index()
    {
        $rol = $this->getRol();

        $periodos = Periodo::all();

        return view('administrador/periodo/index',compact('periodos','rol'));
    }

    public function create()
    {
        $rol = $this->getRol();

        return view('administrador/periodo/create',compact('rol'));
    }

    public function store(Request $request)
    {
        Periodo::create([
                'bloque' => $request->get('bloque'),
                'inicio' => $request->get('inicio'),
                'fin' => $request->get('fin')
            ]);

        Session::flash('message', 'El Periodo ' .$request->get('bloque').' ha sido creado');

        return redirect()->route('administrador.periodo.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $rol = $this->getRol();

        $periodo = Periodo::find($id);

        return view('administrador/periodo/edit',compact('periodo','rol'));
    }

    public function update(Request $request, $id)
    {
        $periodo = Periodo::find($id);

        $periodo->bloque = $request->get('bloque');
        $periodo->inicio = $request->get('inicio');
        $periodo->fin = $request->get('fin');

        $periodo->save();

        Session::flash('message', 'El Periodo ' .$periodo->bloque.' ha sido actualizado');

        return redirect()->route('administrador.periodo.index');
    }

    public function destroy(Request $request,$id)
    {
        if($request->ajax()){

            $perido = Periodo::find($id);
       
            if($perido)// Si está el registro
            {
                $perido->delete();
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
				Periodo::create([
                    'id' => $value->id,
					'bloque' => $value->bloque,
					'inicio' => $value->inicio,
					'fin' => $value->fin
					]);
			}
		})->get();
		\Storage::delete($nombre);
	
	    return redirect()->route('administrador.periodo.index');
	      	
    }

    public function excel_download()
    {
        $var = Periodo::all();
        \Excel::create('Periodos',function($excel) use ($var)
        {
            $excel->sheet('Sheetname',function($sheet) use ($var)
            {
                $data=[];
                array_push($data, array('ID','BLOQUE','INICIO','FIN'));
                foreach($var as $key => $v)
                {
                    array_push($data, array($v->id, $v->bloque,$v->inicio,$v->fin));
                }       
                $sheet->fromArray($data,null, 'A1', false,false);
            
            });
            
        })->download('xlsx');
            
           return redirect()->route('administrador.periodo.index');
    } 

}
