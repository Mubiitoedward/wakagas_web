<?php

namespace App\Admin\Controllers;

use App\Models\User;
use App\Models\Order_details;
use App\Models\Orders;

use App\Models\GasCategory;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\InfoBox;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        $totalUsers = User::count();
        $totalOrders = Order_details::count();
        $totalCategories = GasCategory::count();

        // Fetch data for the bar chart
        $cylinderSales = Order_details::select(
            DB::raw('MONTH(date) as month'),
            'orderid',
            DB::raw('SUM(quantity) as total_quantity')
        )
        ->groupBy('month', 'orderid')
        ->get();
        $cylinderSales = collect($cylinderSales);


        // Prepare data for the chart
        $chartData = [
            'labels' => [],
            'datasets' => []
        ];

        $categories = Order_details::select('name')->distinct()->get();
        $months = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December'
        ];

        foreach ($categories as $category) {
            $dataset = [
                'label' => $category->name,
                'data' => [],
                'backgroundColor' => sprintf('#%06X', mt_rand(0, 0xFFFFFF)),
                'borderColor' => sprintf('#%06X', mt_rand(0, 0xFFFFFF)),
                'borderWidth' => 2
            ];

            foreach ($months as $month => $monthName) {
                $sale = $cylinderSales->first(function($item) use ($month, $category) {
                    return $item->month == $month && $item->name == $category->name;
                });
                $dataset['data'][] = $sale ? $sale->total_quantity : 0;
            }

            $chartData['datasets'][] = $dataset;
        }

        $chartData['labels'] = array_values($months);

        return $content
            ->title('Dashboard')
            ->description('Welcome to the dashboard')
            ->header('Waka Gas')
            ->row(function (Row $row) use ($totalUsers, $totalOrders, $totalCategories, $chartData) {

                // First row for InfoBoxes and Box
                $row->column(12, function (Column $column) use ($totalUsers, $totalOrders, $totalCategories) {
                    $column->row(function (Row $row) use ($totalUsers, $totalOrders, $totalCategories) {
                        $row->column(4, function (Column $column) use ($totalUsers) {
                            $infoBox = new InfoBox('Total Downloads', 'download', 'red', '/users', $totalUsers);
                            $infoBox->removable();
                            $infoBox->collapsable();
                            $infoBox->style('danger');
                            $infoBox->solid();
                            $column->append($infoBox);
                        });

                        $row->column(4, function (Column $column) use ($totalOrders) {
                            $infoBox = new InfoBox('Total Orders', 'shopping-cart', 'yellow', '/orders', $totalOrders);
                            $infoBox->removable();
                            $infoBox->collapsable();
                            $infoBox->style('warning');
                            $infoBox->solid();
                            $column->append($infoBox);
                        });

                        $row->column(4, function (Column $column) use ($totalCategories) {
                            $infoBox = new InfoBox('Total Categories', 'tags', 'green', '/gas-categories', $totalCategories);
                            $infoBox->removable();
                            $infoBox->collapsable();
                            $infoBox->style('primary');
                            $infoBox->solid();
                            $column->append($infoBox);
                        });
                    });
                });

                // Second row for charts
                $row->column(12, function (Column $column) use ($chartData) {
                    $column->row(function (Row $row) use ($chartData) {
                        $row->column(12, function (Column $column) use ($chartData) {
                            $column->append(view('admin.charts.bar_chart', compact('chartData')));
                        });
                    });
                });
            });
    }
}
