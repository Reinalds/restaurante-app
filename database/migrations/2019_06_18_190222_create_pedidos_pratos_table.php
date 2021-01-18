<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosPratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_prato', function (Blueprint $table) {
            $table->unsignedBigInteger('pedido_id');
            $table->unsignedBigInteger('prato_id');
            $table->integer('quantidade');
            $table->timestamps();

            $table->foreign('pedido_id')
                ->references('id')
                ->on('pedido')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('prato_id')
                ->references('id')
                ->on('prato')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedido_prato');
    }
}
