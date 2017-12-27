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
			$table->integer('comensal_id')->index('comensales_inscripciones_fk1');
			$table->integer('comida_id')->index('comidas_inscripciones_fk');
			$table->integer('user_id')->index('users_inscripciones_fk');
			$table->string('descripcion', 250)->nullable();
			$table->boolean('inscripto');
			$table->date('fecha');
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
		Schema::drop('inscripciones');
	}

}
