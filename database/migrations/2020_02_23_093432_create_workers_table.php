<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('position')->nullable();
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->string('email')->nullable();
            $table->boolean('active')->default(1);
            $table->integer('sex')->default(1);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Artisan::call('db:seed', array('--class' => 'AddDataToTableWorkers'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workers');
    }
}
