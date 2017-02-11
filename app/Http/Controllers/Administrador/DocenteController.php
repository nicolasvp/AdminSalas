<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;

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
        $rol = $this->getRol();

        $docentes = Docente::join('departamentos','departamentos.id','=','docentes.departamento_id')
                                ->select('docentes.*','departamentos.nombre as departamento')
                                ->get();

        return view('administrador/docente/index',compact('docentes','rol'));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rol = $this->getRol();

        $departamentos = Departamento::all('id','nombre');

        return view('administrador/docente/create',compact('departamentos','rol'));
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
                'apellidos' => $request->get('apellidos')
            ]);

        return redirect()->route('administrador.docente.index');
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

        $docente = Docente::find($id);

        $departamentos = Departamento::all('id','nombre');

        return view('administrador/docente/edit',compact('docente','departamentos','rol'));
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

        return redirect()->route('administrador.docente.index');
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

    public function excel_download()
    {
        $var = Docente::all();
        \Excel::create('Docentes',function($excel) use ($var)
        {
            $excel->sheet('Sheetname',function($sheet) use ($var)
            {
                $data=[];
                array_push($data, array('DEPARTAMENTO','NOMBRES','APELLIDOS','RUT'));
                foreach($var as $key => $v)
                {
                    $a = \App\RutUtils::dv($v->rut);
                    $rut = $v->rut."-".$a;
                    
                    array_push($data, array($v->departamento_id,$v->nombres,$v->apellidos,$rut,$v->email));
                }       
                $sheet->fromArray($data,null, 'A1', false,false);
            
            });
            
        })->download('xlsx');
            
           return redirect()->route('administrador.docente.index');
    }

}
