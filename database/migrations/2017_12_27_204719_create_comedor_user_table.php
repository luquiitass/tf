<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComedorUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comedor_user', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->index('users_comedr_user_fk');
			$table->integer('comedor_id')->index('comedores_comedr_user_fk');
			$table->boolean('creador')->default(0);
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
		Schema::drop('comedor_user');
	}

}
