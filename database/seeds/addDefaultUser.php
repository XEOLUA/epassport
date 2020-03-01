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
                'group' => 'admin',
                'year_in' => 0,
                'role' => 0,
                'email' => 'admin@admin.com',
                'password' => '$2y$10$B3apNOt.NJPRUFO5W9n6Bun6ZJJI9Z3/2HhOO/lSrz.0gRfmXGXJO'
            ]);

        User::insert([
            'name' => 'Петренко Іван Сергійович',
            'email' => 'petrenko@ukr.net',
            'password' => '$2y$10$B3apNOt.NJPRUFO5W9n6Bun6ZJJI9Z3/2HhOO/lSrz.0gRfmXGXJO',
            'year_in' => 2017,
            'role' => 1,
            'group' => 'КБ-21',
            'sex' => 1,
        ]);
        User::insert([
            'name' => 'Сидоренко Олена Василівна',
            'email' => 'sydor@ukr.net',
            'password' => '$2y$10$B3apNOt.NJPRUFO5W9n6Bun6ZJJI9Z3/2HhOO/lSrz.0gRfmXGXJO',
            'year_in' => 2015,
            'role' => 1,
            'group' => 'БФ-52',
            'sex' => 0,
        ]);
        User::insert([
            'name' => 'Претус Антон Івановмч',
            'email' => 'pretus@ukr.net',
            'password' => '$2y$10$B3apNOt.NJPRUFO5W9n6Bun6ZJJI9Z3/2HhOO/lSrz.0gRfmXGXJO',
            'year_in' => 2017,
            'role' => 1,
            'group' => 'КБ-21',
            'sex' => 1,
        ]);
        User::insert([
            'name' => 'Кавун Абрікос Горіхович',
            'email' => 'kavun@ukr.net',
            'password' => '$2y$10$B3apNOt.NJPRUFO5W9n6Bun6ZJJI9Z3/2HhOO/lSrz.0gRfmXGXJO',
            'year_in' => 2019,
            'role' => 1,
            'group' => 'Овоч',
            'sex' => 1,
        ]);
        User::insert([
            'name' => 'Банан Зелений Афріканович',
            'email' => 'banana@ukr.net',
            'password' => '$2y$10$B3apNOt.NJPRUFO5W9n6Bun6ZJJI9Z3/2HhOO/lSrz.0gRfmXGXJO',
            'year_in' => 2020,
            'role' => 1,
            'group' => 'Фрукт',
            'sex' => 1,
        ]);
        User::insert([
            'name' => 'Лікар Антибіотик Гомеопатович',
            'email' => 'doctor@ukr.net',
            'password' => '$2y$10$B3apNOt.NJPRUFO5W9n6Bun6ZJJI9Z3/2HhOO/lSrz.0gRfmXGXJO',
            'year_in' => 2020,
            'role' => 2,
            'group' => 'doctor',
            'sex' => 1,
        ]);
    }
}
