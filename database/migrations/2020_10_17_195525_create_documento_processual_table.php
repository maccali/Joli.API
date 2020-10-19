<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentoProcessualTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documento_processual', function (Blueprint $table) {
            $table->increments('codigo');
            $table->string('processo', 200);
			$table->timestamp('upload', 0);
			$table->integer('cod_processo')->references('codigo')->on('processo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documento_processual');
    }
}
