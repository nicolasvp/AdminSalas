<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

use App\Campus;
use App\Rol_usuario;
use App\Roles;

class CampusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // dd(Auth::user());
        $campus = Campus::all();
        
        return view('administrador/campus/index',compact('campus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrador/campus/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        Campus::create([
            'nombre' => $request->get('nombre'),
            'direccion' => $request->get('direccion'),
            'descripcion' => $request->get('descripcion'),
            'rut_encargado' => '18117925'
            ]);
        return redirect()->route('administrador.campus.index');
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
        $campus = Campus::find($id);

        return view('administrador/campus/edit',compact('campus'));
       
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
        $campus = Campus::find($id);

        $campus->nombre = $request->get('nombre');
        $campus->direccion = $request->get('direccion');
        $campus->descripcion = $request->get('descripcion');
        $campus->rut_encargado = $request->get('rut_encargado');

        $campus->save();

        Session::flash('message', 'El Campus ' .$campus->nombre.' ha sido actualizado');

        return redirect()->route('administrador.campus.index');
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

            $campus = Campus::find($id);
       
            if($campus)// Si está el registro
            {
                $campus->delete();
                return response()->json('ok');
            }
            else{
                return response()->json('fail');       
            }

        }

    }
}
