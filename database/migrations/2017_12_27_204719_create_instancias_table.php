<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInstanciasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('instancias', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->dateTime('fecha');
			$table->integer('comida_id')->index('comidas_instancias_fk');
			$table->timestamps();
			$table->unique(['fecha','comida_id'], 'planillas_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('instancias');
	}

}
