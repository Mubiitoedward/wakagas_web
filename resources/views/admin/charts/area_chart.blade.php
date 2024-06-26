<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title" style="font-weight: bold; text-align: center;">Total Orders by Address</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <canvas id="areaChart"></canvas>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('areaChart').getContext('2d');
        var areaChartData = @json($areaChartData);
        var areaChart = new Chart(ctx, {
            type: 'line',
            data: areaChartData,
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
                },
                elements: {
                    line: {
                        fill: true
                    }
                }
            }
        });
    });
</script>
