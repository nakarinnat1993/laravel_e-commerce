<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderitems', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->integer('item_id');
            $table->integer('order_id');
            $table->text('item_name');
            $table->decimal('item_price',8,2);
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
        Schema::dropIfExists('orderitems');
    }
}
