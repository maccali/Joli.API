<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessoTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('processo', function (Blueprint $table) {
      $table->increments('codigo');
      $table->integer('cod_cliente')->references('codigo')->on('cliente');
      $table->integer('cod_funcionario')->references('codigo')->on('funcionario');
      $table->string('cod_processo', 7);
      $table->string('numero', 50);
      $table->string('processo_tipo', 100);
      $table->date('abertura');
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('processo');
  }
}
