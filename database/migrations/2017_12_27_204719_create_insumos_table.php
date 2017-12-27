<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInsumosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('insumos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nombre', 250);
			$table->decimal('disponibilidad', 4);
			$table->integer('unidad_de_medida_id')->index('unidades_de_medida_insumos_fk');
			$table->integer('minimo');
			$table->boolean('activo')->default(1);
			$table->integer('comedor_id')->index('comedores_insumos_fk');
			$table->unique(['nombre','comedor_id'], 'insumos_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('insumos');
	}

}
