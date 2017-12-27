<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDatosContactoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('datos_contacto', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('tel1', 30)->nullable();
			$table->string('tel2', 30)->nullable();
			$table->string('email1', 30)->nullable();
			$table->string('email2', 30)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('datos_contacto');
	}

}
