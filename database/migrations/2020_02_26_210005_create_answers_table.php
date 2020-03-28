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
            $table->string('text_a');
            $table->integer('bal_a')->default(1);
            $table->boolean('active_a')->default(1);
//            $table->integer('type')->default(0);
            $table->string('image_a')->nullable();
            $table->integer('order_a')->default(0);
            $table->timestamps();

//            $table->unique('id');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
        });

        Artisan::call('db:seed', array('--class' => 'AddDataToTableAnswers'));
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
