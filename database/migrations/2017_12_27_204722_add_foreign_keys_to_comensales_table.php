<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToComensalesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('comensales', function(Blueprint $table)
		{
			$table->foreign('comedor_id', 'comedores_comensales_fk')->references('id')->on('comedores')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'users_comensales_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('comensales', function(Blueprint $table)
		{
			$table->dropForeign('comedores_comensales_fk');
			$table->dropForeign('users_comensales_fk');
		});
	}

}
