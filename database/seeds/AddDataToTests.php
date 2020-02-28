<?php

use App\Question;
use Illuminate\Database\Seeder;
use App\Test;

class AddDataToTests extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Створюємо три тести для прикладу
        $dataArray =[
            [
                'title' => 'Назва тесту - 1',
                'description' => 'Опис тесту - 1',
                'settings' => 'Налаштування тесту - 1',
                'active' => 1,
                'order' => 0,
                'image' => 'images/good_food.jpg'
            ],
            [
                'title' => 'Назва тесту - 2',
                'description' => 'Опис тесту - 2',
                'settings' => 'Налаштування тесту - 2',
                'active' => 1,
                'order' => 1,
                'image' => 'images/good_food.jpg'
            ],
            [
                'title' => 'Назва тесту - 3',
                'description' => 'Опис тесту - 3',
                'settings' => 'Налаштування тесту - 3',
                'active' => 1,
                'order' => 2,
                'image' => 'images/good_food.jpg'
            ]
        ];

        foreach ($dataArray as $item) {
            Test::insert([
                'title' => $item['title'],
                'description' => $item['description'],
                'settings' => $item['settings'],
                'active' => $item['active'],
                'order' => $item['order'],
                'image' => $item['image'],
            ]);
        }


    }
}
