<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Session;

use App\Carrera;

use App\Escuela;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carreras = Carrera::join('escuelas','escuelas.id','=','carreras.escuela_id')
                            ->select('carreras.*','escuelas.nombre as escuela')
                            ->get();

        return view('administrador/carrera/index',compact('carreras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $escuelas = Escuela::all('id','nombre');

        return view('administrador/carrera/create',compact('escuelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Carrera::create([
                'escuela_id' => $request->get('escuela'),
                'codigo' => $request->get('codigo'),
                'nombre' => $request->get('nombre'),
                'descripcion' => $request->get('descripcion')
            ]);

        return redirect()->route('carrera.index');
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
        $carrera = Carrera::find($id);

        $escuelas = Escuela::all('id','nombre');

        return view('administrador/carrera/edit',compact('carrera','escuelas'));
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
        $carrera = Carrera::find($id);

        $carrera->escuela_id = $request->get('escuela');
        $carrera->codigo = $request->get('codigo');
        $carrera->nombre = $request->get('nombre');
        $carrera->descripcion = $request->get('descripcion');

        $carrera->save();

        Session::flash('message', 'La Carrera ' .$carrera->nombre.' ha sido actualizada');

        return redirect()->route('carrera.index');
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

            $carrera = Carrera::find($id);
       
            if($carrera)// Si está el registro
            {
                $carrera->delete();
                return response()->json('ok');
            }
            else
            {
                return response()->json('fail');       
            }

        }
    }
}
