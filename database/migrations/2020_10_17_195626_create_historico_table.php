<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricoTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('historico', function (Blueprint $table) {
      $table->increments('codigo');
      $table->string('fase', 100);
      $table->date('data');
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
    Schema::dropIfExists('historico');
  }
}
