<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.charts.load('upcoming', {'packages':['geochart']});
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {

        var data = google.visualization.arrayToDataTable(<?php echo $user_dens; ?>);

        var options = {};

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
      }
    </script>
<script type="text/javascript">
    var table;
    
    function block(user_id, event)
    {
        event.preventDefault();
        $.ajax({
            url: "/fortunefx/ajaxservice/blockuser",
            type: "POST", 
            data: {user_id : user_id},
            beforeSend: function(){
                $("#cls_spin"+user_id).css("visiblity", "visible");
            },
            success: function(data){
                $("#cls_spin"+user_id).css("visibility", "hidden");
                table.ajax.reload();
            }
            
        });
    }
    
    function unblock(user_id, event)
    {
        event.preventDefault();
        $.ajax({
            url: "/fortunefx/ajaxservice/unblockuser",
            type: "POST", 
            data: {user_id : user_id},
            beforeSend: function(){
                $("#cls_spin"+user_id).css("visiblity", "visible");
            },
            success: function(data){
                $("#cls_spin"+user_id).css("visibility", "hidden");
                table.ajax.reload();
            }
            
        });
    }
    
    $(document).ready(function(){
        
       
       table = $("#cust_list").DataTable({
           "order": [[ 0, "desc" ]],
           
           "columnDefs": [ {
                          "targets": 9,
                          "data": null,
                          "render": function ( data, type, full, meta ) {
                          var button = "";
                          if(data.status == "Active"){
                              button = "<a href='' class='cust_action' style='color:#cc0000;' onclick='block("+data.user_id+", event)'>Block</a>";
                          }
                          else{
                              button = "<a href='' class='cust_action' style='color:#216C2A;' onclick='unblock("+data.user_id+", event)'>Unblock</a>";
                          }
                          return "<i class='fa fa-spinner fa-spin fa-fw' aria-hidden='true' id='cls_spin"+data.user_id+"' style='visibility:hidden;'></i>" + button;
                          }
                      } ],
           "ajax":{
            "url" : "/fortunefx/ajaxservice/customers",
            "dataSrc" : "users",
            "cache" : true
        },
        "language": {
             "loadingRecords": "<span style='color:#000;'><i class='fa fa-spinner fa-spin fa-3x fa-fw' aria-hidden='true'></i> <br/>Loading</span>"
            },
        "columns" : [
            {"data" : "user_id"}, 
            {"data" : "name"},
            {"data" : "dob"},
            {"data" : "phone"},
            {"data" : "country"},
            {"data" : "address"},
            {"data" : "email"},
            {"data" : "created"},
            {"data" : "status"}
        ]
       });
    });
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
    <h2 style="font-family:Arial;color:#333333;text-shadow: 1px 1px 2px #ddd;">Customer Of Fortune FX</h2>
<hr/>
<table id="cust_list" class="cust" cellspacing="0" width="100%">
    <thead style="border-bottom:none;">
                      <tr>
                          <th>Id</th>
                          <th>Name</th>
                          <th>DOB</th>
                          <th>Phone</th>
                          <th>Country</th>
                          <th>Address</th>
                          <th>Email</th>
                          <th>Created</th>
                          <th>Status</th>
                         <th>Action</th>
                      </tr>
                  </thead>
                  <tfoot>
            <tr>
                          <th>Id</th>
                          <th>Name</th>
                          <th>DOB</th>
                          <th>Phone</th>
                          <th>Country</th>
                          <th>Address</th>
                          <th>Email</th>
                          <th>Created</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
        </tfoot>
</table>
<br/><br/>
<span style="font-family:Arial;color:#444;font-size:14px;font-weight:bold;">Customer Density By Country</span>
<div id="regions_div" style="width: 100%; height: 500px; border:1px solid #eaeaea;padding:5px;"></div>
</div>
<div style="clear:both;"></div>