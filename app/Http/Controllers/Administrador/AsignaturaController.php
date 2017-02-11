<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Session;

use App\Asignatura;

use App\Departamento;

class AsignaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rol = $this->getRol();

        $asignaturas = Asignatura::join('departamentos','departamentos.id','=','asignaturas.departamento_id')
                                ->select('asignaturas.*','departamentos.nombre as departamento')
                                ->get();

        return view('administrador/asignatura/index',compact('asignaturas','rol'));
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

        return view('administrador/asignatura/create',compact('departamentos','rol'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Asignatura::create([
                'departamento_id' => $request->get('departamento'),
                'codigo' => $request->get('codigo'),
                'nombre' => $request->get('nombre'),
                'descripcion' => $request->get('descripcion')
            ]);

        return redirect()->route('administrador.asignatura.index');
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

        $asignatura = Asignatura::find($id);

        $departamentos = Departamento::all('id','nombre');

        return view('administrador/asignatura/edit',compact('asignatura','departamentos','rol'));
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
        $asignatura = Asignatura::find($id);

        $asignatura->departamento_id = $request->get('departamento');
        $asignatura->codigo = $request->get('codigo');
        $asignatura->nombre = $request->get('nombre');
        $asignatura->descripcion = $request->get('descripcion');

        $asignatura->save();

        Session::flash('message', 'La Asignatura ' .$asignatura->nombre.' ha sido actualizada');

        return redirect()->route('administrador.asignatura.index');
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

            $asignatura = Asignatura::find($id);
       
            if($asignatura)// Si está el registro
            {
                $asignatura->delete();
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
        $var = Asignatura::all();
        \Excel::create('Asignaturas',function($excel) use ($var)
        {
            $excel->sheet('Sheetname',function($sheet) use ($var)
            {
                $data=[];
                array_push($data, array('DEPARTAMENTO','CODIGO','NOMBRE','DESCRIPCION'));
                foreach($var as $key => $v)
                {
                    
                    array_push($data, array($v->departamento_id,$v->codigo,$v->nombre,$v->descripcion));
                }       
                $sheet->fromArray($data,null, 'A1', false,false);
            
            });
            
        })->download('xlsx');
            
           return redirect()->route('administrador.asignatura.index');
    }
}
