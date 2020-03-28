<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('settings')->nullable();
            $table->boolean('active')->default(1);
            $table->integer('order')->default(1);
            $table->string('image')->nullable();
            $table->integer('type')->default(0);
            $table->timestamps();
        });

        Artisan::call('db:seed', array('--class' => 'AddDataToTests'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests');
    }
}
