<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title" style="font-weight: bold; text-align: center;">Downlads Per Month</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <canvas id="lineChart"></canvas>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('lineChart').getContext('2d');
        var lineChartData = @json($lineChartData);
        var lineChart = new Chart(ctx, {
            type: 'line',
            data: lineChartData,
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
