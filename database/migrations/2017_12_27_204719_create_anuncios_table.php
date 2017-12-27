<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnunciosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('anuncios', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->text('asunto');
			$table->text('cuerpo');
			$table->dateTime('hasta');
			$table->integer('user_id')->index('users_anuncios_fk');
			$table->integer('comedor_id')->index('comedores_anuncios_fk');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('anuncios');
	}

}
