<?php

namespace App\Http\Sections;

use AdminColumnEditable;
use AdminDisplay;
use AdminColumn;
use AdminDisplayFilter;
use AdminForm;
use AdminFormElement;
use AdminColumnFilter;
use App\User;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Display\Extension\FilterInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Form\Buttons\Save;
use SleepingOwl\Admin\Form\Buttons\SaveAndClose;
use SleepingOwl\Admin\Form\Buttons\Cancel;
use SleepingOwl\Admin\Form\Buttons\SaveAndCreate;

/**
 * Class Users
 *
 * @property \App\User $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Users extends Section implements Initializable
{
    /**
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title="Користувачі";

    /**
     * @var string
     */
    protected $alias;

    /**
     * Initialize class.
     */
    public function initialize()
    {
        $this->addToNavigation()->setPriority(100)->setIcon('fas fa-users');
    }

    /**
     * @param array $payload
     *
     * @return DisplayInterface
     */
    public function onDisplay($payload = [])
    {

        $sex=['жіноча', 'чоловіча'];

        $columns = [
            AdminColumn::text('id', '#')->setWidth('50px')->setHtmlAttribute('class', 'text-center'),
            AdminColumn::link('name', 'ПІБ', 'created_at')
                ->setSearchCallback(function($column, $query, $search){
                    return $query
                        ->orWhere('name', 'like', '%'.$search.'%')
                        ->orWhere('created_at', 'like', '%'.$search.'%')
                    ;
                })
                ->setOrderable(function($query, $direction) {
                    $query->orderBy('created_at', $direction);
                })
            ,
            AdminColumnEditable::text('group', 'Навчальна група')->setWidth('170px'),
            AdminColumnEditable::text('birthday', 'Дата народження')->setWidth('170px'),
            AdminColumnEditable::select('sex')->setLabel('Стать')->setWidth('100px')
                ->setOptions($sex)
                ->setDisplay('Стаь')
                ->setTitle('Оберіть стать:'),

            AdminColumnEditable::text('year_in', 'Рік вступу')->setWidth('100px'),
            AdminColumnEditable::text('email', 'E-mail')->setWidth('170px'),
            AdminColumnEditable::checkbox('status', 'Активовано')->setWidth('150px'),
            AdminColumn::text('created_at', 'Created / updated', 'updated_at')
                ->setWidth('160px')
                ->setOrderable(function($query, $direction) {
                    $query->orderBy('updated_at', $direction);
                })
                ->setSearchable(false)
            ,
        ];

        $display = AdminDisplay::datatables()
            ->setName('firstdatatables')
            ->setOrder([[0, 'asc']])
            ->setDisplaySearch(true)
            ->paginate(25)
            ->setColumns($columns)
//            ->setHtmlAttribute('class', 'table-primary table-hover th-center')
        ;

//        $display->setColumnFilters([
//            null,
//            AdminColumnFilter::select()
//                ->setOptions(
//                    ()
//                )
//                ->setOperator(FilterInterface::EQUAL)
//                ->setPlaceholder('ПІБ')
//                ->setHtmlAttribute('style', 'width:100%'),
//            null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,
//        ]);

        $display->setColumnFilters([
            null,
//            AdminColumnFilter::select(new User, 'name')->setDisplay('Name')->setPlaceholder('Select Name')->setColumnName('name'),
            AdminColumnFilter::select()
                ->setModelForOptions(User::class, 'name')->setLoadOptionsQueryPreparer(function($element, $query) {
                    return $query;
                })->setDisplay('name')->setUsageKey('name')
                ->setPlaceholder('All names'),
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
//        $menuBlocks = Menus::pluck('title','id')->toArray();
//        $menuList = Menulist::pluck('title','id')->toArray();
//        $menuList[0] = 'root';
        $sex = ['жіноча', 'чоловіча'];

        $form = AdminForm::card()->addBody([
            AdminFormElement::columns()->addColumn([
                AdminFormElement::text('name', 'ПІБ')->required(),
                AdminFormElement::text('group', 'Група')->required(),
                AdminFormElement::date('birthday', 'Дата народження')->required()->setFormat('Y-m-d'),

                AdminFormElement::select('sex', 'Стать')
                    ->setOptions($sex)
                    ->setDisplay('Стать')
                    ->setValidationRules([
                        'required',
                    ]),

            ], 'col-xs-12 col-sm-6 col-md-4 col-lg-4')->addColumn([
                AdminFormElement::text('id', 'ID')->setReadonly(true),
                AdminFormElement::text('email','E-mail'),
                AdminFormElement::checkbox('status','Активований'),
                AdminFormElement::number('year_in','Рік вступу'),
                AdminFormElement::text('created_at', 'Created / updated', 'updated_at'),

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
