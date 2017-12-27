<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInstanciaEstadoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('instancia_estado', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('estado_id');
			$table->integer('instancia_id')->index('instancias_instancia_estado_fk');
			$table->timestamps();
			$table->boolean('activo')->default(1);
			$table->unique(['estado_id','instancia_id'], 'instancia_estado_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('instancia_estado');
	}

}
