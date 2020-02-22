<?php

use App\Menus;
use Illuminate\Database\Seeder;

class AddDataToTableMenuses extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $dataArray =[
            [
                'title' => 'Основний',
                'description' => 'Основне меню сайту',
            ],
            [
                'title' => 'Користувацький',
                'description' => 'Меню авторизваного користувача',
            ]
        ];

        foreach ($dataArray as $item) {
            Menus::insert([
                'title' => $item['title'],
                'description' => $item['description'],
            ]);
        }
    }
}
