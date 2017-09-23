<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlanillasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('planillas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->date('fecha')->index('planillas_idx');
			$table->timestamps();
			$table->integer('comida_por_dia_id')->index('comidas_por_dia_planillas_fk');
			$table->integer('comedor_id')->index('comedores_planillas_fk');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('planillas');
	}

}
