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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departamentos = Departamento::join('facultades','facultades.id','=','departamentos.facultad_id')
                        ->select('departamentos.*','facultades.nombre as facultad')
                        ->get();

        return view('administrador/departamento/index',compact('departamentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $facultades = Facultad::all('id','nombre');

        return view('administrador/departamento/create',compact('facultades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Departamento::create([
            'nombre' => $request->get('nombre'),
            'facultad_id' => $request->get('facultad'),
            'descripcion' => $request->get('descripcion')
            ]);

        return redirect()->route('departamento.index');
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
        $departamento = Departamento::find($id);

        $facultades = Facultad::all('id','nombre');

        return view('administrador/departamento/edit',compact('facultades','departamento'));
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
        $departamento = Departamento::find($id);

        $departamento->nombre = $request->get('nombre');
        $departamento->facultad_id = $request->get('facultad');
        $departamento->descripcion = $request->get('descripcion');

        $departamento->save();

        Session::flash('message', 'El Departamento ' .$departamento->nombre.' ha sido actualizado');

        return redirect()->route('departamento.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
}
