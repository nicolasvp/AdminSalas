<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Session;

use App\Carrera;

use App\Escuela;

class CarreraController extends Controller
{

    public function index()
    {
        $rol = $this->getRol();

        $carreras = Carrera::join('escuelas','escuelas.id','=','carreras.escuela_id')
                            ->select('carreras.*','escuelas.nombre as escuela')
                            ->get();

        return view('administrador/carrera/index',compact('carreras','rol'));
    }

    public function create()
    {
        $rol = $this->getRol();

        $escuelas = Escuela::all('id','nombre');

        return view('administrador/carrera/create',compact('escuelas','rol'));
    }

    public function store(Request $request)
    {

        $last_id = Carrera::select('id')->orderBy('id', 'desc')->first();

        Carrera::create([
                'id' => $last_id->id + 1,
                'escuela_id' => $request->get('escuela'),
                'codigo' => $request->get('codigo'),
                'nombre' => $request->get('nombre'),
                'descripcion' => $request->get('descripcion')
            ]);

        Session::flash('message', 'La Carrera ' .$request->get('nombre').' ha sido creada');

        return redirect()->route('administrador.carrera.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $rol = $this->getRol();

        $carrera = Carrera::find($id);

        $escuelas = Escuela::all('id','nombre');

        return view('administrador/carrera/edit',compact('carrera','escuelas','rol'));
    }

    public function update(Request $request, $id)
    {
        $carrera = Carrera::find($id);

        $carrera->escuela_id = $request->get('escuela');
        $carrera->codigo = $request->get('codigo');
        $carrera->nombre = $request->get('nombre');
        $carrera->descripcion = $request->get('descripcion');

        $carrera->save();

        Session::flash('message', 'La Carrera ' .$carrera->nombre.' ha sido actualizada');

        return redirect()->route('administrador.carrera.index');
    }

    public function destroy(Request $request,$id)
    {
        if($request->ajax()){

            $carrera = Carrera::find($id);
       
            if($carrera)// Si está el registro
            {
                $carrera->delete();
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
                Carrera::create([
                    'id' => $value->id,
                    'escuela_id' => $value->escuela_id,
                    'nombre' => $value->nombre,
                    'codigo' => $value->codigo,
                    'descripcion' => $value->descripcion
                    ]);
                
            }
        })->get();
        \Storage::delete($nombre);
    
        Session::flash('message', 'Las Carreras han sido subidas correctamente!');

        return redirect()->route('administrador.carrera.index');
            
    }

    public function excel_download()
    {
        $var = Carrera::all();
        \Excel::create('Carreras',function($excel) use ($var)
        {
            $excel->sheet('Sheetname',function($sheet) use ($var)
            {
                $data=[];
                array_push($data, array('ID','NOMBRE','ESCUELA_ID','CODIGO','DESCRIPCION'));
                foreach($var as $key => $v)
                {
                    
                    array_push($data, array($v->id,$v->nombre,$v->escuela_id,$v->codigo,$v->descripcion));
                }       
                $sheet->fromArray($data,null, 'A1', false,false);
            
            });
            
        })->download('xlsx');
            
           return redirect()->route('administrador.carrera.index');
    }

}
