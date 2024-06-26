<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title" style="font-weight: bold; text-align: center;">Payment Methods Distribution</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <canvas id="pieChart"></canvas>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('pieChart').getContext('2d');
        var pieChartData = @json($pieChartData);
        var pieChart = new Chart(ctx, {
            type: 'pie',
            data: pieChartData
        });
    });
</script>
