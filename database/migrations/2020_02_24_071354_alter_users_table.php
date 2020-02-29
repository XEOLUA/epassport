<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('group')->after('name');
            $table->integer('sex')->after('group')->default(0);
            $table->date('birthday')->after('sex');
            $table->string('address')->after('birthday')->nullable();
            $table->integer('year_in')->after('address');
            $table->string('parents')->after('year_in')->nullable();
            $table->integer('role')->after('parents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
//                    $table->dropColumn('group');
//                    $table->dropColumn('sex');
                });
    }
}
