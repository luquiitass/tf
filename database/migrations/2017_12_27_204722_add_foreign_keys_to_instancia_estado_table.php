<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToInstanciaEstadoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('instancia_estado', function(Blueprint $table)
		{
			$table->foreign('estado_id', 'estado_instancia_estado_fk')->references('id')->on('estados')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('instancia_id', 'instancias_instancia_estado_fk')->references('id')->on('instancias')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('instancia_estado', function(Blueprint $table)
		{
			$table->dropForeign('estado_instancia_estado_fk');
			$table->dropForeign('instancias_instancia_estado_fk');
		});
	}

}
