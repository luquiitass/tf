<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCaminosEstadosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('caminos_estados', function(Blueprint $table)
		{
			$table->foreign('cabecera_id', 'cabeceras_caminos_estados_fk')->references('id')->on('cabeceras')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('origen', 'estados_caminos_estados_fk')->references('id')->on('estados')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('destino', 'estados_caminos_estados_fk1')->references('id')->on('estados')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('caminos_estados', function(Blueprint $table)
		{
			$table->dropForeign('cabeceras_caminos_estados_fk');
			$table->dropForeign('estados_caminos_estados_fk');
			$table->dropForeign('estados_caminos_estados_fk1');
		});
	}

}
