<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToComedoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('comedores', function(Blueprint $table)
		{
			$table->foreign('datos_contacto_id', 'datos_contacto_comedores_fk')->references('id')->on('datos_contacto')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('comedores', function(Blueprint $table)
		{
			$table->dropForeign('datos_contacto_comedores_fk');
		});
	}

}
