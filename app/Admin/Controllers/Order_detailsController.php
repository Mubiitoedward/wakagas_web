<?php

namespace App\Admin\Controllers;

use App\Models\Order_details;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class Order_detailsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Order_details';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order_details());

        $grid->disableBatchActions();
        $grid->disableCreateButton();
        $grid->quickSearch('Name','type','price','userid');


        $grid->column('orderid', __('Orderid'))->hide();
        $grid->column('userid', __('Userid'));
        $grid->column('name', __('Name'))->sortable();
        $grid->column('quantity', __('Quantity'))->sortable();
        $grid->column('type', __('Type'))->sortable();
        $grid->column('price', __('Price'))->sortable();

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
        $show = new Show(Order_details::findOrFail($id));

        $show->field('orderid', __('Orderid'));
        $show->field('userid', __('Userid'));
        $show->field('name', __('Name'));
        $show->field('quantity', __('Quantity'));
        $show->field('type', __('Type'));
        $show->field('price', __('Price'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Order_details());

        $form->number('orderid', __('Orderid'));
        $form->number('userid', __('Userid'));
        $form->text('name', __('Name'));
        $form->text('quantity', __('Quantity'));
        $form->text('type', __('Type'));
        $form->text('price', __('Price'));

        return $form;
    }
}
