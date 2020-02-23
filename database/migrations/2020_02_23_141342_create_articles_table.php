<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('description')->nullable();
            $table->text('text')->nullable();
            $table->string('image')->nullable();
            $table->string('author')->nullable();
            $table->boolean('active')->default(1);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Artisan::call('db:seed', array('--class' => 'AddDataToTableArticles'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
