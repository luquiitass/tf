<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMenusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('menus', function(Blueprint $table)
		{
			$table->foreign('instancia_id', 'planillas_menus_fk')->references('id')->on('instancias')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('menus', function(Blueprint $table)
		{
			$table->dropForeign('planillas_menus_fk');
		});
	}

}
