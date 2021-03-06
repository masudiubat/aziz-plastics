<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sdsm_id')->index()->nullable();
            $table->unsignedBigInteger('dsm_id')->index()->nullable();
            $table->unsignedBigInteger('sr_id')->index()->nullable();
            $table->unsignedBigInteger('dealer_id')->index()->nullable();
            $table->unsignedBigInteger('order_id')->index()->nullable();
            $table->integer('total_amount');
            $table->integer('discount')->nullable();
            $table->integer('net_amount');
            $table->integer('paid_amount')->nullable();
            $table->tinyInteger('dsm_status')->default('0');
            $table->tinyInteger('sdsm_status')->default('0');
            $table->tinyInteger('account_status')->default('0');
            $table->tinyInteger('gm_ed_status')->default('0');
            $table->tinyInteger('factory_status')->default('0');
            $table->timestamps();

            $table->foreign('sdsm_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('dsm_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('sr_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('dealer_id')->references('id')->on('dealers')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}
