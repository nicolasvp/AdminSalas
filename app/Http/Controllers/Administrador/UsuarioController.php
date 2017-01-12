<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use App\Http\Requests;

use App\Usuario;

use App\Roles;

use App\Rol_usuario;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::join('roles_usuarios','roles_usuarios.rut','=','usuarios.rut')
                            ->join('roles','roles.id','=','roles_usuarios.rol_id')
                            ->select('usuarios.*','roles.nombre as rol')
                            ->get();

        return view('administrador/usuario/index',compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Roles::all();

        return view('administrador/usuario/create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        Usuario::create([
            'rut' => $request->get('rut'),
            'email' => $request->get('email'),
            'nombres' => $request->get('nombres'),
            'apellidos' => $request->get('apellidos')
            ]);

        foreach($request->get('roles') as $rol)
        {
            Rol_usuario::create([
                'rut' => $request->get('rut'),
                'rol_id' => $rol
                ]);
        }

        return redirect()->route('usuario.index');
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
    public function edit(Request $request,$id)
    {
        if($request->ajax()){

            $usuario = Usuario::find($request->get('id'));
            $roles = Rol_usuario::where('rut',$usuario->rut)->select('rut','rol_id')->get();
            $rolesTotales = Roles::select('id','nombre')->get();
            $respuesta = ['roles' => $rolesTotales, 'roles_usuario' => $roles];
     
            return response()->json($respuesta);
        }
        else
        {
            
            $usuario = Usuario::find($id);

            return view('administrador/usuario/edit',compact('usuario','roles'));
        }

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


        $usuario = Usuario::find($id);

        $usuario->rut = $request->get('rut');
        $usuario->email = $request->get('email');
        $usuario->nombres = $request->get('nombres');
        $usuario->apellidos = $request->get('apellidos');

        $usuario->save();

        //Busca en la tabla rol_usuario el rut que sea igual al rut que viene de la vista(request->get('rutUsuario')) y con el get lo toma
        $roles_usuario = Rol_usuario::where('rut',$request->get('rut'))->get();

        foreach($roles_usuario as $ru)
        {
            $ru->delete();
        }
        foreach($request->get('roles') as $rol)
        {
            Rol_usuario::create([
                'rut' =>$request->get('rut'),
                'rol_id' => $rol
                ]);
        }   

        Session::flash('message', 'El usuario ' .$usuario->nombres.' '.$usuario->apellidos.' ha sido actualizado');

        return redirect()->route('usuario.index');
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

            $usuario = Usuario::find($id);
       
            if($usuario)// Si está el registro
            {
                //$rol = Rol_usuario::where('rut')
                $usuario->delete();

              
                return response()->json('ok');
            }
            else
            {
                return response()->json('fail');       
            }

        }

    }
}
