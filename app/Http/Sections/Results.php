<?php

namespace App\Http\Sections;

use AdminDisplay;
use AdminColumn;
use AdminForm;
use AdminFormElement;
use AdminColumnFilter;
use App\Result;
use App\Test;
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
 * Class Results
 *
 * @property \App\Result $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Results extends Section implements Initializable
{
    /**
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title="Результати";

    /**
     * @var string
     */
    protected $alias;

    /**
     * Initialize class.
     */
    public function initialize()
    {
        $this->addToNavigation()->setPriority(100)->setIcon('fas fa-poll-h');
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
        $display->with('relshipResultsTests', 'relshipResultsUsers');

        $columns = [
            AdminColumn::text('id', '#')->setWidth('50px')
                ->setHtmlAttribute('class', 'text-center')
                ->setSearchable(false),
            AdminColumn::text('relshipResultsTests.title', 'Тест')
                ->setSearchCallback(function($column, $query, $search){
                    return
                        $query->WhereHas('relshipResultsTests',function ($q) use($search){
                            $q->Where('title', 'like', '%'.$search.'%');
                        });
                }),
            AdminColumn::text('relshipResultsUsers.name', 'Студент')
                ->setSearchCallback(function($column, $query, $search){
                    return
                        $query->orWhereHas('relshipResultsUsers',function ($q) use($search){
                            $q->Where('name', 'like', '%'.$search.'%');
                        });
                }),
            AdminColumn::text('created_at', 'Created / updated', 'updated_at')
                ->setWidth('160px')
                ->setOrderable(function($query, $direction) {
                    $query->orderBy('updated_at', $direction);
                })
                ->setSearchable(false),
        ];

        $display = AdminDisplay::datatables()
            ->setName('firstdatatables')
            ->setOrder([[0, 'asc']])
            ->setDisplaySearch(true)
            ->paginate(25)
            ->setColumns($columns)
            ->setHtmlAttribute('class', 'table-primary table-hover')
        ;

        $testsInResults = Result::query()->pluck('test_id','test_id')->toArray();

//        $display->setColumnFilters([
//            null,
//            AdminColumnFilter::select()
//                ->setOptions((new Test())->whereIn('id',$testsInResults)->pluck('title','id')->toArray())
//                ->setDisplay('title')
//                ->setPlaceholder('Оберіть тест')
//                ->setColumnName('test_id'),
//        ]);

        $usersInResults = Result::query()->pluck('user_id','user_id')->toArray();

        $display->setColumnFilters([
            null,
            AdminColumnFilter::select()
                ->setOptions((new User())->whereIn('id',$usersInResults)->pluck('name','id')->toArray())
                ->setDisplay('name')
                ->setPlaceholder('Оберіть студента')
                ->setColumnName('user_id')
        ,
            null,
            AdminColumnFilter::select()
                ->setOptions((new Test())->whereIn('id',$testsInResults)->pluck('title','id')->toArray())
                ->setDisplay('title')
                ->setPlaceholder('Оберіть тест')
                ->setColumnName('test_id'),
        ]);

//        $display->setColumnFilters([
//            AdminColumnFilter::select()
//                ->setModelForOptions(\App\Result::class, 'name')
//                ->setLoadOptionsQueryPreparer(function($element, $query) {
//                    return $query;
//                })
//                ->setDisplay('name')
//                ->setColumnName('name')
//                ->setPlaceholder('All names')
//            ,
//        ]);
        $display->getColumnFilters()->setPlacement('card.heading');

        return $display;
    }

    /**
     * @param int|null $id
     * @param array $payload
     *
     * @return FormInterface
     */
//    public function onEdit($id = null, $payload = [])
//    {
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
//    }
//
//    /**
//     * @return FormInterface
//     */
//    public function onCreate($payload = [])
//    {
//        return $this->onEdit(null, $payload);
//    }

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
