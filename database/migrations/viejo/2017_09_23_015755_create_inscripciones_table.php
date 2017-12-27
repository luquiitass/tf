<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInscripcionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inscripciones', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('comida_por_dia_id');
			$table->integer('comensal_id')->index('comensales_inscripciones_fk');
			$table->unique(['comida_por_dia_id','comensal_id'], 'inscripciones_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('inscripciones');
	}

}
