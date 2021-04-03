<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();            
            $table->bigInteger('room_id')->unsigned();
            $table->bigInteger('customer_id')->unsigned();
            $table->string('title', 255);            
            $table->string('content', 255);
            $table->tinyInteger('status');
            $table->timestamp('started_at')->nullable();            
            $table->timestamp('ended_at')->nullable();
            $table->timestamps();

            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
