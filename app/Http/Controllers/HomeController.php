<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rol_usuario;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //dd(Auth::user());
        //return view('home');
        $rut = Auth::user()->rut;

        $rol_usuario = Rol_usuario::join('roles','roles_usuarios.rol_id','=','roles.id')
                            ->where('roles_usuarios.rut','=',$rut)
                            ->select('roles.nombre')
                            ->get(); 

        $rol = $rol_usuario->first()->nombre;

        if($rol == 'Administrador')
        {
            return view('administrador/index',compact('rol'));
        }
        if($rol == 'Encargado')
        {
            return redirect()->route('encargado.horario.index',compact('rol'));
        }        
        if($rol == 'Estudiante')
        {
            return redirect()->route('alumno..index',compact('rol'));
        }
        if($rol == 'Docente')
        {
            return redirect()->route('docente..index',compact('rol'));
        }


        //Auth::guard($this->getGuard())->logout();

        return redirect()->action('Auth\AuthController@logout');  
    }

}
