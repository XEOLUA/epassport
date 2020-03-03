<?php

use App\Ambulcard;
use Illuminate\Database\Seeder;

class AddDataToTableAmbulcards extends Seeder
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
                'user_id' => 6,
                'diagnosis' => 'Вірус',
                'desc_ambulcard' => 'Вірус з короною',
            ],
            [
                'user_id' => 5,
                'diagnosis' => 'Вірус',
                'desc_ambulcard' => 'Вірус з короною',
            ],
            [
                'user_id' => 5,
                'diagnosis' => 'Свинка',
                'desc_ambulcard' => 'Хвіст спіраллю',
            ]
        ];

        foreach ($dataArray as $item) {
            Ambulcard::insert([
                'user_id' => $item['user_id'],
                'diagnosis' => $item['diagnosis'],
                'desc_ambulcard' => $item['desc_ambulcard'],
            ]);
        }
    }
}
