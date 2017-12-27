<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToComedorUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('comedor_user', function(Blueprint $table)
		{
			$table->foreign('comedor_id', 'comedores_comedr_user_fk')->references('id')->on('comedores')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('user_id', 'users_comedr_user_fk')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('comedor_user', function(Blueprint $table)
		{
			$table->dropForeign('comedores_comedr_user_fk');
			$table->dropForeign('users_comedr_user_fk');
		});
	}

}
