<?php

use Illuminate\Database\Seeder;
use App\Periodo;

class PeriodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Periodo::create([
        	'bloque' => 'I',
        	'inicio' => '08:00:00',
        	'fin' => '09:30:00'
        	]);
        Periodo::create([
        	'bloque' => 'II',
        	'inicio' => '09:40:00',
        	'fin' => '11:10:00'
        	]);  
        Periodo::create([
        	'bloque' => 'III',
        	'inicio' => '11:20:00',
        	'fin' => '12:50:00'
        	]); 
        Periodo::create([
        	'bloque' => 'IV',
        	'inicio' => '13:00:00',
        	'fin' => '14:30:00'
        	]); 
        Periodo::create([
        	'bloque' => 'V',
        	'inicio' => '14:40:00',
        	'fin' => '16:10:00'
        	]); 
        Periodo::create([
        	'bloque' => 'VI',
        	'inicio' => '16:20:00',
        	'fin' => '17:50:00'
        	]); 
        Periodo::create([
        	'bloque' => 'VII',
        	'inicio' => '18:00:00',
        	'fin' => '19:30:00'
        	]);        
        Periodo::create([
        	'bloque' => 'VIII',
        	'inicio' => '19:00:00',
        	'fin' => '20:30:00'
        	]);   
        Periodo::create([
        	'bloque' => 'IX',
        	'inicio' => '20:40:00',
        	'fin' => '22:10:00'
        	]);          	    
    }
}
