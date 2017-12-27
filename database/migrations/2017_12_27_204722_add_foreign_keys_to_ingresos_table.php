<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToIngresosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ingresos', function(Blueprint $table)
		{
			$table->foreign('comedor_id', 'comedores_ingresos_fk')->references('id')->on('comedores')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ingresos', function(Blueprint $table)
		{
			$table->dropForeign('comedores_ingresos_fk');
		});
	}

}
