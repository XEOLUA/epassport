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
                'active' => 1,
                'image' => ''
            ],
            [
                'title' => 'Статті',
                'description' => 'Корисні статті',
                'link' => '#articles',
                'menu_id' => 1,
                'parent_id' => null,
                'order' => 4,
                'active' => 1,
                'image' => ''
            ],
            [
                'title' => 'Амбулаторна картка',
                'description' => 'Дата, діагноз, опис',
                'link' => '/cabinet/amb',
                'menu_id' => 3,
                'parent_id' => null,
                'order' => 0,
                'active' => 1,
                'image' => '/images/amb.jpg'
            ],
            [
                'title' => 'Висновки спеціалістів',
                'description' => 'Висновки по студенту',
                'link' => '/cabinet/resultsspets',
                'menu_id' => 3,
                'parent_id' => null,
                'order' => 1,
                'active' => 1,
                'image' => '/images/spec.jpg'
            ],
            [
                'title' => 'Анамнестичні дані',
                'description' => 'Дата та опис',
                'link' => '/cabinet/anamn',
                'menu_id' => 3,
                'parent_id' => null,
                'order' => 2,
                'active' => 1,
                'image' => '/images/anamn.jpg'
            ],
            [
                'title' => 'Антропометричні дані',
                'description' => 'Список антропометричних форм',
                'link' => '/cabinet/listads',
                'menu_id' => 3,
                'parent_id' => null,
                'order' => 3,
                'active' => 1,
                'image' => '/images/antrop.jpg'
            ],
            [
                'title' => 'Діагностика здоров\'я',
                'description' => 'Розподіліть по рангу (1-11) негативні впливи',
                'link' => '/cabinet/rofes',
                'menu_id' => 3,
                'parent_id' => null,
                'order' => 4,
                'active' => 1,
                'image' => '/images/rof.png'
            ],
            [
                'title' => 'Довідник',
                'description' => 'Довідник',
                'link' => '/cabinet/infostr',
                'menu_id' => 3,
                'parent_id' => null,
                'order' => 5,
                'active' => 1,
                'image' => '/images/inf.png'
            ],
            [
                'title' => 'Психологічні тести',
                'description' => 'Список психологічних тестів',
                'link' => '/cabinet/listpsihtest',
                'menu_id' => 3,
                'parent_id' => null,
                'order' => 6,
                'active' => 1,
                'image' => '/images/psh1.jpg'
            ],
            [
                'title' => 'Анкети здоров\'я',
                'description' => 'Список антропометричних форм',
                'link' => '/cabinet/listanketa',
                'menu_id' => 3,
                'parent_id' => null,
                'order' => 7,
                'active' => 1,
                'image' => '/images/anketa1.jpg'
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
                'image' => $item['image'],
            ]);
        }
    }
}
