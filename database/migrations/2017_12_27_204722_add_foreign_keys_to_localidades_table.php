<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLocalidadesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('localidades', function(Blueprint $table)
		{
			$table->foreign('provincia_id', 'provincias_localidades_fk')->references('id')->on('provincias')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('localidades', function(Blueprint $table)
		{
			$table->dropForeign('provincias_localidades_fk');
		});
	}

}
