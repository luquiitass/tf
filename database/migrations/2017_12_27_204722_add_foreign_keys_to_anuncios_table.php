<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAnunciosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('anuncios', function(Blueprint $table)
		{
			$table->foreign('comedor_id', 'comedores_anuncios_fk')->references('id')->on('comedores')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('user_id', 'users_anuncios_fk')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('anuncios', function(Blueprint $table)
		{
			$table->dropForeign('comedores_anuncios_fk');
			$table->dropForeign('users_anuncios_fk');
		});
	}

}
