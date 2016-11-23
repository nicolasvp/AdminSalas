<?php

use Illuminate\Database\Seeder;

use App\Facultad;

class FacultadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Facultad::create([
        	'nombre' => 'Facultad de Ciencias Naturales, Matemática y del Medio Ambiente',
        	'campus_id' => 2,
        	'descripcion' => ''
        	]);    
        Facultad::create([
        	'nombre' => 'Facultad de Ingeniería',
        	'campus_id' => 2,
        	'descripcion' => ''
        	]);        	
        Facultad::create([
        	'nombre' => 'Facultad de Administración y Economía',
        	'campus_id' => 3,
        	'descripcion' => ''
        	]);
        Facultad::create([
        	'nombre' => 'Facultad de Ciencias de la Construcción y Ordenamiento Territorial',
        	'campus_id' => 4,
        	'descripcion' => ''
        	]);     
        Facultad::create([
        	'nombre' => 'Facultad de Humanidades y Tecnologías de la Comunicación Social',
        	'campus_id' => 4,
        	'descripcion' => ''
        	]);      
    }
}
