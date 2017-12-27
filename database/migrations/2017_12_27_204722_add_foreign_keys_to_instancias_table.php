<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToInstanciasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('instancias', function(Blueprint $table)
		{
			$table->foreign('comida_id', 'comidas_instancias_fk')->references('id')->on('comidas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('instancias', function(Blueprint $table)
		{
			$table->dropForeign('comidas_instancias_fk');
		});
	}

}
