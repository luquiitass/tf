<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCaminosEstadosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('caminos_estados', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('origen')->index('estados_caminos_estados_fk');
			$table->integer('destino')->index('estados_caminos_estados_fk1');
			$table->boolean('inicio');
			$table->integer('cabecera_id')->index('cabeceras_caminos_estados_fk');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('caminos_estados');
	}

}
