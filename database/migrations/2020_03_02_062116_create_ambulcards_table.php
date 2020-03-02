<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmbulcardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambulcards', function (Blueprint $table) {
            $table->Increments('id');
            $table->BigInteger('user_id')->unsigned();
            $table->string('diagnosis');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();

//            $table->unique('id');
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
        Schema::dropIfExists('ambulcards');
    }
}
