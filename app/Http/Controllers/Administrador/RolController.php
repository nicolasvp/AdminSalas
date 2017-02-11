<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use App\Http\Requests;

use App\Roles;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rol = $this->getRol();

        $roles = Roles::all();

        return view('administrador/rol/index',compact('roles','rol'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rol = $this->getRol();

        return view('administrador/rol/create',compact('rol'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Roles::create([
                'nombre' => $request->get('nombre'),
                'descripcion' => $request->get('descripcion')
            ]);

        return redirect()->route('administrador.rol.index');
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

        $roles = Roles::find($id);

        return view('administrador/rol/edit',compact('roles','rol'));
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
        $rol = Roles::find($id);

        $rol->nombre = $request->get('nombre');
        $rol->descripcion = $request->get('descripcion');

        $rol->save();

        Session::flash('message', 'El Rol ' .$rol->nombre.' ha sido actualizado');

        return redirect()->route('administrador.rol.index');
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

            $rol = Roles::find($id);
       
            if($rol)// Si está el registro
            {
                $rol->delete();
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
        $var = Roles::all();
        \Excel::create('Roles',function($excel) use ($var)
        {
            $excel->sheet('Sheetname',function($sheet) use ($var)
            {
                $data=[];
                array_push($data, array('NOMBRE','DESCRIPCION'));
                foreach($var as $key => $v)
                {
                    
                    array_push($data, array($v->nombre,$v->descripcion));
                }       
                $sheet->fromArray($data,null, 'A1', false,false);
            
            });
            
        })->download('xlsx');
            
           return redirect()->route('administrador.rol.index');
    }    
}
