<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use App\Http\Requests;

use App\Escuela;

use App\Departamento;

class EscuelaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $escuelas = Escuela::join('departamentos','escuelas.departamento_id','=','departamentos.id')
                            ->select('escuelas.*','departamentos.nombre as departamento')
                            ->get();
        return view('escuela/index',compact('escuelas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $escuelas = Escuela::all('id','nombre');

        return view('escuela/create',compact('escuelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Escuela::create([
            'nombre' => $request->get('nombre'),
            'departamento_id' => $request->get('departamento'),
            'descripcion' => $request->get('descripcion')
            ]);

        return redirect()->route('escuela.index');
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
        $escuela = Escuela::find($id);

        $departamentos = Departamento::all('id','nombre');

        return view('escuela/edit',compact('departamentos','escuela'));
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
        $escuela = Escuela::find($id);

        $escuela->nombre = $request->get('nombre');
        $escuela->departamento_id = $request->get('departamento');
        $escuela->descripcion = $request->get('descripcion');

        $escuela->save();

        Session::flash('message', 'La Escuela ' .$escuela->nombre.' ha sido actualizada');

        return redirect()->route('escuela.index');
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
}
