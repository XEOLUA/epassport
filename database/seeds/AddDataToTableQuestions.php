<?php

use App\Question;
use Illuminate\Database\Seeder;

class AddDataToTableQuestions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Створюємо питання для прикладу
        $dataArray =[
            [
                'test_id' => 1,
                'text' => 'Текст питання №1',
                'description' => 'Опис питання №1',
                'bal' => 1,
                'type' => 0,
                'active' => 1,
                'order' => 0,
                'image' => 'images/good_food.jpg'
            ],
            [
                'test_id' => 1,
                'text' => 'Текст питання №2',
                'description' => 'Опис питання №2',
                'bal' => 1,
                'type' => 1,
                'active' => 1,
                'order' => 1,
                'image' => 'images/good_food.jpg'
            ],
            [
                'test_id' => 1,
                'text' => 'Текст питання №3',
                'description' => 'Опис питання №3',
                'bal' => 1,
                'type' => 2,
                'active' => 1,
                'order' => 2,
                'image' => 'images/good_food.jpg'
            ],
            [
                'test_id' => 2,
                'text' => 'Текст питання №1',
                'description' => 'Опис питання №1',
                'bal' => 1,
                'type' => 0,
                'active' => 1,
                'order' => 0,
                'image' => 'images/good_food.jpg'
            ],
            [
                'test_id' => 2,
                'text' => 'Текст питання №2',
                'description' => 'Опис питання №2',
                'bal' => 1,
                'type' => 1,
                'active' => 1,
                'order' => 1,
                'image' => 'images/good_food.jpg'
            ],
            [
                'test_id' => 2,
                'text' => 'Текст питання №3',
                'description' => 'Опис питання №3',
                'bal' => 1,
                'type' => 2,
                'active' => 1,
                'order' => 2,
                'image' => 'images/good_food.jpg'
            ],
            [
                'test_id' => 3,
                'text' => 'Текст питання №1',
                'description' => 'Опис питання №1',
                'bal' => 1,
                'type' => 0,
                'active' => 1,
                'order' => 0,
                'image' => 'images/good_food.jpg'
            ],
            [
                'test_id' => 3,
                'text' => 'Текст питання №2',
                'description' => 'Опис питання №2',
                'bal' => 1,
                'type' => 1,
                'active' => 1,
                'order' => 1,
                'image' => 'images/good_food.jpg'
            ],
            [
                'test_id' => 3,
                'text' => 'Текст питання №3',
                'description' => 'Опис питання №3',
                'bal' => 1,
                'type' => 2,
                'active' => 1,
                'order' => 2,
                'image' => 'images/good_food.jpg'
            ],
        ];

        foreach ($dataArray as $item) {
            Question::insert([
                'test_id' => $item['test_id'],
                'text' => $item['text'],
                'description' => $item['description'],
                'bal' => $item['bal'],
                'type' => $item['type'],
                'active' => $item['active'],
                'order' => $item['order'],
                'image' => $item['image'],
            ]);
        }
    }
}
