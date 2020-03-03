<?php

namespace App\Http\Sections;

use AdminColumnEditable;
use AdminDisplay;
use AdminColumn;
use AdminForm;
use AdminFormElement;
use AdminColumnFilter;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Form\Buttons\Save;
use SleepingOwl\Admin\Form\Buttons\SaveAndClose;
use SleepingOwl\Admin\Form\Buttons\Cancel;
use SleepingOwl\Admin\Form\Buttons\SaveAndCreate;

/**
 * Class Students
 *
 * @property \App\Student $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Students extends Section implements Initializable
{
    /**
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title = "Студенти";

    /**
     * @var string
     */
    protected $alias;

    /**
     * Initialize class.
     */
    public function initialize()
    {
        $this->addToNavigation()->setPriority(100)->setIcon('fas fa-user-graduate');
    }

    /**
     * @param array $payload
     *
     * @return DisplayInterface
     */
    public function onDisplay($payload = [])
    {
        $i=0;
        $columns = [
            AdminColumn::custom('#', function()use(&$i) {
                $i++;
                return $i;
            })->setWidth('50px'),
            AdminColumn::link('name', 'ПІБ'),
            AdminColumnEditable::text('group', 'Група'),
            AdminColumnEditable::text('year_in', 'Рік вступу'),
            AdminColumn::lists('relStudentAmbularcard.diagnosis', 'Амбулаторні записи')
                ->setSearchCallback(function ($column, $query, $search){
                    $query->orwhere('relStudentAmbularcard.diagnosis', 'like', "%$search%");})
            ,
            AdminColumn::lists('relStudentAnamnest.description', 'Анамнестичні записи'),

            AdminColumn::boolean('status', 'Активований'),
        ];

        $display = AdminDisplay::datatables()
            ->setApply(function ($query){
                $query->where('role',1);
            })
            ->setName('firstdatatables')
            ->setOrder([[1,'asc']])
            ->setDisplaySearch(true)
            ->paginate(25)
            ->setColumns($columns)
            ->setHtmlAttribute('class', 'table-primary table-hover');

        $display->getColumnFilters()->setPlacement('card.heading');

        return $display;
    }

    /**
     * @param int|null $id
     * @param array $payload
     *
     * @return FormInterface
     */
    public function onEdit($id = null, $payload = [])
    {
        $tabs = AdminDisplay::tabbed();

        $tabs->setTabs(function ($id) {
            $tabs = [];

            $tabs[] = AdminDisplay::tab(AdminForm::elements([
                AdminFormElement::columns()->addColumn([
                    AdminFormElement::text('name', 'Name')->required(),
                    AdminFormElement::text('group', 'Група'),
                    AdminFormElement::html('<hr>'),
                    AdminFormElement::datetime('created_at')
                        ->setVisible(true)
                        ->setReadonly(false)
                    ,

                ], 'col-xs-12 col-sm-6 col-md-4 col-lg-4')->addColumn([
                    AdminFormElement::text('id', 'ID')->setReadonly(true),

                ], 'col-xs-12 col-sm-6 col-md-8 col-lg-8'),
            ]))->setLabel('Студент')->setName('tab1');

            $tabs[] = AdminDisplay::tab(new \SleepingOwl\Admin\Form\FormElements([
                AdminFormElement::hasMany('relStudentAmbularcard', [

                    AdminFormElement::text('diagnosis','Діагноз')->required(),
                    AdminFormElement::textarea('desc_ambulcard','Опис')
                        ->setName('relStudentAmbularcard[new_undefined][desc_ambulcard]'),
                    AdminFormElement::upload('image', 'Image'), // Элемент загрузки картинки
                    AdminFormElement::image('image','Зображення'),
                ]),
            ]))->setLabel('Амбулаторні записи')->setName('tab2');

            $tabs[] = AdminDisplay::tab(new \SleepingOwl\Admin\Form\FormElements([
                AdminFormElement::hasMany('relStudentAnamnest', [

                    AdminFormElement::textarea('description','Опис')
                        ->setName('relStudentAnamnest[new_undefined][description]'),
                ]),
            ]))->setLabel('Анамнестичні дані')->setName('tab3');

              return $tabs;
        });

        $form = AdminForm::card()
            ->addHeader([
                $tabs
            ]);

//        dd($form);

        $form->getButtons()->setButtons([
            'save'  => new Save(),
            'save_and_close'  => new SaveAndClose(),
            'save_and_create'  => new SaveAndCreate(),
            'cancel'  => (new Cancel()),
        ]);

        return $form;
    }

    /**
     * @return FormInterface
//     */
//    public function onCreate($payload = [])
//    {
//        return $this->onEdit(null, $payload);
//    }

    /**
     * @return bool
     */
//    public function isDeletable(Model $model)
//    {
//        return true;
//    }

    /**
     * @return void
     */
    public function onRestore($id)
    {
        // remove if unused
    }
}
