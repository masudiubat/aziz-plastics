<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dealers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sr_id')->index()->nullable();
            $table->unsignedBigInteger('dsm_id')->index()->nullable();
            $table->unsignedBigInteger('sdsm_id')->index()->nullable();
            $table->string('company_name');
            $table->string('dealer_name')->nullable();
            $table->string('dealer_code')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();

            $table->foreign('sr_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('dsm_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('sdsm_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dealers');
    }
}
