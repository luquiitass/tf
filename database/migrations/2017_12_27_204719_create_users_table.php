<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nombre');
			$table->string('apellido');
			$table->string('dni')->unique();
			$table->date('fecha_nacimiento');
			$table->string('email')->unique();
			$table->string('password');
			$table->string('remember_token', 100)->nullable();
			$table->string('foto')->nullable();
			$table->integer('direccion_id')->nullable()->index('direcciones_users_fk');
			$table->integer('datos_contacto_id')->nullable()->index('datos_contacto_users_fk');
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
		Schema::drop('users');
	}

}
