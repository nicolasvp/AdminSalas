<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

use App\Campus;
use App\Rol_usuario;
use App\Roles;

class CampusController extends Controller
{

    public function index()
    {

        $rol = $this->getRol();

        $campus = Campus::all();
        
        return view('administrador/campus/index',compact('campus','rol'));
    }

    public function create()
    {
        $rol = $this->getRol();

        $encargados = Rol_usuario::join('roles','roles.id','=','roles_usuarios.rol_id')
                                   ->where('roles.nombre','Encargado')
                                   ->select('roles_usuarios.rut')
                                   ->get();

        return view('administrador/campus/create',compact('rol','encargados'));
    }

    public function store(Request $request)
    {
    

        Campus::create([
            'nombre' => $request->get('nombre'),
            'direccion' => $request->get('direccion'),
            'descripcion' => $request->get('descripcion'),
            'rut_encargado' => $request->get('encargado')
            ]);

        Session::flash('message', 'El Campus ' .$request->get('nombre').' ha sido creado');

        return redirect()->route('administrador.campus.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $rol = $this->getRol();

        $campus = Campus::find($id);

        $encargados = Rol_usuario::join('roles','roles.id','=','roles_usuarios.rol_id')
                                   ->where('roles.nombre','Encargado')
                                   ->select('roles_usuarios.rut')
                                   ->get();

        return view('administrador/campus/edit',compact('campus','rol','encargados'));
       
    }

    public function update(Request $request, $id)
    {

        $campus = Campus::find($id);

        $campus->nombre = $request->get('nombre');
        $campus->direccion = $request->get('direccion');
        $campus->descripcion = $request->get('descripcion');
        $campus->rut_encargado = $request->get('encargado');

        $campus->save();

        Session::flash('message', 'El Campus ' .$campus->nombre.' ha sido actualizado');

        return redirect()->route('administrador.campus.index');
    }

    public function destroy(Request $request, $id)
    {
        if($request->ajax()){

            $campus = Campus::find($id);
       
            if($campus)// Si está el registro
            {
                $campus->delete();
                return response()->json('ok');
            }
            else{
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

                Campus::create([
                    'id' => $value->id,
                    'nombre' => $value->nombre,
                    'direccion' => $value->direccion,
                    'descripcion' => $value->descripcion,
                    'rut_encargado' => $value->rut_encargado
                    ]);                    
                
            }
        })->get();
        \Storage::delete($nombre);
    
        Session::flash('message', 'Los Campus han sido subidos correctamente!');

        return redirect()->route('administrador.campus.index');
            
    }

    public function excel_download()
    {
        $var = Campus::all();
        \Excel::create('Campus',function($excel) use ($var)
        {
            $excel->sheet('Sheetname',function($sheet) use ($var)
            {
                $data=[];
                array_push($data, array('ID','NOMBRE','DIRECCION','DESCRIPCION','RUT_ENCARGADO'));
                foreach($var as $key => $v)
                {
                    array_push($data, array($v->id,$v->nombre,$v->direccion,$v->descripcion,$v->rut_encargado));
                }       
                $sheet->fromArray($data,null, 'A1', false,false);
            
            });
            
        })->download('xlsx');
            
           return redirect()->route('administrador.campus.index');
    }

}
