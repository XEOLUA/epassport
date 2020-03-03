<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnamnestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anamnests', function (Blueprint $table) {
            $table->Increments('id');
            $table->BigInteger('user_id')->unsigned();
            $table->text('description');
            $table->timestamps();

//            $table->unique('id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Artisan::call('db:seed', array('--class' => 'addDataToTableAnamnests'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anamnests');
    }
}
