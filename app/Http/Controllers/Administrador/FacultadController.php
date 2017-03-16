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

    public function index()
    {
        $rol = $this->getRol();

        $facultades = Facultad::join('campus','campus.id','=','facultades.campus_id')
                                ->select('facultades.id','facultades.nombre','facultades.descripcion','campus.nombre as campus')
                                ->get();

        return view('administrador/facultad/index',compact('facultades','rol'));
    }

    public function create(Request $request)
    {
        $rol = $this->getRol();

        $campus = Campus::all('id','nombre');

        return view('administrador/facultad/create',compact('campus','rol'));
        
    }

    public function store(Request $request)
    {

        Facultad::create([
            'nombre' => $request->get('nombre'),
            'campus_id' => $request->get('campus'),
            'descripcion' => $request->get('descripcion')
            ]);

        Session::flash('message', 'La Facultad ' .$request->get('nombre').' ha sido creada');

        return redirect()->route('administrador.facultad.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $rol = $this->getRol();

        $facultad = Facultad::find($id);

        $campus = Campus::all('id','nombre');

        return view('administrador/facultad/edit',compact('facultad','campus','rol'));
       
    }

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
                Facultad::create([
                    'id' => $value->id,
                    'nombre' => $value->nombre,
                    'campus_id' => $value->campus_id,
                    'descripcion' => $value->descripcion
                    ]);
                
            }
        })->get();
        \Storage::delete($nombre);
    
        Session::flash('message', 'Las Facultades han sido subidas correctamente!');

        return redirect()->route('administrador.facultad.index');
            
    }

    public function excel_download()
    {
        $var = Facultad::all();
        \Excel::create('Facultades',function($excel) use ($var)
        {
            $excel->sheet('Sheetname',function($sheet) use ($var)
            {
                $data=[];
                array_push($data, array('ID','NOMBRE','CAMPUS_ID','DESCRIPCION'));
                foreach($var as $key => $v)
                {
                    
                    array_push($data, array($v->id,$v->nombre,$v->campus_id,$v->descripcion));
                }       
                $sheet->fromArray($data,null, 'A1', false,false);
            
            });
            
        })->download('xlsx');
            
           return redirect()->route('administrador.facultad.index');
    }


}
