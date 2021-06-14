<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('email', 128)->unique(); //luon di cung combo email->unique
            $table->string('name', 128);
            $table->string('password', 128);
            $table->string('phone', 32);
            $table->string('email_token')->nullable();
            $table->tinyInteger('verified')->default(0);
            $table->rememberToken();//ko truyen bien vao thi mac dinh gtri = null,field rememberToken ko can xuat hien luc create
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
        Schema::dropIfExists('customers');
    }
}


