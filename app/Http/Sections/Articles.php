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
 * Class Articles
 *
 * @property \App\Article $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Articles extends Section implements Initializable
{
    /**
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title = "Статті";

    /**
     * @var string
     */
    protected $alias;

    /**
     * Initialize class.
     */
    public function initialize()
    {
        $this->addToNavigation()->setPriority(100)->setIcon('far fa-newspaper');
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
            AdminColumnEditable::text('title', 'Загаловок статті'),
            AdminColumnEditable::text('description', 'Опис'),
            AdminColumnEditable::text('author', 'Автор')->setWidth('150px'),
            AdminColumnEditable::checkbox('active', 'Показати'),
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
        $form = AdminForm::card()->addBody([
            AdminFormElement::columns()->addColumn([
                AdminFormElement::text('title', 'Заголовок')->required(),
                AdminFormElement::textarea('description', 'Опис')->setRows(2),
                AdminFormElement::ckeditor('text', 'Текст'),

            ], 'col-xs-12 col-sm-6 col-md-4 col-lg-2')->addColumn([
                AdminFormElement::text('author', 'Автор'),
                AdminFormElement::text('id', 'ID')->setReadonly(true),
                AdminFormElement::image('image', 'Зображення'),
                AdminFormElement::checkbox('active', 'Відображати'),
                AdminFormElement::number('order', 'Порядок'),
            ], 'col-xs-12 col-sm-6 col-md-8 col-lg-4'),
        ]);

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
