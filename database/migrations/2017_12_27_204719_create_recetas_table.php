<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecetasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recetas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nombre', 250)->unique('recetas_idx');
			$table->integer('porciones');
			$table->text('descripcion')->nullable();
			$table->text('preparacion')->nullable();
			$table->integer('comedor_id')->index('comedores_recetas_fk');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('recetas');
	}

}
