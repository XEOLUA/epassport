<?php

namespace App\Http\Sections;

use AdminDisplay;
use AdminColumn;
use AdminDisplayFilter;
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
 * Class Ambulcardsusers
 *
 * @property \App\User $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Ambulcardsusers extends Section implements Initializable
{
    /**
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title="Амбулаторні студентів";

    /**
     * @var string
     */
    protected $alias;

    /**
     * Initialize class.
     */
    public function initialize()
    {
        $this->addToNavigation()->setPriority(100)->setIcon('fas fa-address-card');
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
//            AdminColumn::custom('Амбулаторна картка',
//                function(\Illuminate\Database\Eloquent\Model $model) {
//                return "<a href=/admin/ambulcards/create>link</a>";
//            })->setWidth('150px'),

            AdminColumn::lists('relshipStudentsAmbulcards.diagnosis', 'Діагноз')
                ->setSearchCallback(function ($column, $query, $search){
                    $query->orwhere('ambulcards.diagnosis', 'like', "%$search%");
                }),
            AdminColumn::text('group', 'Група'),
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
        $form = AdminForm::panel();
        $form->setItems(
            AdminFormElement::columns()
                ->addColumn(function () {
                    return [
                        $ambulRecords = AdminFormElement::text('name', 'ПІБ студента')
                            ->setHtmlAttribute('placeholder', 'Студент')
                            ->setValidationRules([
                                'required', 'string', 'between:1,255',
                            ])->setReadonly(true),
                        AdminFormElement::text('group','Група')->setReadonly(true),
                        AdminFormElement::text('year_in','Рік вступу')->setReadonly(true),
                    ];
                },'col-xs-3 col-sm-6 col-md-8 col-lg-3')->addColumn(function () {
                    return [
                        AdminFormElement::hasMany('relshipStudentsAmbulcards', [


                            AdminFormElement::text('diagnosis','Діагноз')
                                ->setHtmlAttribute('placeholder','Діагноз')
                                ->setHtmlAttribute('maxlength', '255')
                                ->setHtmlAttribute('minlength', '1')
                                ->setValidationRules([
                                    'required', 'string', 'between:1,255',
                                ]),
                            AdminFormElement::textarea('description','Опис')->setRows(2),
                            AdminFormElement::image('image','Зображення'),
                        ]),
                    ];
                },'col-xs-12 col-sm-6 col-md-8 col-lg-9')
//                ->addColumn(function (){
//                return [
//                    AdminFormElement::hasMany('relshipQuestionsAnswers', [
//                    AdminFormElement::text('text','Текст відповіді'),
//                        ]),
//                ];
//            })
        );

        return $form;


//        $form = AdminForm::card()->addBody([
//            AdminFormElement::columns()->addColumn([
//                AdminFormElement::text('name', 'Name')
//                    ->required()
//                ,
//                AdminFormElement::html('<hr>'),
//                AdminFormElement::datetime('created_at')
//                    ->setVisible(true)
//                    ->setReadonly(false)
//                ,
//                AdminFormElement::html('last AdminFormElement without comma')
//            ], 'col-xs-12 col-sm-6 col-md-4 col-lg-4')->addColumn([
//                AdminFormElement::text('id', 'ID')->setReadonly(true),
//                AdminFormElement::html('last AdminFormElement without comma')
//            ], 'col-xs-12 col-sm-6 col-md-8 col-lg-8'),
//        ]);
//
//        $form->getButtons()->setButtons([
//            'save'  => new Save(),
//            'save_and_close'  => new SaveAndClose(),
//            'save_and_create'  => new SaveAndCreate(),
//            'cancel'  => (new Cancel()),
//        ]);
//
//        return $form;
    }

    /**
     * @return FormInterface
     */
//    public function onCreate($payload = [])
//    {
////        return redirect("admin/ambulcards/create");
//
//        $form = AdminForm::panel();
//        $form->setItems(
//            AdminFormElement::columns()
//                ->addColumn(function () {
//                    return [
//                        $ambulRecords = AdminFormElement::text('name', 'ПІБ студента')
//                            ->setHtmlAttribute('placeholder', 'Студент')
//                            ->setValidationRules([
//                                'required', 'string', 'between:1,255',
//                            ]),
//                        AdminFormElement::text('group','Група'),
//                    ];
//                },'col-xs-3 col-sm-6 col-md-8 col-lg-3')->addColumn(function () {
//                    return [
//                        AdminFormElement::hasMany('relshipStudentsAmbulcards', [
//                            AdminFormElement::text('diagnosis','Діагноз')
//                                ->setHtmlAttribute('placeholder','Діагноз')
//                                ->setHtmlAttribute('maxlength', '255')
//                                ->setHtmlAttribute('minlength', '1')
//                                ->setValidationRules([
//                                    'required', 'string', 'between:1,255',
//                                ]),
//                            AdminFormElement::textarea('description','Опис')->required()->setRows(2),
//                        AdminFormElement::image('image','Зображення'),
//                        ]),
//                    ];
//                },'col-xs-12 col-sm-6 col-md-8 col-lg-9')
////                ->addColumn(function (){
////                return [
////                    AdminFormElement::hasMany('relshipQuestionsAnswers', [
////                    AdminFormElement::text('text','Текст відповіді'),
////                        ]),
////                ];
////            })
//        );
//
//        return $form;
//
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
