<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComensalComidaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comensal_comida', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('comida_id')->index('comidas_comensal_comida_fk');
			$table->integer('comensal_id')->index('comensales_inscripciones_fk');
			$table->boolean('inscripto')->default(1);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comensal_comida');
	}

}
