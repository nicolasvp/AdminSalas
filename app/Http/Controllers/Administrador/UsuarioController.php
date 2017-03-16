<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use App\Http\Requests;

use App\User;

use App\Roles;

use App\Rol_usuario;

use App\Departamento;

use App\Docente;

class UsuarioController extends Controller
{

    public function index()
    {
        $rol = $this->getRol();

        $usuarios = User::join('roles_usuarios','roles_usuarios.rut','=','users.rut')
                            ->join('roles','roles.id','=','roles_usuarios.rol_id')
                            ->select('users.*','roles.nombre as rol')
                            ->get();

        return view('administrador/usuario/index',compact('usuarios','rol'));
    }

    public function create()
    {
        $rol = $this->getRol();

        $roles = Roles::all();

        $departamentos = Departamento::all();

        return view('administrador/usuario/create',compact('roles','rol','departamentos'));
    }


    public function store(Request $request)
    {

        User::create([
            'rut' => $request->get('rut'),
            'email' => $request->get('email'),
            'nombres' => $request->get('nombres'),
            'apellidos' => $request->get('apellidos'),
            'password' => bcrypt($request->get('rut'))
            ]);
        
        $rol_docente = Roles::find($request->get('rol'));

        if($rol_docente->nombre == 'Docente')
        {
            Docente::create([
                'rut' => $request->get('rut'),
                'nombres' => $request->get('nombres'),
                'apellidos' => $request->get('apellidos'),
                'departamento_id' => $request->get('departamento')             
                ]);
        }
        
        Rol_usuario::create([
            'rut' => $request->get('rut'),
            'rol_id' => $request->get('rol')
            ]);

        Session::flash('message', 'El usuario ' .$request->get('nombres').' '.$request->get('apellidos').' ha sido creado');

        return redirect()->route('administrador.usuario.index');            
        

    }


    public function show($id)
    {
        //
    }

    public function edit(Request $request,$id)
    {
        $rol = $this->getRol();

        $usuario = User::find($id);

        $roles = Roles::all();

        $rol_usuario = Rol_usuario::where('rut',$usuario->rut)->select('rol_id')->first();

        $departamentos = Departamento::all();

        return view('administrador/usuario/edit',compact('usuario','roles','rol','rol_usuario','departamentos'));
        

    }

    public function update(Request $request, $id)
    {

        $usuario = User::find($id);
        $usuario->rut = $request->get('rut');
        $usuario->email = $request->get('email');
        $usuario->nombres = $request->get('nombres');
        $usuario->apellidos = $request->get('apellidos');
        $usuario->save();

        $usuario_docente = Docente::where('rut',$request->get('rut'))->first();
        
        if($request->get('rol') == '3')
        {
            if($usuario_docente)
            {
                $usuario_docente->rut = $request->get('rut');
                $usuario_docente->nombres = $request->get('nombres');
                $usuario_docente->apellidos = $request->get('apellidos');
                $usuario_docente->save();                
            }
            else
            {
                Docente::create([
                    'nombres' => $request->get('nombres'),
                    'apellidos' => $request->get('apellidos'),
                    'rut' => $request->get('rut'),
                    'departamento_id' => $request->get('departamento')
                    ]);
            }
        }

        if($request->get('rol') != '3')
        {
            if($usuario_docente)
            {
                $docente = Docente::where('rut',$request->get('rut'))->first();
                $docente->delete();                
            }
        }

        $rol_usuario = Rol_usuario::where('rut',$request->get('rut'))->first();
        $rol_usuario->rol_id = $request->get('rol');
        $rol_usuario->save();

        Session::flash('message', 'El usuario ' .$usuario->nombres.' '.$usuario->apellidos.' ha sido actualizado');

        return redirect()->route('administrador.usuario.index');
    }


    public function destroy(Request $request,$id)
    {
        if($request->ajax()){

            $usuario = User::find($id);
       
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

    public function excel_download()
    {
        $var = User::all();
        \Excel::create('Usuarios',function($excel) use ($var)
        {
            $excel->sheet('Sheetname',function($sheet) use ($var)
            {
                $data=[];
                array_push($data, array('RUT','EMAIL','NOMBRES','APELLIDOS'));
                foreach($var as $key => $v)
                {
                    $a = \App\RutUtils::dv($v->rut);
                    $rut = $v->rut."-".$a;
                    
                    array_push($data, array($rut,$v->email,$v->nombres,$v->apellidos));
                }       
                $sheet->fromArray($data,null, 'A1', false,false);
            
            });
            
        })->download('xlsx');
            
           return redirect()->route('administrador.usuario.index');
    }
    
}
