<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIngredientesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ingredientes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('insumo_id')->index('insumos_receta_insumo_fk');
			$table->decimal('cantidad', 4);
			$table->boolean('primordial');
			$table->integer('receta_id')->index('recetas_receta_insumo_fk');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ingredientes');
	}

}
