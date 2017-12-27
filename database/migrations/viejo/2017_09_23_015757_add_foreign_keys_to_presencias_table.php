<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPresenciasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('presencias', function(Blueprint $table)
		{
			$table->foreign('comensal_id', 'comensales_presencias_fk')->references('id')->on('comensales')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('planilla_id', 'planillas_presencias_fk')->references('id')->on('planillas')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('presencias', function(Blueprint $table)
		{
			$table->dropForeign('comensales_presencias_fk');
			$table->dropForeign('planillas_presencias_fk');
		});
	}

}
