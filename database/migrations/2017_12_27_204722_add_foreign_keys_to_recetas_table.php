<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRecetasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('recetas', function(Blueprint $table)
		{
			$table->foreign('comedor_id', 'comedores_recetas_fk')->references('id')->on('comedores')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('recetas', function(Blueprint $table)
		{
			$table->dropForeign('comedores_recetas_fk');
		});
	}

}
