<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArrearsItemRequest;
use App\Models\ArrearsMaster;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ArrearsItemCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ArrearsItemCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\ArrearsItem::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/arrears-item');
        CRUD::setEntityNameStrings('arrears item', 'arrears items');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('name');
        CRUD::column('arrears_master_id');
        CRUD::column('arrears_master_name');
        CRUD::column('created_at');
        CRUD::column('updated_at');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ArrearsItemRequest::class);

        CRUD::field('name');
//        CRUD::field('arrears_master_id')->type('select_from_array')
//        ->options($this->getAllArrearsMaster());

        CRUD::addField([
           "label" => "Arrears Master",
            'type'      => 'select_from_array',
            'name'      => 'arrears_master_id', // the db column for the foreign key
            'model'     => "App\Models\ArrearsMaster", // related model
            'attribute' => 'name', // foreign key attribute that is shown to user
//            'options'   => (function ($query) {
//                return $query->get();
//            }), //  you can use this to filter the results show in the select
            'options' => $this->getAllArrearsMaster()
        ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    private function getAllArrearsMaster()
    {
        $arrearsMasters = ArrearsMaster::all();
        $arrearsName = array();
        foreach($arrearsMasters as $index => $value) {
            $arrearsName[$value->id] = $value->name;
        }
        return $arrearsName;
    }

    private function getAllArrearsMasterOneColumn()
    {
        return ArrearsMaster::all()->pluck('name')->toArray();
//        $arrearsMasters = ArrearsMaster::all();
//        $arrearsName = array();
//        foreach($arrearsMasters as $index => $value) {
//            $arrearsName[$index] = $value->name;
//        }
//        return $arrearsName;
    }
}
