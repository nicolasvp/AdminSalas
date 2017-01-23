<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use App\Http\Requests;

use App\Periodo;

class PeriodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rol = $this->getRol();

        $periodos = Periodo::all();

        return view('administrador/periodo/index',compact('periodos','rol'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rol = $this->getRol();

        return view('administrador/periodo/create',compact('rol'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Periodo::create([
                'bloque' => $request->get('bloque'),
                'inicio' => $request->get('inicio'),
                'fin' => $request->get('fin')
            ]);

        return redirect()->route('administrador.periodo.index');
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

        $periodo = Periodo::find($id);

        return view('administrador/periodo/edit',compact('periodo','rol'));
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
        $periodo = Periodo::find($id);

        $periodo->bloque = $request->get('bloque');
        $periodo->inicio = $request->get('inicio');
        $periodo->fin = $request->get('fin');

        $periodo->save();

        Session::flash('message', 'El Periodo ' .$periodo->bloque.' ha sido actualizado');

        return redirect()->route('administrador.periodo.index');
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
					'bloque' => $value->bloque,
					'inicio' => $value->inicio,
					'fin' => $value->fin
					]);
			}
		})->get();
		\Storage::delete($nombre);
	
	    return redirect()->route('administrador.periodo.index');
	      	
    }


}
