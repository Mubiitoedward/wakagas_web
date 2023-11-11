<?php

namespace App\Admin\Controllers;

use App\Models\GasCategory;
use App\Models\Product;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Product';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product());

        // $grid->column('id', __('Id'));
        $grid->column('product_name', __('Cylinder label'));
        $grid->column('capacity', __('Capacity(kg)'));
        $grid->column('price', __('Price'));
        $grid->column('stock_quantity', __('Quantity in stock'));
        $grid->column('image_url', __('Image Path'))->image();
        $grid->column('created_by', __('Updated by'));
        $grid->column('updated_by', __('Updated by'));

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
        $show = new Show(Product::findOrFail($id));

        
        // $show->field('id', __('Id'));
        $show->field('product_name', __('Cylinder label'));
        $show->field('capacity', __('Capacity(kg)'));
        $show->field('price', __('Price'));
        $show->field('stock_quantity', __('Quantity in stock'));
        $show->field('image_url', __('Image Path'))->image();
        $show->field('created_by', __('Updated by'));
        $show->field('updated_by', __('Updated by'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Product());

        $form->select('product_name', __('Gas Category'))->placeholder('Please select the gas cylinder label')->rules('required')
            ->options(GasCategory::pluck('name', 'name'));
        $form->number('capacity', __('Cylinder capacity (kg)'))->rules('required');
        $form->number('price', __('Price'))->rules('required');
        $form->number('stock_quantity', __('Quantity in stock'))->rules('required');
        $form->image('image_url', __('Attach the cylinder image'))->removable()->rules('required');
        return $form;
    }
}
