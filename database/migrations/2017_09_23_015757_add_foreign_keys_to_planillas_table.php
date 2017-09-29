<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPlanillasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('planillas', function(Blueprint $table)
		{
			$table->foreign('comida_por_dia_id', 'comidas_por_dia_planillas_fk')->references('id')->on('comidas_por_dia')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('comedor_id', 'comedores_planillas_fk')->references('id')->on('comedores')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('planillas', function(Blueprint $table)
		{
			$table->dropForeign('comidas_por_dia_planillas_fk');
			$table->dropForeign('comedores_planillas_fk');
		});
	}

}
