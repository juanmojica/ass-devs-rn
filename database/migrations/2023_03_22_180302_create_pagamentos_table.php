<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('associado_id');
            $table->unsignedBigInteger('anuidade_id');
            $table->date('data_pagamento')->nullable();
            $table->boolean('pago')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('associado_id')->references('id')->on('associados');
            $table->foreign('anuidade_id')->references('id')->on('anuidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagamentos');
    }
}
