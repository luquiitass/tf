<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenuRecetaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menu_receta', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('menu_id')->index('menus_menu_receta_fk');
			$table->integer('receta_id')->index('recetas_menu_receta_fk');
			$table->timestamps();
			$table->integer('cantidad');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('menu_receta');
	}

}
