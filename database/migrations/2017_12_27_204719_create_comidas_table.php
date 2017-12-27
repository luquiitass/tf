<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComidasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comidas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('comedor_id')->index('comedores_comedor_comida_fk');
			$table->integer('tipo_comida_id')->index('tipos_comida_comidas_fk');
			$table->integer('dia_id')->index('dias_comidas_fk');
			$table->time('inicio');
			$table->boolean('activo');
			$table->time('fin');
			$table->time('hora_pre_inscripcion');
			$table->boolean('borrado')->default(0);
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
		Schema::drop('comidas');
	}

}
