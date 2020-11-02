<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_histories', function (Blueprint $table) {
            $table->increments('auditHistoryId');
            $table->string('time')->nullable();
			      $table->string('status')->index()->nullable();
			      $table->longText('operator')->nullable();
			      $table->longText('request')->nullable();
			      $table->longText('response')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audit_histories');
    }
}
