<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<!-- START: daily total visit chart -->
<div class="chart-title">Daily Total Visits</div>
<div id="chart_daily" class="chart"></div>
<!-- END: daily total visit chart -->


<!-- START: most visited unit chart -->
<div class="chart-title">Most Visited Unit (14 days)</div>
<div id="chart_most_visited" class="chart"></div>
<!-- END: most visited unit chart -->

<script>
        google.charts.load('current', {packages: ['corechart', 'line']});
        google.charts.setOnLoadCallback(chartDaily);
        function chartDaily()
        {

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Date');
            data.addColumn('number', 'No. of Visit');
            data.addRows([
<?php for ($i = -14; $i <= 0; $i++): ?>
        <?php $dateCode = date('Y-m-d', mktime(0, 0, 0, date('n') + 0, date('d') + $i, date('Y') + 0)); ?>
                        ["<?php echo substr($dateCode, -5); ?>", <?php echo isset($visitByDay[$dateCode]) ? $visitByDay[$dateCode] : 0; ?>],
    <?php endfor; ?>
            ]);
            var options = {
                chart: {
                    title: 'Daily Total Visits'
                },
                hAxis: {
                    title: 'Date'
                },
                vAxis: {
                    title: 'Visit'
                }
            };
            var chart = new google.visualization.LineChart(document.getElementById('chart_daily'));
            chart.draw(data, options);
        }


        google.charts.load('current', {packages: ['corechart', 'line']});
        google.charts.setOnLoadCallback(chartMostVisited);
        function chartMostVisited()
        {

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Date');
            data.addColumn('number', 'No. of Visit');
            data.addRows([
<?php foreach ($mostVisitedUnit as $unit): ?>
        <?php $unitTitle = $unit['block'] . '-' . $unit['unit_number']; ?>
                        ["<?php echo $unitTitle; ?>", <?php echo isset($unit['count']) ? $unit['count'] : 0; ?>],
    <?php endforeach; ?>
            ]);
            var options = {
                chart: {
                    title: 'Daily Total Visits'
                },
                hAxis: {
                    title: 'Unit'
                },
                vAxis: {
                    title: 'Visit'
                }
            };
            var chart = new google.visualization.ColumnChart(document.getElementById('chart_most_visited'));
            chart.draw(data, options);
        }


</script>