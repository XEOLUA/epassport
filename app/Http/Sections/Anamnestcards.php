<?php

namespace App\Http\Sections;

use AdminColumnEditable;
use AdminDisplay;
use AdminColumn;
use AdminForm;
use AdminFormElement;
use AdminColumnFilter;
use App\User;
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
 * Class Anamnestcards
 *
 * @property \App\Anamnest $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Anamnestcards extends Section implements Initializable
{
    /**
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title = "Анамнестичні записи";

    /**
     * @var string
     */
    protected $alias;

    /**
     * Initialize class.
     */
    public function initialize()
    {
        $this->addToNavigation()->setPriority(100)->setIcon('fas fa-vr-cardboard');
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
        $display->with('relshipAnamnestcardsUsers', 'relshipUsersAnamnestcards');

        $columns = [
            AdminColumn::text('id', '#')->setWidth('50px')
                ->setHtmlAttribute('class', 'text-center')
                ->setSearchable(false),
            AdminColumn::link('relshipAnamnestcardsUsers.name', 'Name')
                ->setSearchCallback(function ($column, $query, $search){
                    $query->orwhere('users.name', 'like', "%$search%")->
                    orwhere('users.group', 'like', "%$search%");
                }),
            AdminColumnEditable::text('description_anamnests', 'Опис'),
            AdminColumn::text('relshipAnamnestcardsUsers.group', 'Група')->setSearchable(false),
            AdminColumn::image('image', 'Зображення'),
            AdminColumn::text('created_at', 'Created / updated', 'updated_at')
                ->setWidth('160px')
                ->setSearchable(false),
        ];

        $display = AdminDisplay::datatables()
//            ->setName('firstdatatables')
            ->setOrder([[2, 'asc']])
            ->setDisplaySearch(true)
//            ->paginate(25)
            ->setColumns($columns)
            ->setHtmlAttribute('class', 'table-primary table-hoverr')
        ;

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
        $users = User::where('role',1)->orderBy('name')->pluck('name','id')->toArray();

//        dd($users);

        $display = AdminDisplay::datatablesAsync()->setDatatableAttributes(['bInfo' => false]);
        $display->with('relshipAnamnestcardsUsers', 'relshipUsersAnamnestcards');

        $form = AdminForm::card()->addBody([
            AdminFormElement::columns()->addColumn([
                AdminFormElement::select('user_id', 'ПІБ студента', $users)
                    ->setDisplay('ПІБ')->required(),

                AdminFormElement::html('<hr>'),
                AdminFormElement::datetime('created_at')
                    ->setVisible(true)
                    ->setReadonly(false)
                ,
                AdminFormElement::html('last AdminFormElement without comma')
            ], 'col-xs-12 col-sm-6 col-md-4 col-lg-4')->addColumn([
                AdminFormElement::textarea('description_anamnests', 'Опис')->setRows(3),
            ], 'col-xs-12 col-sm-6 col-md-8 col-lg-8'),
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
