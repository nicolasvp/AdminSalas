<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use App\Http\Requests;

use App\Sala;

use App\Campus;

use App\TipoSala;

class SalaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salas = Sala::join('campus','campus.id','=','salas.campus_id')
                    ->join('tipos_salas','tipos_salas.id','=','salas.tipo_sala_id')
                    ->select('salas.*','campus.nombre as campus','tipos_salas.nombre as tipo')
                    ->get();

        return view('sala/index',compact('salas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $campus = Campus::all();

        $tipos = TipoSala::all();

        return view('sala/create',compact('campus','tipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Sala::create([
            'campus_id' => $request->get('campus'),
            'tipo_sala_id' => $request->get('tipo'),
            'nombre' => $request->get('nombre'),
            'descripcion' => $request->get('descripcion'),
            'capacidad' => $request->get('capacidad')
            ]);

        return redirect()->route('sala.index');
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
        $sala = Sala::find($id);

        $campus = Campus::all();

        $tipos = TipoSala::all();

        return view('sala/edit',compact('sala','campus','tipos'));
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

        $sala = Sala::find($id);

        $sala->campus_id = $request->get('campus');
        $sala->tipo_sala_id = $request->get('tipo');
        $sala->nombre = $request->get('nombre');
        $sala->descripcion = $request->get('descripcion');
        $sala->capacidad = $request->get('capacidad');
        $sala->save();
                            
        Session::flash('message', 'La sala ' .$sala->nombre.' ha sido actualizada');

        return redirect()->route('sala.index');
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
}
