<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToIngredientesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ingredientes', function(Blueprint $table)
		{
			$table->foreign('insumo_id', 'insumos_receta_insumo_fk')->references('id')->on('insumos')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('receta_id', 'recetas_receta_insumo_fk')->references('id')->on('recetas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ingredientes', function(Blueprint $table)
		{
			$table->dropForeign('insumos_receta_insumo_fk');
			$table->dropForeign('recetas_receta_insumo_fk');
		});
	}

}
