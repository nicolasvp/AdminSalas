<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;

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
        $rol = $this->getRol();

        $facultades = Facultad::join('campus','campus.id','=','facultades.campus_id')
                                ->select('facultades.id','facultades.nombre','facultades.descripcion','campus.nombre as campus')
                                ->get();

        return view('administrador/facultad/index',compact('facultades','rol'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $rol = $this->getRol();

        $campus = Campus::all('id','nombre');

        return view('administrador/facultad/create',compact('campus','rol'));
        
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

        return redirect()->route('administrador.facultad.index');
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

        $facultad = Facultad::find($id);

        $campus = Campus::all('id','nombre');

        return view('administrador/facultad/edit',compact('facultad','campus','rol'));
       
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

        return redirect()->route('administrador.facultad.index');
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

    public function excel_download()
    {
        $var = Facultad::all();
        \Excel::create('Facultades',function($excel) use ($var)
        {
            $excel->sheet('Sheetname',function($sheet) use ($var)
            {
                $data=[];
                array_push($data, array('NOMBRE','CAMPUS','DESCRIPCION'));
                foreach($var as $key => $v)
                {
                    
                    array_push($data, array($v->nombre,$v->campus_id,$v->descripcion));
                }       
                $sheet->fromArray($data,null, 'A1', false,false);
            
            });
            
        })->download('xlsx');
            
           return redirect()->route('administrador.facultad.index');
    }


}
