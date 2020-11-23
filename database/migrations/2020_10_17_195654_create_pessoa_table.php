<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePessoaTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('pessoa', function (Blueprint $table) {
      $table->increments('codigo');
      $table->string('nome', 250);
      $table->string('email', 150);
      $table->string('endereco', 150);
      $table->string('telefone', 15);
      $table->string('cep', 15);
      $table->string('cidade', 250);
      $table->string('uf', 2);

      $table->string('tipo', 15);

      $table->string('cpf', 14)->nullable();
      $table->string('rg', 10)->nullable();
      $table->date('nascimento', 15)->nullable();

      $table->string('cnpj', 18)->nullable();
      $table->string('natureza_jur', 150)->nullable();
      $table->string('cnae', 15)->nullable();
      $table->date('abertura', 15)->nullable();

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
    Schema::dropIfExists('pessoa');
  }
}
