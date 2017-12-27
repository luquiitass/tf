<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMenuRecetaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('menu_receta', function(Blueprint $table)
		{
			$table->foreign('menu_id', 'menus_menu_receta_fk')->references('id')->on('menus')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('receta_id', 'recetas_menu_receta_fk')->references('id')->on('recetas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('menu_receta', function(Blueprint $table)
		{
			$table->dropForeign('menus_menu_receta_fk');
			$table->dropForeign('recetas_menu_receta_fk');
		});
	}

}
