<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToInscripcionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('inscripciones', function(Blueprint $table)
		{
			$table->foreign('comensal_id', 'comensales_inscripciones_fk')->references('id')->on('comensales')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('comida_por_dia_id', 'comidas_por_dia_inscripciones_fk')->references('id')->on('comidas_por_dia')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('inscripciones', function(Blueprint $table)
		{
			$table->dropForeign('comensales_inscripciones_fk');
			$table->dropForeign('comidas_por_dia_inscripciones_fk');
		});
	}

}
