<?php

use Encore\Admin\Facades\Admin;
use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('users', UserController::class);
    $router->resource('gas-categories', GasCategoryController::class);
    $router->resource('light-weight-cylinders', LightWeightCylinderController::class);
    $router->resource('heavy-wight-cylinders', HeavyWeightCylindersController::class);
    $router->resource('orders', OrdersController::class);
    $router->resource('order_details', Order_detailsController::class);
    $router->resource('accessories', AccessoriesController::class); 

});
