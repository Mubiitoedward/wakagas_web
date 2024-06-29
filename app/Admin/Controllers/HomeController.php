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
            DB::raw('DATE_FORMAT(date, "%Y-%m") as month'),
            'name',
            DB::raw('SUM(quantity) as total_quantity'),
            DB::raw('SUM(price) as total_sales')
        )
        ->groupBy('month', 'name')
        ->get();
        $cylinderSales = collect($cylinderSales);

        // Prepare data for the chart
        $chartData = [
            'labels' => [],
            'datasets' => []
        ];

        // Fetch total users per month
        $userCounts = User::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('month')
        ->get()
        ->keyBy('month');

        // Prepare data for the line chart
        $lineChartData = [
            'labels' => [],
            'datasets' => [
                [
                    'label' => 'Total Downloads',
                    'data' => [],
                    'borderColor' => '#3e95cd',
                    'fill' => false
                ]
            ]
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

        foreach ($months as $month => $monthName) {
            $lineChartData['labels'][] = $monthName;
            $lineChartData['datasets'][0]['data'][] = $userCounts->has($month) ? $userCounts[$month]->total : 0;
        }

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

        // Aggregate orders by area
        $ordersByArea = Orders::select(
            'address',
            DB::raw('COUNT(*) as total_orders')
        )
        ->groupBy('address')
        ->orderBy('total_orders', 'desc')
        ->get();

        // Prepare data for the area chart
        $areaChartData = [
            'labels' => $ordersByArea->pluck('address')->toArray(),
            'datasets' => [
                [
                    'label' => 'Total Orders by Area',
                    'data' => $ordersByArea->pluck('total_orders')->toArray(),
                    'backgroundColor' => 'rgba(75, 192, 192, 1)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 1
                ]
            ]
        ];

        // Aggregate orders by payment method
        $paymentMethods = Orders::select(
            'payment_method',
            DB::raw('COUNT(*) as total_orders')
        )
        ->groupBy('payment_method')
        ->get();

        // Prepare data for the pie chart
        $pieChartData = [
            'labels' => $paymentMethods->pluck('payment_method')->toArray(),
            'datasets' => [
                [
                    'data' => $paymentMethods->pluck('total_orders')->toArray(),
                    'backgroundColor' => ['#FF6384', '#36A2EB', '#FFCE56'],
                    'hoverBackgroundColor' => ['#FF6384', '#36A2EB', '#FFCE56']
                ]
            ]
        ];

        return $content
            ->title('Dashboard')
            ->description('Welcome to the dashboard')
            ->header('Waka Gas')
            ->row(function (Row $row) use ($totalUsers, $totalOrders, $totalCategories, $chartData, $lineChartData, $areaChartData, $pieChartData) {

                // First row for InfoBoxes
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


                // 2rd row for the first two charts
                $row->column(12, function (Column $column) use ($chartData, $lineChartData) {
                    $column->row(function (Row $row) use ($chartData, $lineChartData) {
                        $row->column(6, function (Column $column) use ($chartData) {
                            $column->append(view('admin.charts.bar_chart', compact('chartData')));
                        });
                        $row->column(6, function (Column $column) use ($lineChartData) {
                            $column->append(view('admin.charts.line_chart', compact('lineChartData')));
                        });
                    });
                });


                // 3rd row for the next two charts
                $row->column(12, function (Column $column) use ( $pieChartData) {
                    $column->row(function (Row $row) use ( $pieChartData) {
                        
                        $row->column(6, function (Column $column) use ($pieChartData) {
                            $column->append(view('admin.charts.pie_chart', compact('pieChartData')));
                        });

                        $row->column(6, function (Column $column) {
                            $column->append(view('admin.charts.calendar'));
                        });

                    });
                });
 
                // 4th row for the next two charts
                $row->column(12, function (Column $column) use ($areaChartData,) {
                    $column->row(function (Row $row) use ($areaChartData,) {
                        
                        $row->column(12, function (Column $column) use ($areaChartData) {
                            $column->append(view('admin.charts.area_chart', compact('areaChartData')));
                        });

                    });
                });
            });
    }
}
