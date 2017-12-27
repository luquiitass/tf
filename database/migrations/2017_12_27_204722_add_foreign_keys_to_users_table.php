<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->foreign('datos_contacto_id', 'datos_contacto_users_fk')->references('id')->on('datos_contacto')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('direccion_id', 'direcciones_users_fk')->references('id')->on('direcciones')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->dropForeign('datos_contacto_users_fk');
			$table->dropForeign('direcciones_users_fk');
		});
	}

}
