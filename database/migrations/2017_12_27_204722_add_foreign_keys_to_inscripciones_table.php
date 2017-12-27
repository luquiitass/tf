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
			$table->foreign('comensal_id', 'comensales_inscripciones_fk1')->references('id')->on('comensales')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('comida_id', 'comidas_inscripciones_fk')->references('id')->on('comidas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'users_inscripciones_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
			$table->dropForeign('comensales_inscripciones_fk1');
			$table->dropForeign('comidas_inscripciones_fk');
			$table->dropForeign('users_inscripciones_fk');
		});
	}

}
