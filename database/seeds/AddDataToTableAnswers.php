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
                'text_a' => 'Текст варіанта відповіді №1',
                'bal_a' => 100,
                'active_a' => 1,
                'order_a' => 0,
            ],
            [
                'question_id' => 1,
                'text_a' => 'Текст варіанта відповіді №2',
                'bal_a' => 0,
                'active_a' => 1,
                'order_a' => 1,
            ],
            [
                'question_id' => 2,
                'text_a' => 'Текст варіанта відповіді №1',
                'bal_a' => 100,
                'active_a' => 1,
                'order_a' => 0,
            ],
            [
                'question_id' => 2,
                'text_a' => 'Текст варіанта відповіді №2',
                'bal_a' => -50,
                'active_a' => 1,
                'order_a' => 1,
            ],
            [
                'question_id' => 4,
                'text_a' => 'Текст варіанта відповіді №1',
                'bal_a' => 100,
                'active_a' => 1,
                'order_a' => 0,
            ],
            [
                'question_id' => 4,
                'text_a' => 'Текст варіанта відповіді №2',
                'bal_a' => 0,
                'active_a' => 1,
                'order_a' => 1,
            ],
            [
                'question_id' => 5,
                'text_a' => 'Текст варіанта відповіді №1',
                'bal_a' => 100,
                'active_a' => 1,
                'order_a' => 0,
            ],
            [
                'question_id' => 5,
                'text_a' => 'Текст варіанта відповіді №2',
                'bal_a' => -50,
                'active_a' => 1,
                'order_a' => 1,
            ],
            [
                'question_id' => 7,
                'text_a' => 'Текст варіанта відповіді №1',
                'bal_a' => 100,
                'active_a' => 1,
                'order_a' => 0,
            ],
            [
                'question_id' => 7,
                'text_a' => 'Текст варіанта відповіді №2',
                'bal_a' => 0,
                'active_a' => 1,
                'order_a' => 1,
            ],
            [
                'question_id' => 8,
                'text_a' => 'Текст варіанта відповіді №1',
                'bal_a' => 100,
                'active_a' => 1,
                'order_a' => 0,
            ],
            [
                'question_id' => 8,
                'text_a' => 'Текст варіанта відповіді №2',
                'bal_a' => -50,
                'active_a' => 1,
                'order_a' => 1,
            ],


        ];

        foreach ($dataArray as $item) {
            Answer::insert([
                'question_id' => $item['question_id'],
                'text_a' => $item['text_a'],
                'bal_a' => $item['bal_a'],
                'active_a' => $item['active_a'],
                'order_a' => $item['order_a'],
            ]);
        }
    }
}
