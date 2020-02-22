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
                'description' => 'Не дуже довгий текст опису слайду - 1',
                'link' => '#',
                'order' => 0
            ],
            [
                'title' => 'Заголовок слайду - 2',
                'description' => 'Не дуже довгий текст опису слайду - 2',
                'link' => '#',
                'order' => 1
            ],
            [
                'title' => 'Заголовок слайду - 3',
                'description' => 'Не дуже довгий текст опису слайду - 3',
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
