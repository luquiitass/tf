<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDatallesIngresosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('datalles_ingresos', function(Blueprint $table)
		{
			$table->foreign('ingreso_id', 'ingresos_datalles_ingreso_fk')->references('id')->on('ingresos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('insumo_id', 'insumos_datalles_ingreso_fk')->references('id')->on('insumos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('datalles_ingresos', function(Blueprint $table)
		{
			$table->dropForeign('ingresos_datalles_ingreso_fk');
			$table->dropForeign('insumos_datalles_ingreso_fk');
		});
	}

}
