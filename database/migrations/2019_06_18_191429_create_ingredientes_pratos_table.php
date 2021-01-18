<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredientesPratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingrediente_prato', function (Blueprint $table) {
            $table->unsignedBigInteger('ingrediente_id');
            $table->unsignedBigInteger('prato_id');
            $table->integer('quantidade')->default(0);
            $table->timestamps();
            
            $table->foreign('ingrediente_id')
                ->references('id')
                ->on('ingrediente')
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
        Schema::dropIfExists('ingrediente_prato');
    }
}
