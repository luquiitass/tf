<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDireccionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('direcciones', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('calle', 250);
			$table->integer('altura');
			$table->integer('piso')->nullable();
			$table->string('dpto', 100)->nullable();
			$table->integer('localidad_id')->index('localidades_direcciones_fk');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('direcciones');
	}

}
