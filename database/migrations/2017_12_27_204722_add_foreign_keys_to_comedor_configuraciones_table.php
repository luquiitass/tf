<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToComedorConfiguracionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('comedor_configuraciones', function(Blueprint $table)
		{
			$table->foreign('comedor_id', 'comedores_configuraciones_fk')->references('id')->on('comedores')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('comedor_configuraciones', function(Blueprint $table)
		{
			$table->dropForeign('comedores_configuraciones_fk');
		});
	}

}
