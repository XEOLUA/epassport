<?php

use App\User;
use Illuminate\Database\Seeder;

class addDefaultUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            User::insert([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => '$2y$10$B3apNOt.NJPRUFO5W9n6Bun6ZJJI9Z3/2HhOO/lSrz.0gRfmXGXJO'
            ]);

    }
}
