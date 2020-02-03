<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->integer('breeder_id')->unsigned();
            $table->integer('swineCart_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->enum('status',[
                'requested', 'reserved', 'on_delivery',
                'sold', 'rated', 'reserved_to_another',
                'cancel_transaction'
                ]);
            $table->dateTime('created_at');

            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_logs');
    }
}
