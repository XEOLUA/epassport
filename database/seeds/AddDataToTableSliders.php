<?php

use App\Slider;
use Illuminate\Database\Seeder;

class AddDataToTableSliders extends Seeder
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
                'title' => 'Заголовок слайду - 1',
                'description' => 'Не дуже довгий текст опису слайду - 1, але враховуючи, що шрифт не занадто великий, можна і щось побільше надрукувати',
                'link' => '#',
                'order' => 0
            ],
            [
                'title' => 'Заголовок слайду - 2',
                'description' => 'Не дуже довгий текст опису слайду - 2, але враховуючи, що шрифт не занадто великий, можна і щось побільше надрукувати',
                'link' => '#',
                'order' => 1
            ],
            [
                'title' => 'Заголовок слайду - 3',
                'description' => 'Не дуже довгий текст опису слайду - 3, але враховуючи, що шрифт не занадто великий, можна і щось побільше надрукувати',
                'link' => '#',
                'order' => 2
            ]
        ];

        foreach ($dataArray as $item) {
            Slider::insert([
                'title' => $item['title'],
                'description' => $item['description'],
                'link' => $item['link'],
                'order' => $item['order'],
            ]);
        }
    }
}
