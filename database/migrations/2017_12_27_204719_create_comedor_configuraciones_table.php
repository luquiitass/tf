<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComedorConfiguracionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comedor_configuraciones', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->date('inicia')->nullable();
			$table->date('finaliza')->nullable();
			$table->integer('comedor_id')->index('comedores_configuraciones_fk');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comedor_configuraciones');
	}

}
