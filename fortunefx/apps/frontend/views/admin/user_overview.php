<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawBrChart);
      function drawBrChart() {

        var data = google.visualization.arrayToDataTable(<?php echo $arr; ?>);

        var options = {
          title: 'User Usage By Browser'
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_by_browser'));

        chart.draw(data, options);
      }
</script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawBrChart);
      function drawBrChart() {

        var data = google.visualization.arrayToDataTable(<?php echo $arr_plt; ?>);

        var options = {
          title: 'User Usage By Platform'
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_by_plt'));

        chart.draw(data, options);
      }
</script>
<style type="text/css">
table.cust, table.order_tbl
    {
        width:100%;
        border-collapse:collapse;
        text-align:left;
    }
    table.cust thead, table.order_tbl thead
    {
        font-family:Arial;
        font-weight:bold;
        font-size:13px;
    }
    
    table.cust thead th, table.order_tbl thead th
    {
        border-bottom:1px solid #ccc;
    }
    
    table.cust tfoot, table.order_tbl tfoot
    {
        font-family:Arial;
        font-weight:bold;
        font-size:13px;
    }
    
    table.cust tfoot th, table.order_tbl tfoot th
    {
        border-top:1px solid #ccc;
    }
    
    table.cust tbody tr, table.order_tbl tbody tr
    {
        font-family:Arial;
        font-size:12px;
        color:#555;
        border-bottom:1px solid #efefef;
    }
    
    table.cust tbody tr:last-child, table.order_tbl tbody tr:last-child
    {
        border-bottom:none;
    }
    
     table.cust tbody tr:nth-child(even), table.order_tbl tbody tr:nth-child(even)
    {
        background:#fbfbfb;
    }
</style>
<div id="main_dashboard" class="dash_grid">
    <span style="font-family:Arial;font-size:15px;color:#444;"><strong>Total Number Of Visitors:</strong> <span id="tot_visit"></span></span>
    <br/><br/>
    <h2 style="font-family:Arial;color:#333333;text-shadow: 1px 1px 2px #ddd;">Audience Overview</h2>
<hr/>
<br/>
<span style="font-family:Arial;color:#444;font-size:14px;font-weight:bold;">User Usage By Browser</span>
<div id="chart_by_browser" style="width:100%;height:300px;border:1px solid #eaeaea;margin-top:5px;">
</div>
<br/>
<span style="font-family:Arial;color:#444;font-size:14px;font-weight:bold;">User Usage By Platform</span>
<div id="chart_by_plt" style="width:100%;height:300px;border:1px solid #eaeaea;margin-top:5px;">
</div>
</div>
<div style="clear:both;"></div>