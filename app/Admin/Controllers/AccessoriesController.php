<?php

namespace App\Admin\Controllers;

use App\Models\Accessories;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AccessoriesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Accessories';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Accessories());
        $grid-> disableBatchActions();

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('image', __('Image'))->lightbox(['zooming' => true,
        'width' => 50, 'height' => 80,
        'class' => ['circle', ''],]);
        $grid->column('price', __('Price'))
        ->display(function($price){
            return number_format($price);
              })
        ->sortable()
        ->editable();;

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
        $show = new Show(Accessories::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('image', __('Image'));
        $show->field('price', __('Price'));
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
        $form = new Form(new Accessories());

        $form->text('name', __('Name'));
        $form->image('image', __('Image url'));
        $form->number('price', __('Price'));
        

        return $form;
    }
}
