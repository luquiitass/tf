<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProvinciasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('provincias', function(Blueprint $table)
		{
			$table->foreign('pais_id', 'paises_provincias_fk')->references('id')->on('paises')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('provincias', function(Blueprint $table)
		{
			$table->dropForeign('paises_provincias_fk');
		});
	}

}
