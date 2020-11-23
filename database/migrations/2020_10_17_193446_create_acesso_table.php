<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcessoTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('acesso', function (Blueprint $table) {
      $table->increments('codigo');
      $table->timestamp('time', 0);
      $table->string('ip', 15);
      $table->string('feito', 250);
      $table->integer('cod_funcionario')->references('codigo')->on('funcionario');
      //$table->foreignId('cod_funcionario')->constrained('funcionario');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('acesso');
  }
}
