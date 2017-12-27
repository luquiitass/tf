<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDatallesIngresosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('datalles_ingresos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('ingreso_id')->index('ingresos_datalles_ingreso_fk');
			$table->integer('insumo_id')->index('insumos_datalles_ingreso_fk');
			$table->integer('cantidad');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('datalles_ingresos');
	}

}
