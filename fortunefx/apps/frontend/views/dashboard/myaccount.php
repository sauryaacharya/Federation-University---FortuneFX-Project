<script src="http://<?php echo ROOT_URL; ?>apps/frontend/public/js/validation.js" type="text/javascript"></script>
    <?php include "./apps/frontend/views/templates/dashboard_menu.php"; ?>
<div id="left_sidebar" class="sidebar_grid">
    <div id="user_detail" class="sidebar_cont">
      <h3 style="font-family:Arial;color:#f2f2f2;background:#4d4d4d;padding:5px 0px 5px 5px;">My Account Details</h3>
      <div id="user_detail_panel">
          <h4 style="font-family:Arial;color:#222;">My Personal Details</h4>
          <div style="border-top:1px solid #dadada;margin-top:5px;margin-bottom:5px;"></div>
          <?php foreach($user_detail as $detail): ?>
          
          <div class="info_panel" id="personal_panel">
                <table>
                    <tr><td><strong>Name: </strong></td><td><?php echo htmlentities($detail["title_salute"]) . " " . htmlentities($detail["first_name"]) . " " . htmlentities($detail["middle_name"]) . " " . htmlentities($detail["last_name"]); ?></td></tr>
              <tr><td><strong>Date Of Birth: </strong></td><td><?php echo htmlentities($detail["date_of_birth"]); ?></td></tr>
              <tr><td><strong>Email: </strong></td><td><?php echo htmlentities($detail["email_id"]);?></td></tr>
              <tr><td><strong>Account Balance: </strong></td><td><?php echo "$".htmlentities($detail["account_balance"]);?></td></tr>
              
              </table>
          </div>
          <?php endforeach; ?>
          <div style="border-top:1px solid #dadada;margin-top:5px;margin-bottom:5px;"></div>
          <br/>
          <h4 style="font-family:Arial;color:#222;">My Contact Details</h4>
          <div style="border-top:1px solid #dadada;margin-top:5px;margin-bottom:5px;"></div>
          
          <?php foreach($user_detail as $detail): ?>
          <div style="float:right;padding:5px;">
              <a href="" id="cls_btn" style="display:none;"><i class="fa fa-times" aria-hidden="true"></i>Cancel</a>
              <a href="" id="contact_edit_btn"><i class="fa fa-pencil fa-fw"></i>Edit Contact</a>
          </div>
          <div class="info_panel" id="contact_panel">
                <table>
                    <tr><td><strong>Country: </strong></td><td><?php echo htmlentities($detail["country"]); ?></td></tr>
              <tr><td><strong>Address Line 1: </strong></td><td><?php echo htmlentities($detail["address_1"]); ?></td></tr>
              <tr><td><strong>Address Line 2: </strong></td><td><?php echo htmlentities($detail["address_2"]);?></td></tr>
              <tr><td><strong>State: </strong></td><td><?php echo htmlentities($detail["state"]);?></td></tr>
              <tr><td><strong>Suburb: </strong></td><td><?php echo htmlentities($detail["suburb"]);?></td></tr>
              <tr><td><strong>PostCode: </strong></td><td><?php echo htmlentities($detail["post_code"]);?></td></tr>
              <tr><td><strong>Phone: </strong></td><td><?php echo htmlentities($detail["phone"]);?></td></tr>
              </table>
          </div>
          <?php endforeach; ?>
          <div style="border-top:1px solid #dadada;margin-top:5px;margin-bottom:5px;"></div>
          <br/>
          <h4 style="font-family:Arial;color:#222;">Change My Password</h4>
          <div style="border-top:1px solid #dadada;margin-top:5px;margin-bottom:5px;"></div>
          <div class="info_panel" id="contact_panel">
              <span style="font-family:Arial;font-size:15px;color:#404040;">Please fill up the form below to change your password.</span> <span style="color:#216C2A;font-family:Arial;font-size:15px;">* Required Field.</span><br/><br/>
              <div class="form_panel">
                  <label for="old_password"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>Old Password: </label><span id="old_password_msg" style="font-family:Arial;font-size:13px;color:#cc0000;"></span><input type="password" id="old_password" name="old_password" placeholder="Old Password"/>
                   <label for="password"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>New Password: </label><span style="font-family:Arial;font-size:12px;">At least 8 characters including uppercase, lowercase and number</span><span id="password_msg" style="font-family:Arial;font-size:13px;color:#cc0000;"></span><input type="password" id="password" name="password" placeholder="Password"/>
                   <label for="confirm_password"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>Confirm Password: </label><span id="confirm_password_msg" style="font-family:Arial;font-size:13px;color:#cc0000;"></span><input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password"/>
                   <input type="button" id="pass_change_btn" name="pass_change_btn" value="Change Password"/>
                   <i class="fa fa-spinner fa-spin fa-2x fa-fw" style="vertical-align:middle;visibility:hidden;" id="pass_loader"></i>
                   <div class="pass_msg" style="padding-bottom:10px;"></div>
              </div>
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