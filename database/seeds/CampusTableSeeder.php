<?php

use Illuminate\Database\Seeder;
use App\Campus;
class CampusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Campus::create([
        	'nombre' => 'Macul',
        	'direccion' => 'José Pedro Alessandri 1242, Ñuñoa.',
        	'descripcion' => 'Ubicado en la comuna de Ñuñoa, alberga a las facultades de Ciencias Naturales, Matemáticas y del Medio Ambiente, y de Ingeniería.',
        	'rut_encargado' => '18117925'
        	]);
        Campus::create([
            'nombre' => 'Providencia',
            'direccion' => 'Dr. Hernán Alessandri 644, Providencia.',
            'descripcion' => 'Emplazado en la comuna homónima, en el campus se encuentra la Facultad de Administración y Economía.',
            'rut_encargado' => '18117925'
            ]);
        Campus::create([
            'nombre' => 'Área Central',
            'direccion' => 'Dieciocho 161, Santiago.',
            'descripcion' => ' Facultades de Ciencias de la Construcción y Ordenamiento Territorial, y de Humanidades y Tecnologías de la Comunicación Social.',
            'rut_encargado' => '18117925'
            ]);

    }
}
