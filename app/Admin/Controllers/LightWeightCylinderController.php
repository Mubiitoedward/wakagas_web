<?php

namespace App\Admin\Controllers;

use App\Models\LightWeightCylinder;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\GasCategory;

class LightWeightCylinderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Cylinder Registration';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new LightWeightCylinder());
        $grid->disableBatchActions();

        $grid->column('id', __('Id'))->hide();
        $grid->column('image_url', __('Image url light'))->lightbox(['zooming' => true,
        'width' => 50, 'height' => 80,
        'class' => ['circle', ''],]);
        $grid->column('product_name', __('Product name'))
        ->sortable();
        $grid->column('capacity', __('Capacity'))
        ->display(function($capacity){
            return number_format($capacity).''.$this->measuring_units;
        })->sortable();
        $grid->column('stock_quantity', __('Number In Stock'))
        ->sortable()
        ->editable();
        $grid->column('refill_price', __('Refill price(UGX)'))
        ->display(function($refill_price){
            return number_format($refill_price);
              })
        ->sortable()
        ->editable();
        $grid->column('initial_purchase_price', __('Initial purchase price(UGX)'))
        ->display(function($initial_purchase_price){
            return number_format($initial_purchase_price);

        })->sortable();
       
        $grid->column('created_by', __('Created by'))
        ->hide();
       
        $grid->column('updated_by', __('Updated by'))
        ->hide();
        $grid->column('created_at', __('Created at'))
        ->display(function($created_at){
            return date('d-m-Y',strtotime($created_at));
        })->sortable();
       

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
        $show = new Show(LightWeightCylinder::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('product_name', __('Product name'));
        $show->field('capacity', __('Capacity'));
        $show->field('measurig_units', __('Measuring Units'));
        $show->field('stock_quantity', __('Stock quantity'));
        $show->field('refill_price', __('Refill price'));
        $show->field('initial_purchase_price', __('Initial purchase price'));
        $show->field('image_url', __('Image url light'));
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
        $form = new Form(new LightWeightCylinder());

        $form->select('product_name', __('Gas Category'))
        ->placeholder('Please select the gas cylinder label')
        ->rules('required')
        ->options(GasCategory::pluck('name', 'name'));
        $form->decimal('capacity', __('Capacity'))
        ->rules('required');
        $form->text('measuring_units', __('Measuring Units'))
        ->rules('required');
        $form->decimal('stock_quantity', __('Number In Stock'))
        ->rules('required');
        $form->decimal('refill_price', __('Refill price(UGX)'))
        ->rules('required');
        $form->decimal('initial_purchase_price', __('Initial purchase price(UGX)'))
        ->rules('required');
        $form->image('image_url', __('Image url'))
        ->uniqueName()
        ->rules('required');
        $form->text('created_by', __('Created by'))
        ->required();
        $form->text('updated_by', __('Updated by'));

        $form->footer(function ($footer) {

            // disable reset btn
            $footer->disableReset();
        
           
        
            // disable `View` checkbox
            $footer->disableViewCheck();
        
            // disable `Continue editing` checkbox
            $footer->disableEditingCheck();
        
            // disable `Continue Creating` checkbox
            $footer->disableCreatingCheck();
        
        });

        return $form;
    }
}
