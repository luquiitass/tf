<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComidasPorDiaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comidas_por_dia', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nombre', 250);
			$table->string('dia', 15);
			$table->time('inicio');
			$table->time('fin');
			$table->timestamps();
			$table->integer('comedor_id')->index('comedores_comidas_por_dia_fk');
			$table->unique(['nombre','dia'], 'comidas_por_dia_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comidas_por_dia');
	}

}
