<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDetallesEgresosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('detalles_egresos', function(Blueprint $table)
		{
			$table->foreign('id', 'egresos_detalles_egresos_fk')->references('id')->on('egresos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('id', 'insumos_detalles_egresos_fk')->references('id')->on('insumos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('detalles_egresos', function(Blueprint $table)
		{
			$table->dropForeign('egresos_detalles_egresos_fk');
			$table->dropForeign('insumos_detalles_egresos_fk');
		});
	}

}
