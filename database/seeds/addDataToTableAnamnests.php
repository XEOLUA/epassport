<?php

use App\Anamnest;
use Illuminate\Database\Seeder;

class addDataToTableAnamnests extends Seeder
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
                'user_id' => 4,
                'description' => 'Опис-1',
            ],
            [
                'user_id' => 4,
                'description' => 'Опис-2',
            ],
            [
                'user_id' => 3,
                'description' => 'Опис',
            ]
        ];

        foreach ($dataArray as $item) {
            Anamnest::insert([
                'user_id' => $item['user_id'],
                'description' => $item['description'],
            ]);
        }
    }
}
