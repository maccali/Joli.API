<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFisicaTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('fisica', function (Blueprint $table) {
      $table->string('cpf', 14);
      $table->string('rg', 10);
      $table->date('nascimento');
      $table->integer('cod_pessoa')->primary()->references('codigo')->on('pessoa');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('fisica');
  }
}
