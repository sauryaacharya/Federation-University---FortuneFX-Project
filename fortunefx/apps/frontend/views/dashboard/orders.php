<script type="text/javascript">
    
$(document).ready(function() {
        
    $('#order_trans_table').DataTable({
        
        "order": [[ 0, "desc" ]],
        "columnDefs": [ {
                          "targets": 6,
                          "data": "pl",
                          "render": function ( data, type, full, meta ) {
                              var color;
                              var value = data.substr(1);
                              if(value >= 0)
                              {
                                  color = "color:#008000;";
                              }
                              else
                              {
                                  color = "color:#cc0000;";
                              }
                          return '<span style="'+color+';font-weight:bold;">'+data+'</span>';
                          }
                      } ],
        "ajax":{
            "url" : "/fortunefx/ajaxservice/closedorders",
            "dataSrc" : "close_orders"
        },
        "language": {
             "loadingRecords": "<span style='color:#000;'><i class='fa fa-spinner fa-spin fa-3x fa-fw' aria-hidden='true'></i> <br/>Loading</span>"
            },
        
        "columns" : [
            {"data" : "date"}, 
            {"data" : "product"},
            {"data" : "description"},
            {"data" : "order_desc"},
            {"data" : "amount"}, 
            {"data" : "deal_rate"}, 
            {"data" : "pl"}
        ]
    });
} );

</script>
<style type="text/css">
    
    table.dep_tbl, table.order_tbl
    {
        width:100%;
        border-collapse:collapse;
        text-align:left;
    }
    table.dep_tbl thead, table.order_tbl thead
    {
        font-family:Arial;
        font-weight:bold;
        font-size:13px;
    }
    
    table.dep_tbl thead th, table.order_tbl thead th
    {
        border-bottom:1px solid #ccc;
    }
    
    table.dep_tbl tfoot, table.order_tbl tfoot
    {
        font-family:Arial;
        font-weight:bold;
        font-size:13px;
    }
    
    table.dep_tbl tfoot th, table.order_tbl tfoot th
    {
        border-top:1px solid #ccc;
    }
    
    table.dep_tbl tbody tr, table.order_tbl tbody tr
    {
        font-family:Arial;
        font-size:12px;
        color:#555;
        border-bottom:1px solid #efefef;
    }
    
    table.dep_tbl tbody tr:last-child, table.order_tbl tbody tr:last-child
    {
        border-bottom:none;
    }
    
     table.dep_tbl tbody tr:nth-child(even), table.order_tbl tbody tr:nth-child(even)
    {
        background:#fbfbfb;
    }
</style>
    <?php include "./apps/frontend/views/templates/dashboard_menu.php"; ?>
<div id="left_sidebar" class="sidebar_grid">
    <div id="trans_detail" class="sidebar_cont">
      <h3 style="font-family:Arial;color:#f2f2f2;background:#4d4d4d;padding:5px 0px 5px 5px;">My Orders</h3>
      <div id="trans_detail_panel">
          <h4 style="font-family:Arial;color:#222;">Open Orders</h4>
          <div style="border-top:1px solid #a6a6a6;margin-top:5px;margin-bottom:5px;"></div>
          
          
          <div class="trans_panel" id="dep_panel">
              <table id="open_order_table" class="open_table" cellspacing="0" width="100%">
                  <thead style="border-bottom:none;">
                      <tr>
                          <th>Product</th>
                          <th>Size</th>
                          <th>Buy/Sell</th>
                          <th>Deal Rate</th>
                          <th>Live Rate</th>
                          <th>Unrealized P/L</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tfoot>
            <tr>
                <th>Product</th>
                <th>Size</th>
                <th>Buy/Sell</th>
                <th>Deal Rate</th>
                <th>Live Rate</th>
                <th>Unrealized P/L</th>
                <th>Action</th>
            </tr>
        </tfoot>
              </table>
          </div>
          
          <br/>
          <h4 style="font-family:Arial;color:#222;">Closed Orders</h4>
          <div style="border-top:1px solid #a6a6a6;margin-top:5px;margin-bottom:5px;"></div>
          
          
          <div class="trans_panel" id="order_panel">
              <table id="order_trans_table" class="order_tbl" cellspacing="0" width="100%">
                  <thead style="border-bottom:none;">
                      <tr>
                          <th>Date</th>
                          <th>Product</th>
                          <th>Buy/Sell</th>
                          <th>Description</th>
                          <th>Size</th>
                          <th>Deal Rate</th>
                          <th>Realized Gain/Loss</th>
                      </tr>
                  </thead>
                  <tfoot>
            <tr>
                          <th>Date</th>
                          <th>Product</th>
                          <th>Buy/Sell</th>
                          <th>Description</th>
                          <th>Size</th>
                          <th>Deal Rate</th>
                          <th>Realized Gain/Loss</th>
            </tr>
        </tfoot>
              </table>
          </div>
          
          
          
          
          
      </div>
    </div>
</div>
<!--end left_sidebar-->
<div id="right_sidebar" class="sidebar_grid">
<?php include "./apps/frontend/views/templates/dashboard_main_sidebar.php"; ?>
</div>
<!--end rightsidebar-->
<div style="clear:both;"></div>