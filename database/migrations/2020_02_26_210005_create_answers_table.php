<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->Increments('id');
            $table->Integer('question_id')->unsigned();
            $table->string('text');
            $table->integer('bal')->default(1);
            $table->boolean('active')->default(1);
//            $table->integer('type')->default(0);
            $table->string('image')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();

//            $table->unique('id');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
