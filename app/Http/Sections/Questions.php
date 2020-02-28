<?php

namespace App\Http\Sections;

use AdminColumnEditable;
use AdminDisplay;
use AdminColumn;
use AdminDisplayFilter;
use AdminForm;
use AdminFormElement;
use AdminColumnFilter;
use App\Question;
use App\Test;
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
 * Class Questions
 *
 * @property \App\Question $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Questions extends Section implements Initializable
{
    /**
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title = "Питання";

    /**
     * @var string
     */
    protected $alias;

    /**
     * Initialize class.
     */
    public function initialize()
    {
        $this->addToNavigation()->setPriority(100)->setIcon('fas fa-question-circle');
    }

    /**
     * @param array $payload
     *
     * @return DisplayInterface
     */
    public function onDisplay($payload = [])
    {
        $display = AdminDisplay::datatablesAsync()->setDatatableAttributes(['bInfo' => false])->setDisplaySearch(true)->paginate(10);

        $display->setHtmlAttribute('class', 'table-info table-hover');
        $display->with('relshipTestsQuestions', 'relshipQuestionsTests');

        $columns = [
            AdminColumn::text('id', '#')->setWidth('50px')->setHtmlAttribute('class', 'text-center'),
            AdminColumnEditable::text('text', 'Питання'),
            AdminColumnEditable::select('type')->setLabel('Тип питання')->setWidth('250px')
                ->setOptions(['Один', 'Багато', 'Відкрите'])
                ->setDisplay('Тип')
                ->setTitle('Оберіть тип:'),
//            AdminColumnEditable::text('description', 'Опис'),
            AdminColumnEditable::checkbox('active', 'Відкрито')->setWidth('120px'),
            AdminColumn::relatedLink('relshipQuestionsTests.title','Тест'),
            AdminColumn::count('relshipQuestionsAnswers', 'Відповідей'),
            AdminColumn::order('order')->setLabel('Порядок')->setWidth('90px'),
            AdminColumn::image('image', 'Світлина')->setWidth('50px')->setHtmlAttribute('class', 'text-center'),
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
        $display = AdminDisplay::datatables()
            ->setName('firstdatatables')
            ->setOrder([[0, 'asc']])
            ->setDisplaySearch(true)
            ->paginate(25)
            ->setColumns($columns)
//            ->setHtmlAttribute('class', 'table-primary table-hover th-center')
        ;

        $display->setColumnFilters([
            null,
            AdminColumnFilter::select(new Test, 'test_id')->setDisplay('title')->setPlaceholder('Оберіть тест')->setColumnName('test_id'),
        ]);
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
                        $question = AdminFormElement::text('text', 'Питання')
                            ->setHtmlAttribute('placeholder', 'Назва питання')
                            ->setHtmlAttribute('maxlength', '255')
                            ->setHtmlAttribute('minlength', '1')
                            ->setValidationRules([
                                'required', 'string', 'between:1,255',
                            ]),
                        AdminFormElement::textarea('description','Опис')->setRows(2),
                        AdminFormElement::number('bal','Бал'),
                        $active = AdminFormElement::checkbox('active','Активный')
                            ->setValidationRules(['boolean']),
                        AdminFormElement::number('order','Порядок'),
                        AdminFormElement::image('image','Зображення'),
                    ];
                },'col-xs-3 col-sm-6 col-md-8 col-lg-3')->addColumn(function () {
                    return [
                        AdminFormElement::hasMany('relshipQuestionsAnswers', [
                            AdminFormElement::text('text','Відповідь')
                                ->setHtmlAttribute('placeholder','Відповідь')
                                ->setHtmlAttribute('maxlength', '255')
                                ->setHtmlAttribute('minlength', '1')
                                ->setValidationRules([
                                    'required', 'string', 'between:1,255',
                                ]),
                            AdminFormElement::number('bal','Бал')->required()
                                ->setHtmlAttribute('placeholder',1)->setDefaultValue(1),
                            AdminFormElement::checkbox('active')->setLabel('Видимість')
//                                ->setHtmlAttribute('checked','true')
                            ,
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
    }

    /**
     * @return FormInterface
     */
    public function onCreate($payload = [])
    {
        return "Питання створювати можна тільки в <a href=/admin/tests/>Тестах</a>";
//        return $this->onEdit(null, $payload);
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
