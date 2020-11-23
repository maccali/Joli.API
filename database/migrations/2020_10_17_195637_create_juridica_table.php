<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJuridicaTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('juridica', function (Blueprint $table) {
      $table->string('cnpj', 18);
      $table->string('cnae', 9);
      $table->date('abertura');
      $table->string('natureza_jur', 150);
      $table->integer('cod_pessoa')->references('codigo')->on('pessoa');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('juridica');
  }
}
