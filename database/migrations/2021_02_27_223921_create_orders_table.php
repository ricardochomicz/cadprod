<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); //usuario que fez a compra
            $table->double('total', 10, 2);
            $table->string('identify', 191)->unique(); //identificador unico do pedido
            $table->string('code', 191)->unique(); //código do pedido 
            $table->enum('status', [1, 2, 3, 4, 5, 6, 7, 8, 9]); //status de pgto
            $table->enum('payment_method', [1, 2, 3, 4, 5, 6, 7]); //métodos de pgto
            $table->date('date'); //data que foi realizado o pedido
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
