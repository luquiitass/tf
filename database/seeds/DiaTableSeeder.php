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
        $dias = ['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'];

        foreach ($dias as $dia){
            \App\Models\Dia::create(['nombre' => $dia]);
        }
    }
}
