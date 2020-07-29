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
    protected $title = "Опитування";

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
            AdminColumnEditable::select('type')->setLabel('Тип')->setWidth('100px')
                ->setOptions(['тест','анкета'])
                ->setDisplay('Тип')
                ->setTitle('Оберіть тип:'),
//            AdminColumnEditable::text('description', 'Опис')->setWidth('200px'),
            AdminColumnEditable::checkbox('active', 'Відкрито')->setWidth('120px'),
            AdminColumn::count('relshipTestsQuestions', 'Питань'),
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
                        AdminFormElement::ckeditor('description','Опис'),
                        AdminFormElement::textarea('settings','Налаштування: 
                        ф-я/діапазон/підсумок/початок:кінець*назва|початок:кінець*назва|...
                        '),
                        $active = AdminFormElement::checkbox('active','Активный')
                            ->setValidationRules(['boolean']),
                        AdminFormElement::number('order','Порядок'),
                        AdminFormElement::image('image','Зображення'),
                    ];
                },'col-xs-3 col-sm-6 col-md-8 col-lg-5')->addColumn(function () {
                    return [
                        AdminFormElement::html("<a href='#bottom'>&darr;</a>"),
                        AdminFormElement::hasMany('relshipTestsQuestions', [
                            AdminFormElement::text('text_q','Питання')
                                ->setHtmlAttribute('placeholder','Питання')
                                ->setHtmlAttribute('maxlength', '2055')
                                ->setHtmlAttribute('minlength', '1')
                                ->setValidationRules([
                                    'required', 'string', 'between:1,2055',
                                ]),
                            AdminFormElement::number('bal_q','Бал'),
                            AdminFormElement::select('type_q')->setLabel('Тип питання')
                                ->setOptions(['Один', 'Багато', 'Відкрите'])
                                ->setDisplay('Тип')->required()
//                                ->setTitle('Оберіть тип:')
                            ,
                            AdminFormElement::checkbox('active_q','Видимість')->setHtmlAttribute('checked',true),
//                        AdminFormElement::image('image','Зображення'),
                        ]),
                    ];
                },'col-xs-12 col-sm-6 col-md-8 col-lg-7')
        );

        $form->getButtons()
            ->setPlacements([
//                'after' => ['title', 'date'],
                'before' => ['title']
            ]);
        $table = AdminDisplay::table([
            AdminColumn::action('export', 'Export')->setIcon('fa fa-share')->setAction('/#button')])
            ->setColumns([
                AdminColumn::checkbox(),]);

        $table->getActions()
            ->setPlacement('panel.buttons')
            ->setHtmlAttribute('class', 'pull-right');


        $form->setItems(
            AdminFormElement::html("<a name='bottom'>bottom</a>")

        );

        return $form;
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
