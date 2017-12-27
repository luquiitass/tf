<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEgresosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('egresos', function(Blueprint $table)
		{
			$table->foreign('id', 'comedores_egresos_fk')->references('id')->on('comedores')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('egresos', function(Blueprint $table)
		{
			$table->dropForeign('comedores_egresos_fk');
		});
	}

}
