<?php

use Illuminate\Database\Seeder;

use App\Departamento;

class DepartamentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Departamento::create([
        	'nombre' => 'Departamento de Humanidades',
        	'facultad_id' => 5,
        	'descripcion' => ''
        	]);
        Departamento::create([
        	'nombre' => 'Departamento de Trabajo Social',
        	'facultad_id' => 5,
        	'descripcion' => ''
        	]);
         Departamento::create([
        	'nombre' => 'Departamento de Cartografía',
        	'facultad_id' => 5,
        	'descripcion' => ''
        	]);
        Departamento::create([
        	'nombre' => 'Departamento de Diseño',
        	'facultad_id' => 5,
        	'descripcion' => ''
        	]);
        Departamento::create([
        	'nombre' => 'Departamento de Prevención de Riesgos y Medio Ambiente',
        	'facultad_id' => 4,
        	'descripcion' => ''
        	]);
        Departamento::create([
        	'nombre' => 'Departamento de Ciencias de la Construcción',
        	'facultad_id' => 4,
        	'descripcion' => ''
        	]);
         Departamento::create([
        	'nombre' => 'Departamento de Planificación y Ordenamiento Territorial',
        	'facultad_id' => 4,
        	'descripcion' => ''
        	]);
        Departamento::create([
        	'nombre' => 'Departamento de Gestión Organizacional',
        	'facultad_id' => 3,
        	'descripcion' => ''
        	]);
        Departamento::create([
        	'nombre' => 'Departamento de Economía, Recursos Naturales y Comercio Internacional',
        	'facultad_id' => 3,
        	'descripcion' => ''
        	]);
         Departamento::create([
        	'nombre' => 'Departamento de Contabilidad y Gestión Financiera',
        	'facultad_id' => 3,
        	'descripcion' => ''
        	]);
        Departamento::create([
        	'nombre' => 'Departamento de Gestión de la Información',
        	'facultad_id' => 3,
        	'descripcion' => ''
        	]);
        Departamento::create([
        	'nombre' => 'Departamento de Estadística y Econometría',
        	'facultad_id' => 3,
        	'descripcion' => ''
        	]);  
        Departamento::create([
        	'nombre' => 'Departamento de Mecánica',
        	'facultad_id' => 2,
        	'descripcion' => ''
        	]);
        Departamento::create([
        	'nombre' => 'Departamento de Electricidad',
        	'facultad_id' => 2,
        	'descripcion' => ''
        	]);
         Departamento::create([
        	'nombre' => 'Departamento de Industria',
        	'facultad_id' => 2,
        	'descripcion' => ''
        	]);
        Departamento::create([
        	'nombre' => 'Departamento de Informática y Computación',
        	'facultad_id' => 2,
        	'descripcion' => ''
        	]);  
        Departamento::create([
        	'nombre' => 'Departamento de Biotecnología',
        	'facultad_id' => 1,
        	'descripcion' => ''
        	]);
        Departamento::create([
        	'nombre' => 'Departamento de Física',
        	'facultad_id' => 1,
        	'descripcion' => ''
        	]);
         Departamento::create([
        	'nombre' => 'Departamento de Matemáticas',
        	'facultad_id' => 1,
        	'descripcion' => ''
        	]);
        Departamento::create([
        	'nombre' => 'Departamento de Química',
        	'facultad_id' => 1,
        	'descripcion' => ''
        	]);   	       	        
    }
}
