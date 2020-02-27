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
 * Class Tests
 *
 * @property \App\Test $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Tests extends Section implements Initializable
{
    /**
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title = "Тести";

    /**
     * @var string
     */
    protected $alias;

    /**
     * Initialize class.
     */
    public function initialize()
    {
        $this->addToNavigation()->setPriority(100)->setIcon('fas fa-check');
    }

    /**
     * @param array $payload
     *
     * @return DisplayInterface
     */
    public function onDisplay($payload = [])
    {
        $columns = [
            AdminColumn::text('id', '#')->setWidth('50px')->setHtmlAttribute('class', 'text-center'),
            AdminColumn::image('image', 'Світлина')->setWidth('50px')->setHtmlAttribute('class', 'text-center'),
            AdminColumnEditable::text('title', 'Назва тесту'),
            AdminColumnEditable::text('description', 'Опис'),
            AdminColumnEditable::checkbox('active', 'Відкрито'),
            AdminColumn::order('order')->setLabel('Порядок')->setWidth('90px'),
            AdminColumn::datetime('created_at')->setLabel('Дата')->setWidth('90px'),
        ];

        $display = AdminDisplay::datatables()
            ->setApply(function ($query) {
                $query->orderBy('order', 'asc');
            })
            ->paginate(25)
            ->setColumns($columns)
//            ->setHtmlAttribute('class', 'table-primary table-hover th-center')
        ;

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
                        $question = AdminFormElement::text('title', 'Тест')
                            ->setHtmlAttribute('placeholder', 'Назва теста')
                            ->setHtmlAttribute('maxlength', '255')
                            ->setHtmlAttribute('minlength', '1')
                            ->setValidationRules([
                                'required', 'string', 'between:1,255',
                            ]),
                        AdminFormElement::textarea('description','Опис')->setRows(2),
                        AdminFormElement::text('settings','Налаштування'),
                        $active = AdminFormElement::checkbox('active','Активный')
                            ->setValidationRules(['boolean']),
                        AdminFormElement::number('order','Порядок'),
                        AdminFormElement::image('image','Зображення'),
                    ];
                },'col-xs-3 col-sm-6 col-md-8 col-lg-3')->addColumn(function () {
                    return [
                        AdminFormElement::hasMany('relshipTestsQuestions', [
                        AdminFormElement::text('text','Питання')
                                ->setHtmlAttribute('placeholder','Питання')
                                ->setHtmlAttribute('maxlength', '255')
                                ->setHtmlAttribute('minlength', '1')
                                ->setValidationRules([
                                    'required', 'string', 'between:1,255',
                                ]),
                        AdminFormElement::number('bal','Бал'),
                        AdminFormElement::checkbox('active','Видимість'),
//                        AdminFormElement::image('image','Зображення'),
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
//                AdminFormElement::columns()->addColumn([
//                AdminFormElement::text('title', 'Назва тесту')->required(),
//                AdminFormElement::textarea('description', 'Опис')->setRows(7),
//                AdminFormElement::checkbox('active', 'Відкрити'),
//                AdminFormElement::number('order', 'Порядок'),
//            ], 'col-xs-12 col-sm-6 col-md-4 col-lg-8')->addColumn([
//                AdminFormElement::text('id', 'ID')->setReadonly(true),
//                AdminFormElement::image('image', 'Зображення'),
//            ], 'col-xs-12 col-sm-6 col-md-8 col-lg-4'),
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
    public function onCreate($payload = [])
    {
        return $this->onEdit(null, $payload);
    }

    /**
     * @return bool
     */
    public function isDeletable(Model $model)
    {
        return true;
    }

    /**
     * @return void
     */
    public function onRestore($id)
    {
        // remove if unused
    }
}
