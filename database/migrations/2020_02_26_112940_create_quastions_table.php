<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuastionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quastions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('test_id');
            $table->string('text');
            $table->integer('bal')->default(1);
            $table->boolean('active')->default(1);
            $table->integer('type')->default(0);
            $table->string('image')->nullable();
            $table->timestamps();
        });
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
