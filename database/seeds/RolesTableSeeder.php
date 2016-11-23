<?php

use Illuminate\Database\Seeder;
use App\Roles;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Roles::create([
        	'nombre' => 'Administrador',
        	'descripcion' => 'Posee facultad sobre todo el sistema'
        	]);
        Roles::create([
        	'nombre' => 'Encargado',
        	'descripcion' => 'Encargado de Campus y Secretaria de estudios.'
        	]);        
        Roles::create([
        	'nombre' => 'Estudiante',
        	'descripcion' => 'Puede consultar horarios.'
        	]);     
        Roles::create([
        	'nombre' => 'Docente',
        	'descripcion' => 'Puede consultar horarios.'
        	]);                	   
    }
}
