<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;

use App\Facultad;
use App\Campus;

class FacultadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facultades = Facultad::join('campus','campus.id','=','facultades.campus_id')
                                ->select('facultades.id','facultades.nombre','facultades.descripcion','campus.nombre as campus')
                                ->get();

        return view('facultad/index',compact('facultades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $campus = Campus::all('id','nombre');

        return view('facultad/create',compact('campus'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Facultad::create([
            'nombre' => $request->get('nombre'),
            'campus_id' => $request->get('campus'),
            'descripcion' => $request->get('descripcion')
            ]);

        return redirect()->route('facultad.index');
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

        $facultad = Facultad::find($id);

        $campus = Campus::all('id','nombre');

        return view('facultad/edit',compact('facultad','campus'));
       
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
        $facultad = Facultad::find($id);

        $facultad->nombre = $request->get('nombre');
        $facultad->campus_id = $request->get('campus');
        $facultad->descripcion = $request->get('descripcion');

        $facultad->save();

        Session::flash('message', 'La Facultad ' .$facultad->nombre.' ha sido actualizada');

        return redirect()->route('facultad.index');
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

            $facultad= Facultad::find($id);
       
            if($facultad)// Si está el registro
            {
                $facultad->delete();
                return response()->json('ok');
            }
            else
            {
                return response()->json('fail');       
            }

        }
    }
}
