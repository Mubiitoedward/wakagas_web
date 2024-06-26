<?php

?>






<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title" style="font-weight: bold; text-align: center;">Product Sales per Month</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <canvas id="barChart"></canvas>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('barChart').getContext('2d');
        var chartData = @json($chartData);
        var barChart = new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: {
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    });
</script>
