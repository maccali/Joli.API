<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentoTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('documento', function (Blueprint $table) {
      $table->increments('codigo');
      $table->string('tipo', 75);
      $table->string('nome', 100);
      $table->string('documento', 200);
      $table->timestamp('upload', 0);
      $table->integer('cod_processo')->referencas('codigo')->on('processo');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('documento');
  }
}
