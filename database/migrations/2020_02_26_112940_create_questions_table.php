<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->Increments('id');
            $table->Integer('test_id')->unsigned();
            $table->string('text_q');
            $table->string('description_q')->nullable();
            $table->string('params_q')->nullable();
            $table->integer('bal_q')->default(0);
            $table->integer('type_q')->default(0);
            $table->boolean('active_q')->default(1);
            $table->integer('order_q')->default(1);
            $table->string('image_q')->nullable();
            $table->timestamps();

            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');
        });

        Artisan::call('db:seed', array('--class' => 'AddDataToTableQuestions'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quastions');
    }
}
