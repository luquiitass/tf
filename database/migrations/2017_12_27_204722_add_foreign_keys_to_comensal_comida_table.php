<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToComensalComidaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('comensal_comida', function(Blueprint $table)
		{
			$table->foreign('comensal_id', 'comensales_inscripciones_fk')->references('id')->on('comensales')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('comida_id', 'comidas_comensal_comida_fk')->references('id')->on('comidas')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('comensal_comida', function(Blueprint $table)
		{
			$table->dropForeign('comensales_inscripciones_fk');
			$table->dropForeign('comidas_comensal_comida_fk');
		});
	}

}
