<?php

use App\Answer;
use Illuminate\Database\Seeder;

class AddDataToTableAnswers extends Seeder
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
                'question_id' => 1,
                'text' => 'Текст варіанта відповіді №1',
                'bal' => 100,
                'active' => 1,
                'order' => 0,
            ],
            [
                'question_id' => 1,
                'text' => 'Текст варіанта відповіді №2',
                'bal' => 0,
                'active' => 1,
                'order' => 1,
            ],
            [
                'question_id' => 2,
                'text' => 'Текст варіанта відповіді №1',
                'bal' => 100,
                'active' => 1,
                'order' => 0,
            ],
            [
                'question_id' => 2,
                'text' => 'Текст варіанта відповіді №2',
                'bal' => -50,
                'active' => 1,
                'order' => 1,
            ],
            [
                'question_id' => 4,
                'text' => 'Текст варіанта відповіді №1',
                'bal' => 100,
                'active' => 1,
                'order' => 0,
            ],
            [
                'question_id' => 4,
                'text' => 'Текст варіанта відповіді №2',
                'bal' => 0,
                'active' => 1,
                'order' => 1,
            ],
            [
                'question_id' => 5,
                'text' => 'Текст варіанта відповіді №1',
                'bal' => 100,
                'active' => 1,
                'order' => 0,
            ],
            [
                'question_id' => 5,
                'text' => 'Текст варіанта відповіді №2',
                'bal' => -50,
                'active' => 1,
                'order' => 1,
            ],
            [
                'question_id' => 7,
                'text' => 'Текст варіанта відповіді №1',
                'bal' => 100,
                'active' => 1,
                'order' => 0,
            ],
            [
                'question_id' => 7,
                'text' => 'Текст варіанта відповіді №2',
                'bal' => 0,
                'active' => 1,
                'order' => 1,
            ],
            [
                'question_id' => 8,
                'text' => 'Текст варіанта відповіді №1',
                'bal' => 100,
                'active' => 1,
                'order' => 0,
            ],
            [
                'question_id' => 8,
                'text' => 'Текст варіанта відповіді №2',
                'bal' => -50,
                'active' => 1,
                'order' => 1,
            ],


        ];

        foreach ($dataArray as $item) {
            Answer::insert([
                'question_id' => $item['question_id'],
                'text' => $item['text'],
                'bal' => $item['bal'],
                'active' => $item['active'],
                'order' => $item['order'],
            ]);
        }
    }
}
