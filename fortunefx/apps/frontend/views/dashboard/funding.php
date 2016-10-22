<script src="http://<?php echo ROOT_URL; ?>apps/frontend/public/js/validation.js" type="text/javascript"></script>
   <?php include "./apps/frontend/views/templates/dashboard_menu.php"; ?>
<div id="left_sidebar" class="sidebar_grid">
    <div id="funding" class="sidebar_cont">
      <h3 style="font-family:Arial;color:#f2f2f2;background:#4d4d4d;padding:5px 0px 5px 5px;">Fund My Account</h3>
      <div id="funding_panel">
          <h4 style="font-family:Arial;color:#666;">My Card Details</h4>
          <div style="border-top:1px solid #dadada;margin-top:5px;margin-bottom:5px;"></div>
          <?php foreach($card_detail as $detail): ?>
          <div style="float:right;padding:5px;">
              <a href="" id="close_btn" style="display:none;"><i class="fa fa-times" aria-hidden="true"></i>Cancel</a>
              <a href="" id="card_edit_btn"><i class="fa fa-pencil fa-fw"></i>Edit Card</a>
          </div>
          <div class="card_panel">
                <table>
              <tr><td><strong>Card Type: </strong></td><td><i class="fa fa-cc-<?php echo htmlentities($detail['card_type']);?> fa-2x" aria-hidden="true"></i></td></tr>
              <tr><td><strong>Card Holder Name: </strong></td><td><?php echo htmlentities($detail["card_holder_name"]); ?></td></tr>
              <tr><td><strong>Card Number: </strong></td><td><?php echo htmlentities($detail["card_number"]);?></td></tr>
              <tr><td><strong>CVV: </strong></td><td><?php echo htmlentities($detail["ccv"]);?></td></tr>
              <tr><td><strong>Expiry: </strong></td><td><?php echo htmlentities($detail["expiry"]);?></td></tr>
          </table>
          </div>
          <div style="border-top:1px solid #dadada;margin-top:5px;margin-bottom:5px;"></div>
          <?php endforeach; ?>
          <br/>
          <h4 style="font-family:Arial;color:#666;">Pay With Paypal</h4>
          <div style="border-top:1px solid #dadada;margin-top:5px;margin-bottom:5px;"></div>
          <i class="fa fa-cc-paypal fa-2x" aria-hidden="true"></i>
          <i class="fa fa-cc-mastercard fa-2x" aria-hidden="true"></i>
          <i class="fa fa-cc-visa fa-2x" aria-hidden="true"></i>
          <i class="fa fa-cc-amex fa-2x" aria-hidden="true"></i>
          <i class="fa fa-cc-discover fa-2x" aria-hidden="true"></i>
          <div style="margin-top:10px;" class="form_panel">
          <input type="text" placeholder="Amount" id="fund_amt" name="fund_amt"/>
          <input type="button" value="Deposit Fund" id="fund_btn" name="fund_btn"/>
          <div id="fund_error_msg"></div>
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