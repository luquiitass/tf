<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToInsumosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('insumos', function(Blueprint $table)
		{
			$table->foreign('comedor_id', 'comedores_insumos_fk')->references('id')->on('comedores')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('unidad_de_medida_id', 'unidades_de_medida_insumos_fk')->references('id')->on('unidades_de_medida')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('insumos', function(Blueprint $table)
		{
			$table->dropForeign('comedores_insumos_fk');
			$table->dropForeign('unidades_de_medida_insumos_fk');
		});
	}

}
