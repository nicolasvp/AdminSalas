<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use App\Http\Requests;

use App\Docente;

use App\Departamento;

use App\User;

use App\RutUtils;

use App\Roles;

use App\Rol_usuario;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;


class DocenteController extends Controller
{

    public function index()
    {
        $rol = $this->getRol();

        $docentes = Docente::join('departamentos','departamentos.id','=','docentes.departamento_id')
                                ->select('docentes.*','departamentos.nombre as departamento')
                                ->get();

        return view('administrador/docente/index',compact('docentes','rol'));        
    }

    public function create()
    {
        $rol = $this->getRol();

        $departamentos = Departamento::all('id','nombre');

        return view('administrador/docente/create',compact('departamentos','rol'));
    }

    public function store(Request $request)
    {

    	$usuario = User::where('rut',$request->get('rut'))->select('nombres','apellidos','rut')->first();

    	//Si no existe el usuario
    	if(!$usuario)
    	{
  			User::create([
	            'rut' => $request->get('rut'),
	            'email' => '',
	            'nombres' => $request->get('nombres'),
	            'apellidos' => $request->get('apellidos'),
	            'password' => bcrypt($request->get('rut'))
  				]);
    	}

        Docente::create([
                'departamento_id' => $request->get('departamento'),
                'rut' => $request->get('rut'),
                'nombres' => $request->get('nombres'),
                'apellidos' => $request->get('apellidos')
            ]);   	

        $id_rol_docente = Roles::where('nombre','Docente')->select('id')->first();

        Rol_usuario::create([
            'rut' => $request->get('rut'),
            'rol_id' => $id_rol_docente->id
            ]);      	


        Session::flash('message', 'El Docente ' .$request->get('nombres').' '.$request->get('apellidos').' ha sido creado');

        return redirect()->route('administrador.docente.index');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $rol = $this->getRol();

        $docente = Docente::find($id);

        $departamentos = Departamento::all('id','nombre');

        return view('administrador/docente/edit',compact('docente','departamentos','rol'));
    }


    public function update(Request $request, $id)
    {
        $docente = Docente::find($id);

        $usuario = User::where('rut',$docente->rut)->select('*')->first();
        $usuario->rut = $request->get('rut');
        $usuario->nombres = $request->get('nombres');
        $usuario->apellidos = $request->get('apellidos');
        $usuario->save();

        $docente->departamento_id = $request->get('departamento');
        $docente->rut = $request->get('rut');
        $docente->nombres = $request->get('nombres');
        $docente->apellidos = $request->get('apellidos');
        $docente->save();

        Session::flash('message', 'El Docente ' .$docente->nombres.' '.$docente->apellidos.' ha sido actualizado');

        return redirect()->route('administrador.docente.index');
    }

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

    public function upload(Request $request)
    {
        
        $file = $request->file('file');
    
        $nombre = $file->getClientOriginalName();

        \Storage::disk('local')->put($nombre,  \File::get($file));
        \Excel::load('/storage/app/'.$nombre,function($archivo)
        {
            $result = $archivo->get();
            foreach($result as $key => $value)
            {
                $usuario = User::where('rut',$value->rut)->first();

                // Si existe el usuario en la bdd entonces crea en la tabla docente y rol_usuario
                if($usuario)
                {
                    Docente::create([
                    'id' => $value->id,
                    'departamento_id' => $value->departamento_id,
                    'nombres' => $value->nombres,
                    'apellidos' => $value->apellidos,
                    'rut' => $value->rut
                    ]);

                    $id_rol_docente = Roles::where('nombre','Docente')->select('id')->first();

                    Rol_usuario::create([
                        'rut' => $value->rut,
                        'rol_id' => $id_rol_docente->id
                        ]);

                }
                // Si no existe en la bdd entonces lo ingresa en users, docentes y rol_usuario
                else
                {

                    User::create([
                        'rut' => $value->rut,
                        'email' => $value->email,
                        'nombres' => $value->nombres,
                        'apellidos' => $value->apellidos,
                        'password' => bcrypt($value->rut)
                        ]);

                    Docente::create([
                        'id' => $value->id,
                        'departamento_id' => $value->departamento_id,
                        'nombres' => $value->nombres,
                        'apellidos' => $value->apellidos,
                        'rut' => $value->rut
                    ]);
                
                    $id_rol_docente = Roles::where('nombre','Docente')->select('id')->first();

                    Rol_usuario::create([
                        'rut' => $value->rut,
                        'rol_id' => $id_rol_docente->id
                        ]); 

                }

                
            }
        })
        ->get();

        \Storage::delete($nombre);
    
        Session::flash('message', 'Los Docentes han sido subidos correctamente!');

        return redirect()->route('administrador.docente.index');
            
    }

    public function excel_download()
    {
        $var = Docente::join('users','docentes.rut','=','users.rut')->select('docentes.*','users.email')->get();
        \Excel::create('Docentes',function($excel) use ($var)
        {
            $excel->sheet('Sheetname',function($sheet) use ($var)
            {
                $data=[];
                array_push($data, array('ID','NOMBRES','APELLIDOS','RUT','EMAIL','DEPARTAMENTO_ID'));
                foreach($var as $key => $v)
                {

                    array_push($data, array($v->id,$v->nombres,$v->apellidos,$v->rut,$v->email,$v->departamento_id));
                }       
                $sheet->fromArray($data,null, 'A1', false,false);
            
            });
            
        })->download('xlsx');
            
           return redirect()->route('administrador.docente.index');
    }

}
