<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToComidasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('comidas', function(Blueprint $table)
		{
			$table->foreign('comedor_id', 'comedores_comedor_comida_fk')->references('id')->on('comedores')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('dia_id', 'dias_comidas_fk')->references('id')->on('dias')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('tipo_comida_id', 'tipos_comida_comidas_fk')->references('id')->on('tipos_comida')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('comidas', function(Blueprint $table)
		{
			$table->dropForeign('comedores_comedor_comida_fk');
			$table->dropForeign('dias_comidas_fk');
			$table->dropForeign('tipos_comida_comidas_fk');
		});
	}

}
