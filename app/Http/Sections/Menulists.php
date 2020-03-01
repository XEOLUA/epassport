<?php

namespace App\Http\Sections;

use AdminColumnEditable;
use AdminDisplay;
use AdminColumn;
use AdminForm;
use AdminFormElement;
use AdminColumnFilter;
use App\Menulist;
use App\Menus;
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
 * Class Menulists
 *
 * @property \App\Menulist $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Menulists extends Section implements Initializable
{
    /**
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title="Пункти меню";

    /**
     * @var string
     */
    protected $alias;

    /**
     * Initialize class.
     */
    public function initialize()
    {
        $this->addToNavigation()->setPriority(100)->setIcon('fas fa-list-ul');
    }

    /**
     * @param array $payload
     *
     * @return DisplayInterface
     */
    public function onDisplay($payload = [])
    {

        $menuBlocks = Menus::pluck('title','id')->toArray();
        $menuList = Menulist::pluck('title','id')->toArray();

        $columns = [
            AdminColumn::text('id', '#')->setWidth('50px')->setHtmlAttribute('class', 'text-center'),
            AdminColumnEditable::text('title')->setLabel('Заголовок'),
            AdminColumnEditable::text('link')->setLabel('URL'),
            AdminColumnEditable::select('parent_id')->setLabel('Батьківський пункт')->setWidth('250px')
                ->setOptions($menuList)
                ->setDisplay('Меню')
                ->setTitle('Выберите категорию:'),
            AdminColumnEditable::select('menu_id')->setLabel('Блок меню')->setWidth('250px')
                ->setOptions($menuBlocks)
                ->setDisplay('Меню')
                ->setTitle('Выберите категорию:'),
//            AdminColumn::text('order'),
            AdminColumn::order('order')->setLabel('Порядок')->setWidth('90px'),
            AdminColumnEditable::checkbox('active','Опубліковано')->setWidth('150px'),
            AdminColumn::image('image','Зображення'),
        ];

        $display = AdminDisplay::datatables()
            ->setApply(function ($query) {
                $query->orderBy('order', 'asc');
            })
//            ->setOrder([[0, 'asc']])
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
        $menuBlocks = Menus::pluck('title','id')->toArray();
        $menuList = Menulist::pluck('title','id')->toArray();
        $menuList[0] = 'root';

        $form = AdminForm::card()->addBody([
                AdminFormElement::columns()->addColumn([
                AdminFormElement::text('title', 'Заголовок')->required(),
                AdminFormElement::text('link', 'URL'),

                    AdminFormElement::select('menu_id', 'Блок меню')
                        ->setOptions($menuBlocks)
                        ->setDisplay('Меню')
                        ->setValidationRules([
                            'required',
                        ]),

                    AdminFormElement::select('parent_id', 'Батько')
                        ->setOptions($menuList)
                        ->setDisplay('Батько')
                        ->setValidationRules([
                            'required',
                        ]),

            ], 'col-xs-12 col-sm-6 col-md-4 col-lg-4')->addColumn([
                AdminFormElement::text('id', 'ID')->setReadonly(true),
                AdminFormElement::text('description','Опис'),
                AdminFormElement::text('settings','Налаштування'),
                AdminFormElement::number('order','порядок'),

            ], 'col-xs-12 col-sm-6 col-md-8 col-lg-8'),
        ]);

        $form->getButtons()->setButtons([
            'save' => new Save(),
            'save_and_close' => new SaveAndClose(),
            'save_and_create' => new SaveAndCreate(),
            'cancel' => (new Cancel()),
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
