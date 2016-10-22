<script type="text/javascript">
   
    $(document).ready(function(){
        
       $("#activity_log_btn").click(function(){
           $("#activity_log_btn").css({"border-top":"2px solid #216C2A", "border-bottom":"none", "background":"#f1f1f1", "border-right":"1px solid #ccc"});
           $("#order_btn").css({"border-top":"none", "border-left":"none", "background":"none", "border-bottom":"1px solid #ccc"});
       });
       $("#order_btn").click(function(){
           $("#order_btn").css({"border-top":"2px solid #216C2A", "border-bottom":"none", "background":"#f1f1f1", "border-right":"1px solid #ccc", "border-left":"1px solid #ccc"});
           $("#activity_log_btn").css({"border-top":"none", "border-left":"none", "background":"none", "border-bottom":"1px solid #ccc", "border-right":"none"});
       });
       
    });
    
    
</script>
<?php include "./apps/frontend/views/templates/dashboard_menu.php"; ?>
<div id="left_sidebar" class="sidebar_grid">
    <div id="activity" class="sidebar_cont">
      <h3 style="font-family:Arial;color:#f2f2f2;background:#4d4d4d;padding:5px 0px 5px 5px;">Activity</h3>
      <div id="activity_panel">
          <input type="button" value="Open Orders" id="order_btn"/>
          <!--<input type="button" value="Activity Log" id="activity_log_btn"/>-->
          <div style="clear:both;"></div>
          <div id="activity_tbl">
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
      </div>
    </div>
    
    <div id="calendar" class="sidebar_cont">
      <h3 style="font-family:Arial;color:#f2f2f2;background:#4d4d4d;padding:5px 0px 5px 5px;">Economic Calendar</h3>
      <hr/>
      <iframe src="http://ec.forexprostools.com/?ecoDayBackground=%23dedede&defaultFont=%233d3d3d&columns=exc_flags,exc_currency,exc_importance,exc_actual,exc_forecast,exc_previous&category=_employment,_economicActivity,_inflation,_credit,_centralBanks,_confidenceIndex,_balance,_Bonds&importance=1,2,3&features=datepicker,timezone,filters&countries=25,32,6,37,72,22,17,39,14,48,10,35,42,7,43,60,45,36,110,11,26,12,46,4,5&calType=day&timeZone=31&lang=1" style="width:100%;height:700px;border:none;padding:0px 0px 1px 12px;border:1px solid #eaeaea;" id="cal_if">
      </iframe>
    </div>
</div>
<!--end left_sidebar-->
<div id="right_sidebar" class="sidebar_grid">
<?php include "./apps/frontend/views/templates/dashboard_main_sidebar.php"; ?>
</div>
<!--end rightsidebar-->
<div style="clear:both;"></div>