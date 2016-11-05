<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use App\Http\Requests;

use App\Docente;

use App\Departamento;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $docentes = Docente::join('departamentos','departamentos.id','=','docentes.departamento_id')
                                ->select('docentes.*','departamentos.nombre as departamento')
                                ->get();

        return view('docente/index',compact('docentes'));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departamentos = Departamento::all('id','nombre');

        return view('docente/create',compact('departamentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Docente::create([
                'departamento_id' => $request->get('departamento'),
                'rut' => $request->get('rut'),
                'nombres' => $request->get('nombres'),
                'apellidos' => $request->get('apellidos'),
                'email' => $request->get('email')
            ]);

        return redirect()->route('docente.index');
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
        $docente = Docente::find($id);

        $departamentos = Departamento::all('id','nombre');

        return view('docente/edit',compact('docente','departamentos'));
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
        $docente = Docente::find($id);

        $docente->departamento_id = $request->get('departamento');
        $docente->rut = $request->get('rut');
        $docente->nombres = $request->get('nombres');
        $docente->apellidos = $request->get('apellidos');
        $docente->email = $request->get('email');

        $docente->save();

        Session::flash('message', 'El Docente ' .$docente->nombres.' '.$docente->apellidos.' ha sido actualizado');

        return redirect()->route('docente.index');
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

            $docente = Docente::find($id);
       
            if($docente)// Si está el registro
            {
                $docente->delete();
                return response()->json('ok');
            }
            else
            {
                return response()->json('fail');       
            }

        }
    }
}
