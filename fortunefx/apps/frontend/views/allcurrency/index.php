<script type="text/javascript" src="http://<?php echo ROOT_URL; ?>apps/frontend/public/js/all_rate.js"></script>
<div id="left_sidebar" class="sidebar_grid">
    <div id="live_fx_rate" class="sidebar_cont">
      <h3 style="font-family:Arial;color:#f2f2f2;background:#4d4d4d;padding:5px 0px 5px 5px;">All Currency Pair Live FX Rate</h3>
      <hr/>
    <table id="all_live_rate_table" class="cust_all_live_rate" cellspacing="0" width="100%">
            <thead>
                      <tr>
                          <th>Pair</th>
                          <th>Buy</th>
                          <th>Sell</th>
                          <th>Spread</th>
                          <th>Chart</th>
                      </tr>
                  </thead>
        </table>
    </div>
    
</div>
<?php
include "./apps/frontend/views/templates/main_sidebar.php";
?>
<div style="clear:both;"></div>