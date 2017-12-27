<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComedoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comedores', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nombre', 250);
			$table->integer('capacidad');
			$table->boolean('activo')->default(0);
			$table->integer('direccion_id')->nullable();
			$table->integer('datos_contacto_id')->nullable()->index('datos_contacto_comedores_fk');
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
		Schema::drop('comedores');
	}

}
