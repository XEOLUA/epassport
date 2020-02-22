<?php

namespace App\Http\Sections;

use AdminColumnEditable;
use AdminDisplay;
use AdminColumn;
use AdminForm;
use AdminFormElement;
use AdminColumnFilter;
use App\Menulists;
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
 * Class Menuses
 *
 * @property \App\Menus $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Menuses extends Section implements Initializable
{
    /**
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title="Блоки меню";

    /**
     * @var string
     */
    protected $alias;

    /**
     * Initialize class.
     */
    public function initialize()
    {
        $this->addToNavigation()->setPriority(100)->setIcon('fas fa-list-alt');
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
            AdminColumnEditable::text('title')->setLabel('Назва меню'),
            AdminColumnEditable::text('description')->setLabel('Опис'),
            AdminColumnEditable::checkbox('active')->setLabel('Активнісь'),
        ];

        $display = AdminDisplay::datatables()
            ->setOrder([[0, 'asc']])
            ->setDisplaySearch(true)
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
            AdminFormElement::columns()
                ->addColumn([

                    AdminFormElement::text('title', 'Заголовок')->required(),
                    AdminFormElement::text('description', 'Опис')->required(),

                ], 'col-xs-12 col-sm-6 col-md-4 col-lg-4')
                ->addColumn([
                    AdminFormElement::text('id', 'ID')->setReadonly(true),
                    AdminFormElement::checkbox('active', 'Доступний'),
                ], 'col-xs-12 col-sm-6 col-md-8 col-lg-8'),
        ]);

        $form->getButtons()->setButtons([
            'save'  => new Save(),
            'save_and_close'  => new SaveAndClose(),
            'save_and_create'  => new SaveAndCreate(),
            'cancel'  => (new Cancel()),
        ]);

        return $form;

//        $menus = Menulists::where('menu_id',$id)->pluck('title','id')->toArray();
//        $menus[0]='root';
//
//        $form = AdminForm::card()->addBody([
//            AdminFormElement::hasMany('relshipMenus', [
//                AdminFormElement::columns()
//                    ->addColumn([
//                        AdminFormElement::select('parent_id')
//                            ->setOptions($menus)
//                            ->setDisplay('Меню')
//                            ->setValidationRules([
//                            ]),
//                        AdminFormElement::text('title', 'Назва пункту')->required(),
//                        AdminFormElement::text('link', 'URL'),
//                        ],'col-xs-12 col-sm-6 col-md-4 col-lg-4')
//                    ->addColumn([
//                        AdminFormElement::text('description', 'Опис'),
//                        AdminFormElement::text('settings', 'Параметри'),
//                        AdminFormElement::checkbox('active', 'Видимість'),
//                        AdminFormElement::number('order', 'Впорядкування'),
//                    ],'col-xs-12 col-sm-6 col-md-4 col-lg-4'),
//            ]),
//        ]);

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
