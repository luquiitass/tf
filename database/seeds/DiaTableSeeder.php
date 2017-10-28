<?php

use Illuminate\Database\Seeder;

class DiaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dias = ['Lunes'=> 'Monday','Martes'=>'Tuesday','Miércoles' => 'Wednesday','Jueves'=>'Thursday','Viernes'=>'Friday','Sábado'=>'Saturday','Domingo'=>'Sunday'];

        foreach ($dias as $dia => $key){
            \App\Models\Dia::create(['nombre' => $dia,'name'=>$key]);
        }
    }
}
