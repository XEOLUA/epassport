<?php

use Illuminate\Database\Seeder;
use App\Worker;

class AddDataToTableWorkers extends Seeder
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
                'name' => 'Іваненко Світлана Петрівна',
                'description' => 'Не дуже довгий текст, що описує роботу фахівця в загальному та зокрема на даному проєкті',
                'position' => 'посада - 1',
                'sex' => 0,
                'order' => 0
            ],
            [
                'name' => 'Сидоренко Іван Сергійович',
                'description' => 'Не дуже довгий текст, що описує роботу фахівця в загальному та зокрема на даному проєкті',
                'position' => 'посада - 2',
                'sex' => 1,
                'order' => 1
            ],
            [
                'name' => 'Петренко Валентина Іванівна',
                'description' => 'Не дуже довгий текст, що описує роботу фахівця в загальному та зокрема на даному проєкті',
                'position' => 'посада - 3',
                'sex' => 0,
                'order' => 2
            ]
        ];

        foreach ($dataArray as $item) {
            Worker::insert([
                'name' => $item['name'],
                'description' => $item['description'],
                'position' => $item['position'],
                'sex' => $item['sex'],
                'order' => $item['order'],
            ]);
        }
    }
}
