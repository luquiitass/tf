<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUnidadesDeMedidaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('unidades_de_medida', function(Blueprint $table)
		{
			$table->foreign('comedor_id', 'comedores_unidades_de_medida_fk')->references('id')->on('comedores')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('unidades_de_medida', function(Blueprint $table)
		{
			$table->dropForeign('comedores_unidades_de_medida_fk');
		});
	}

}
