<?php

namespace App\Admin\Controllers;

use App\Models\Orders;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OrdersController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Orders';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Orders());

        $grid->column('orderid', __('Orderid'));
        $grid->column('userid', __('Userid'));
        $grid->column('deliveryday', __('Deliveryday'));
        $grid->column('deliverytime', __('Deliverytime'));
        $grid->column('payment_method', __('Payment method'));
        $grid->column('address', __('Address'));
        $grid->column('status', __('Status'));
        $grid->column('date', __('Date'));
        $grid->column('totalprice', __('Totalprice'));

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
        $show = new Show(Orders::findOrFail($id));

        $show->field('orderid', __('Orderid'));
        $show->field('userid', __('Userid'));
        $show->field('deliveryday', __('Deliveryday'));
        $show->field('deliverytime', __('Deliverytime'));
        $show->field('payment_method', __('Payment method'));
        $show->field('address', __('Address'));
        $show->field('status', __('Status'));
        $show->field('date', __('Date'));
        $show->field('totalprice', __('Totalprice'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Orders());

        $form->number('orderid', __('Orderid'));
        $form->number('userid', __('Userid'));
        $form->text('deliveryday', __('Deliveryday'));
        $form->text('deliverytime', __('Deliverytime'));
        $form->text('payment_method', __('Payment method'));
        $form->text('address', __('Address'));
        $form->text('status', __('Status'));
        $form->text('date', __('Date'));
        $form->text('totalprice', __('Totalprice'));

        return $form;
    }
}
