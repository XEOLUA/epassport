<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('menu_id')->unsigned();
            $table->bigInteger('parent_id')->nullable();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('link')->nullable();
            $table->string('settings')->nullable();
            $table->boolean('active')->default(1);
            $table->integer('order')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();

            $table->unique(['id']);
            $table->foreign('menu_id')->references('id')->on('menuses')->onDelete('cascade');
        });

        Artisan::call('db:seed', array('--class' => 'AddDataToTableMenu_lists'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_lists');
    }
}
