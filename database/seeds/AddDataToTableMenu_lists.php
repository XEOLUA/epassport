<?php

use App\Menulist;
use Illuminate\Database\Seeder;

class AddDataToTableMenu_lists extends Seeder
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
                'title' => 'Автори',
                'description' => 'Над проєктом працюють',
                'link' => '#workers',
                'menu_id' => 1,
                'parent_id' => null,
                'order' => 3,
                'active' => 1
            ],
            [
                'title' => 'Статті',
                'description' => 'Корисні статті',
                'link' => '#articles',
                'menu_id' => 1,
                'parent_id' => null,
                'order' => 4,
                'active' => 1
            ],
        ];

        foreach ($dataArray as $item) {
            Menulist::insert([
                'title' => $item['title'],
                'description' => $item['description'],
                'link' => $item['link'],
                'menu_id' => $item['menu_id'],
                'parent_id' => $item['parent_id'],
                'order' => $item['order'],
                'active' => $item['active'],
            ]);
        }
    }
}
