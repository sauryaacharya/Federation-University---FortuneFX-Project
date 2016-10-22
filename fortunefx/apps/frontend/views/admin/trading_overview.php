<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart', 'bar']});
      google.charts.setOnLoadCallback(drawUnitTrdChart);
      google.charts.setOnLoadCallback(drawCustTrdChart);
      
      function drawUnitTrdChart() {
        var data = google.visualization.arrayToDataTable(<?php echo $unit_trd; ?>);

        var options = {
          chart: {
            title: 'Top Most Traded Currency',
            subtitle: 'By Units'
          }
        };

        var chart = new google.charts.Bar(document.getElementById('chart_unit_trd'));

        chart.draw(data, options);
      }
      
      function drawCustTrdChart() {
        var data = google.visualization.arrayToDataTable(<?php echo $cust_trd; ?>);

        var options = {
          chart: {
            title: 'Top Most Traded Currency',
            subtitle: 'By Units'
          }
        };

        var chart = new google.charts.Bar(document.getElementById('chart_by_cust_trd'));

        chart.draw(data, options);
      }
</script>
<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawCurveTypes);

function drawCurveTypes() {
      var data = google.visualization.arrayToDataTable(<?php echo $trade_trans; ?>);
      var options = {
        hAxis: {
          title: 'Date'
        },
        vAxis: {
          title: 'Units'
        },
        series: {
          1: {curveType: 'function'}
        }
      };

      var chart3 = new google.visualization.LineChart(document.getElementById('trans_chart'));
      chart3.draw(data, options);
    }
    </script>
<div id="main_dashboard" class="dash_grid">
    <span style="font-family:Arial;font-size:15px;color:#444;"><strong>Total Number Of Visitors:</strong> <span id="tot_visit"></span></span>
    <br/><br/>
    <h2 style="font-family:Arial;color:#333333;text-shadow: 1px 1px 2px #ddd;">Trading Analytics Overview</h2>
<hr/>
<br/>
<span style="font-family:Arial;color:#444;font-size:14px;font-weight:bold;">Top 5 Traded Currency Pair By Units</span>
<div id="chart_unit_trd" style="width:100%;height:300px;border:1px solid #eaeaea;margin-top:5px;padding:5px;">
</div>
<br/>
<span style="font-family:Arial;color:#444;font-size:14px;font-weight:bold;">Top 5 Actively Trading Customer</span>
<div id="chart_by_cust_trd" style="width:100%;height:300px;border:1px solid #eaeaea;margin-top:5px;padding:5px;">
</div>
<br/>
<span style="font-family:Arial;color:#444;font-size:14px;font-weight:bold;">Order Transactions Trend</span>
<div id="trans_chart" style="width:100%;height:400px;border:1px solid #eaeaea;margin-top:5px;padding:5px;">
</div>
</div>
<div style="clear:both;"></div>