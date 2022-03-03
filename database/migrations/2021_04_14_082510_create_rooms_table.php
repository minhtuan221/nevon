<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('hotel_id')->unsigned();// khoa ngoai 
            $table->string('name', 128);
            $table->string('description', 255);
            $table->smallInteger('floor');
            $table->smallInteger('number');
            $table->smallInteger('bed'); // số giường
            $table->tinyInteger('status');
            $table->timestamps();
            $table->softDeletes(); //add soft delete
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
