<?php

namespace App\Admin\Controllers;

use App\Models\HeavyWeightCylinders;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\GasCategory;

class HeavyWeightCylindersController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'HeavyWeightCylinders';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new HeavyWeightCylinders());

        $grid->column('id', __('Id'));
        $grid->column('product_name', __('Product name'));
        $grid->column('capacity', __('Capacity'));
        $grid->column('stock_quantity', __('Stock quantity'));
        $grid->column('refill_price', __('Refill price'));
        $grid->column('initial_purchase_price', __('Initial purchase price'));
        $grid->column('image_url_heavy', __('Image url heavy'));
        $grid->column('created_by', __('Created by'));
        $grid->column('updated_by', __('Updated by'));
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
        $show = new Show(HeavyWeightCylinders::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('product_name', __('Product name'));
        $show->field('capacity', __('Capacity'));
        $show->field('stock_quantity', __('Stock quantity'));
        $show->field('refill_price', __('Refill price'));
        $show->field('initial_purchase_price', __('Initial purchase price'));
        $show->field('image_url_heavy', __('Image url heavy'));
        $show->field('created_by', __('Created by'));
        $show->field('updated_by', __('Updated by'));
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
        $form = new Form(new HeavyWeightCylinders());

        $form->select('product_name', __('Gas Category'))->placeholder('Please select the gas cylinder label')->rules('required')
        ->options(GasCategory::pluck('name', 'name'))
        ->rules('required');
        $form->decimal ('capacity', __('Capacity'))
        ->rules('required');
        $form->number('stock_quantity', __('Stock quantity'))
        ->rules('required');
        $form->number('refill_price', __('Refill price'))
        ->rules('required');
        $form->number('initial_purchase_price', __('Initial purchase price'))
        ->rules('required');
        $form->image('image_url', __('Image url heavy'))
        ->image()
        ->rules('required');
        $form->text('created_by', __('Created by'));
        $form->text('updated_by', __('Updated by'));

        return $form;
    }
}
