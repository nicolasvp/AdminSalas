<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use App\Http\Requests;

use App\TipoSala;

class TipoSalaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rol = $this->getRol();

        $tipos = TipoSala::all();

        return view('administrador/tipo_sala/index',compact('tipos','rol'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rol = $this->getRol();

        return view('administrador/tipo_sala/create',compact('rol'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        TipoSala::create([
            'nombre' => $request->get('nombre'),
            'descripcion' => $request->get('descripcion')
            ]);

        return redirect()->route('administrador.tipo_sala.index');
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

        $tipo = TipoSala::find($id);

        return view('administrador/tipo_sala/edit',compact('tipo','rol'));
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
        $tipo = TipoSala::find($id);

        $tipo->nombre = $request->get('nombre');
        $tipo->descripcion = $request->get('descripcion');

        $tipo->save();

        Session::flash('message', 'El Tipo de Sala ' .$tipo->nombre.' ha sido actualizado');

        return redirect()->route('administrador.tipo_sala.index');       
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
                    'nombre' => $value->nombre,
                    'descripcion' => $value->descripcion
                    ]);
            }
        })->get();
        \Storage::delete($nombre);
    
        return redirect()->route('administrador.tipo_sala.index');
            
    }

}
