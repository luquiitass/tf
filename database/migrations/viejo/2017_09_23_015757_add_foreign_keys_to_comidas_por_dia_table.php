<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToComidasPorDiaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('comidas_por_dia', function(Blueprint $table)
		{
			$table->foreign('comedor_id', 'comedores_comidas_por_dia_fk')->references('id')->on('comedor')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('comidas_por_dia', function(Blueprint $table)
		{
			$table->dropForeign('comedores_comidas_por_dia_fk');
		});
	}

}
