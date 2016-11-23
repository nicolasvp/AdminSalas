<?php

use Illuminate\Database\Seeder;

use App\TipoSala;

class TiposSalasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoSala::create([
        	'nombre' => 'Catedra',
        	'descripcion' => 'Sala para clases de plan comun con pizarra.'
        	]);
        TipoSala::create([
        	'nombre' => 'Laboratorio',
        	'descripcion' => 'Sala para especialidades y laboratorios de plan comun.'
        	]);        
    }
}
