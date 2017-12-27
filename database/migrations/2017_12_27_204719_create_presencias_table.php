<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePresenciasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('presencias', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->boolean('estado')->default(0);
			$table->dateTime('hora')->nullable();
			$table->integer('comensal_id');
			$table->integer('instancia_id')->index('planillas_presencias_fk');
			$table->unique(['comensal_id','instancia_id'], 'presencias_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('presencias');
	}

}
