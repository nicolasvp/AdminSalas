<?php

use Illuminate\Database\Seeder;

use App\Escuela;

class EscuelasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Escuela::create([
        	'nombre' => 'Escuela de Química',
        	'departamento_id' => 20,
        	'descripcion' => ''
        	]);
        Escuela::create([
        	'nombre' => 'Escuela de Industria Alimentaria y Biotecnología',
        	'departamento_id' => 17,
        	'descripcion' => ''
        	]);
        Escuela::create([
        	'nombre' => 'Escuela de Administración',
        	'departamento_id' => 8,
        	'descripcion' => ''
        	]);
        Escuela::create([
        	'nombre' => 'Escuela de Comercio Internacional',
        	'departamento_id' => 9,
        	'descripcion' => ''
        	]);
        Escuela::create([
        	'nombre' => 'Escuela de Contadores Auditores',
        	'departamento_id' => 10,
        	'descripcion' => ''
        	]);
        Escuela::create([
        	'nombre' => 'Escuela de Bibliotecología',
        	'departamento_id' => 11,
        	'descripcion' => ''
        	]);
        Escuela::create([
        	'nombre' => 'Escuela de Ingeniería Comercial',
        	'departamento_id' => 12,
        	'descripcion' => ''
        	]);
        Escuela::create([
        	'nombre' => 'Escuela de Prevención de Riesgos y Medio Ambiente',
        	'departamento_id' => 5,
        	'descripcion' => ''
        	]);
        Escuela::create([
        	'nombre' => 'Escuela de Construcción Civil',
        	'departamento_id' => 6,
        	'descripcion' => ''
        	]);
        Escuela::create([
        	'nombre' => 'Escuela de Arquitectura',
        	'departamento_id' => 7,
        	'descripcion' => ''
        	]);
        Escuela::create([
        	'nombre' => 'Escuela de Diseño',
        	'departamento_id' => 4,
        	'descripcion' => ''
        	]);
        Escuela::create([
        	'nombre' => 'Escuela de Cartografía',
        	'departamento_id' => 3,
        	'descripcion' => ''
        	]);
        Escuela::create([
        	'nombre' => 'Escuela de Trabajo Social',
        	'departamento_id' => 2,
        	'descripcion' => ''
        	]);
        Escuela::create([
        	'nombre' => 'Escuela de Informática',
        	'departamento_id' => 16,
        	'descripcion' => ''
        	]);
        Escuela::create([
        	'nombre' => 'Escuela de Industria',
        	'departamento_id' => 15,
        	'descripcion' => ''
        	]);
        Escuela::create([
        	'nombre' => 'Escuela de Electrónica',
        	'departamento_id' => 14,
        	'descripcion' => ''
        	]);
        Escuela::create([
        	'nombre' => 'Escuela de Mecánica',
        	'departamento_id' => 13,
        	'descripcion' => ''
        	]);
        Escuela::create([
        	'nombre' => 'Escuela de Geomensura',
        	'departamento_id' => 18,
        	'descripcion' => ''
        	]);
        Escuela::create([
        	'nombre' => 'Escuela de Transporte y Tránsito',
        	'departamento_id' => 19,
        	'descripcion' => ''
        	]);
    }
}
