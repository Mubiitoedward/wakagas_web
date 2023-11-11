<?php

namespace App\Admin\Controllers;

use App\Models\GasCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class GasCategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Cylinder Company (Please add all your gas cylinder companies here';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new GasCategory());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('created_by', __('Created By'));
        $grid->column('updated_by', __('Updated By'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(GasCategory::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Company Name'));
        $show->field('created_by', __('Created By'));
        $show->field('updated_by', __('Updated By'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new GasCategory());

        $form->text('name', __('Cylinder Company'))->required();
        // Set the value of the created_by field before creating a new record
       

        $form->text('updated_by', __('Updated By'))->default(auth()->user()->name)->readonly();


        return $form;
    }
}
