<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Http\Requests;

use App\Horario;

use App\Campus;

use App\Sala;

use App\Curso;

use App\Carrera;

use DB;

class EstadisticaController extends Controller
{

    public function index(Request $request)
    {
        $rol = $this->getRol();

        $campus = Campus::all();

        $anios = DB::select("select distinct(extract(year from fecha)) as anio from horarios");

        return view('administrador.estadisticas.index',compact('rol','campus','anios'));
    }

    /*===================================== ESTADÍSTICAS POR SALAS ==============================================*/
    public function salas(Request $request)
	{
    	$condicion = '0 = 0';

    	if($request->get('fecha_inicio') != '' && $request->get('fecha_termino') != '')
    	{
    		$fecha_inicio = date_format(date_create($request->get('fecha_inicio')),"Y-m-d");
    		$fecha_termino = date_format(date_create($request->get('fecha_termino')),"Y-m-d");
            $condicion .= " and a.fecha between to_date('".$fecha_inicio."','YYYY-MM-DD') and to_date('".$fecha_termino."','YYYY-MM-DD')"; 
    	}    

    	if($request->get('campus'))
    	{
    		$condicion .= " and b.campus_id = ".$request->get('campus');
    	}
    	
    	if($request->get('semestre'))
    	{
    		$condicion .= " and c.semestre = ".$request->get('semestre');
    	}

    	if($request->get('anio'))
    	{
    		$condicion .= " and extract(year from a.fecha) = ".$request->get('anio');
    	}

    	if($request->get('elemento'))
    	{
    		$condicion .= " and b.id = ".$request->get('elemento');
    	}

        //Cantidad de horarios por salas
		$horarios = DB::select("select b.nombre, count(a.sala_id) as cantidad
				                from
				                horarios a
				                inner join salas b on a.sala_id = b.id
				                inner join cursos c on a.curso_id = c.id
				                where ".$condicion."
				                group by b.nombre order by cantidad desc");


        $arreglo = [];

        foreach ($horarios as $key => $value) {
          
            $arreglo[] = [$value->nombre,$value->cantidad];

        }
           
    
        return response()->json($arreglo);       

    }
    /*====================================== FIN ESTADÍSTICAS SALAS ==========================================================*/


    /*====================================== ESTADÍSTICAS POR CURSOS ================================================*/
    public function cursos(Request $request)
    {
    	$condicion = '0 = 0';

    	if($request->get('fecha_inicio') != '' && $request->get('fecha_termino') != '')
    	{
    		
    		$fecha_inicio = date_format(date_create($request->get('fecha_inicio')),"Y-m-d");
    		$fecha_termino = date_format(date_create($request->get('fecha_termino')),"Y-m-d");
            $condicion .= " and a.fecha between to_date('".$fecha_inicio."','YYYY-MM-DD') and to_date('".$fecha_termino."','YYYY-MM-DD')";   
    	}    

    	if($request->get('campus'))
    	{
    		$condicion .= " and e.id = ".$request->get('campus');
    	}
    	
    	if($request->get('semestre'))
    	{
    		$condicion .= " and b.semestre = ".$request->get('semestre');
    	}

    	if($request->get('anio'))
    	{
    		$condicion .= " and extract(year from a.fecha) = ".$request->get('anio');
    	}

    	if($request->get('elemento'))
    	{
    		$condicion .= " and b.id = ".$request->get('elemento');
    	}

	    //Cantidad de horarios por cursos
	    $horarios = DB::select("select c.nombre, count(a.curso_id) as cantidad
	                            from
	                            horarios a
	                            inner join cursos b on a.curso_id = b.id
	                            inner join asignaturas c on c.id = b.asignatura_id
                                inner join salas d on d.id = a.sala_id
                                inner join campus e on e.id = d.campus_id	                            
	                            where ".$condicion."
	                            group by c.nombre order by cantidad desc");     		
   
        $arreglo = [];
        foreach ($horarios as $key => $value) {
      
            $arreglo[] = [$value->nombre,$value->cantidad];

        }
           
    
        return response()->json($arreglo);  

    }
    /*======================================= FIN ESTADÍSTICAS CURSOS ==========================================================*/


    /*=========================================== ESTADÍSTICAS POR CARRERAS =============================================*/
    public function carreras(Request $request)
    {

    	$condicion = '0 = 0';

    	if($request->get('fecha_inicio') != '' && $request->get('fecha_termino') != '')
    	{
    		
    		$fecha_inicio = date_format(date_create($request->get('fecha_inicio')),"Y-m-d");
    		$fecha_termino = date_format(date_create($request->get('fecha_termino')),"Y-m-d");
            $condicion .= " and a.fecha between to_date('".$fecha_inicio."','YYYY-MM-DD') and to_date('".$fecha_termino."','YYYY-MM-DD')";   
    	}

    	if($request->get('campus'))
    	{
    		$condicion .= " and h.id = ".$request->get('campus');
    	}
    	
    	if($request->get('semestre'))
    	{
    		$condicion .= " and c.semestre = ".$request->get('semestre');
    	}

    	if($request->get('anio'))
    	{
    		$condicion .= " and extract(year from a.fecha) = ".$request->get('anio');
    	}

    	if($request->get('elemento'))
    	{
    		$condicion .= " and g.id = ".$request->get('elemento');
    	}

    	//Cantidad de horarios por carreras
        $horarios = DB::select("select b.nombre, count(a.sala_id) as cantidad
				                from
				                horarios a
				                inner join salas b on a.sala_id = b.id
				                inner join cursos c on a.curso_id = c.id
				                inner join asignaturas d on d.id = c.asignatura_id
                                inner join departamentos e on e.id = d.departamento_id
                                inner join escuelas f on f.departamento_id = e.id
                                inner join carreras g on g.escuela_id = f.id
                                inner join campus h on h.id = b.campus_id
                                where ".$condicion."
				                group by b.nombre order by cantidad desc");

        $arreglo = [];
        foreach ($horarios as $key => $value) {
            $arreglo[] = [$value->nombre,$value->cantidad];
        }
           
    
        return response()->json($arreglo);
    }
    /*========================================== FIN ESTADÍSTICAS CARRERAS =====================================================*/


    /*=========================================== ESTADÍSTICAS POR CURSOS =============================================*/
    public function asistencia(Request $request)
    {

    	$condicion = '0 = 0';

    	if($request->get('fecha_inicio') != '' && $request->get('fecha_termino') != '')
    	{
    		
    		$fecha_inicio = date_format(date_create($request->get('fecha_inicio')),"Y-m-d");
    		$fecha_termino = date_format(date_create($request->get('fecha_termino')),"Y-m-d");
            $condicion .= " and a.fecha between to_date('".$fecha_inicio."','YYYY-MM-DD') and to_date('".$fecha_termino."','YYYY-MM-DD')";   
    	}


    	if($request->get('campus'))
    	{
    		$condicion .= " and c.id = ".$request->get('campus');
    	}
    	
    	if($request->get('semestre'))
    	{
    		$condicion .= " and d.semestre = ".$request->get('semestre');
    	}

    	if($request->get('anio'))
    	{
    		$condicion .= " and extract(year from a.fecha) = ".$request->get('anio');
    	}

    	if($request->get('elemento'))
    	{
    		$condicion .= " and a.asistencia_docente = '".$request->get('elemento')."'";
    	}


        //Cantidad de horarios por asistencia de docente
        $horarios = DB::select("select a.asistencia_docente, count(a.sala_id) as cantidad
	                            from
	                            horarios a
	                            inner join salas b on a.sala_id = b.id
	                            inner join campus c on c.id = b.campus_id
	                            inner join cursos d on d.id = a.curso_id
	                            where a.asistencia_docente is not null
	                            and ".$condicion."
	                            group by a.asistencia_docente order by cantidad desc");

        $arreglo = [];
        foreach ($horarios as $key => $value) {
            $arreglo[] = [$value->asistencia_docente,$value->cantidad];
        }
           
    
        return response()->json($arreglo);
    }
    /*========================================== FIN ESTADÍSTICAS ASISTENCIA =====================================================*/



    /*=========================================== ESTADÍSTICAS POR ESTADO SALA =============================================*/
    public function estado_salas(Request $request)
    {

    	$condicion = '0 = 0';

    	if($request->get('fecha_inicio') != '' && $request->get('fecha_termino') != '')
    	{
    		
    		$fecha_inicio = date_format(date_create($request->get('fecha_inicio')),"Y-m-d");
    		$fecha_termino = date_format(date_create($request->get('fecha_termino')),"Y-m-d");
            $condicion .= " and a.fecha between to_date('".$fecha_inicio."','YYYY-MM-DD') and to_date('".$fecha_termino."','YYYY-MM-DD')";   
    	}


    	if($request->get('campus'))
    	{
    		$condicion .= " and b.id = ".$request->get('campus');
    	}
    	
    	if($request->get('semestre'))
    	{
    		$condicion .= " and d.semestre = ".$request->get('semestre');
    	}

    	if($request->get('anio'))
    	{
    		$condicion .= " and extract(year from a.fecha) = ".$request->get('anio');
    	}

    	if($request->get('elemento'))
    	{
    		$condicion .= " and a.estado = '".$request->get('elemento')."'";
    	}


        $salas = DB::select("select a.estado, count(a.id) as cantidad
			                from
			                salas a
			                inner join campus b on b.id = a.campus_id
			                where ".$condicion."      
			                group by a.estado order by cantidad desc");

        $arreglo = [];
        foreach ($salas as $key => $value) {
     
            $arreglo[] = [$value->estado,$value->cantidad];

        }
           
    
        return response()->json($arreglo);
    }
    /*========================================== FIN ESTADÍSTICAS ESTADO SALAS =====================================================*/


    /*============================ BUSCA LOS ELEMENTOS DEL SELECT VIA AJAX SEGUN EL TIPO SELECCIONADO =============================*/
    public function tipos(Request $request)
    {

    		$tipo = $request->get('tipo');

    		switch($tipo) 
    		{
    			case "salas":

		    		if($request->get('campus') != '')
		    		{
		    		
		    			$salas = Sala::where('campus_id',$request->get('campus'))->select('id','nombre')->get();

		    			return response()->json($salas);
		    		}

		    		$salas = Sala::select('id','nombre')->get();

		    		return response()->json($salas);    				
    				break;

    			case "cursos":

		    		if($request->get('campus') != '')
		    		{
		    		
		    			$cursos = Curso::join('asignaturas','asignaturas.id','=','cursos.asignatura_id')
										->join('departamentos','departamentos.id','=','asignaturas.departamento_id')
										->join('facultades','facultades.id','=','departamentos.facultad_id')
										->join('campus','campus.id','=','facultades.campus_id')
										->where('campus.id',$request->get('campus'))
										->select('cursos.id','asignaturas.nombre')
										->get();

		    			return response()->json($cursos);
		    		}

		    		$cursos = Curso::join('asignaturas','asignaturas.id','=','cursos.asignatura_id')
									->select('cursos.id','asignaturas.nombre')
									->get();

		    		return response()->json($cursos);    			
    				break;

    			case "carreras":
		    		if($request->get('campus') != '')
		    		{
		    		
		    			$carreras = Carrera::join('escuelas','escuelas.id','=','carreras.escuela_id')
							    			->join('departamentos','departamentos.id','=','escuelas.departamento_id')
							    			->join('facultades','facultades.id','=','departamentos.facultad_id')
							    			->join('campus','campus.id','=','facultades.campus_id')
											->where('campus.id',$request->get('campus'))
											->select('carreras.id','carreras.nombre')
											->get();

		    			return response()->json($carreras);
		    		}

		    		$carreras = Carrera::select('id','nombre')->get();

		    		return response()->json($carreras);     			
    				break;

    			case "asistencia":
    				$arr = [];
    				array_push($arr,(object)['id' => 'Si', 'nombre' => 'Si']);
    				array_push($arr,(object)['id' => 'No', 'nombre' => 'No']);
    				return response()->json($arr);       				
    				break;

    			case "estado_salas":
    				$arr = [];
    				array_push($arr,(object)['id' => 'Disponible', 'nombre' => 'Disponible']);
    				array_push($arr,(object)['id' => 'No Disponible', 'nombre' => 'No Disponible']);
    				return response()->json($arr);   
    				break;

    			default:
    				return "";
    		}

    }
    /*============================================ FIN BUSCADOR DE ELEMENTOS ====================================================*/

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
