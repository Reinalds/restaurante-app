<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('status');
            $table->boolean('pago');
            $table->unsignedBigInteger('id_cliente')->nullable();
            $table->unsignedBigInteger('id_funcionario_1')->nullable();
            $table->string('nome_funcionario_1')->nullable();
            $table->unsignedBigInteger('id_funcionario_2')->nullable();
            $table->string('nome_funcionario_2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedido');
    }
}
