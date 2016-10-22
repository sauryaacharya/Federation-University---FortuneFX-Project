<?php if($exp == false): ?>
<script src="http://<?php echo ROOT_URL; ?>apps/frontend/public/js/validation.js" type="text/javascript"></script>
<h2 style="font-family:Arial;color:#333333;text-shadow: 1px 1px 2px #ddd;">Password Recovery</h2>
<hr/>
<div class="form_panel">
    <span style="font-family:Arial;font-size:15px;color:#404040;">Please fill up the form below to reset your password.</span> <span style="color:#216C2A;font-family:Arial;font-size:15px;">* Required Field.</span><br/><br/>
<form method="post" action="" id="pass_recovery_form">
<label for="password"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>New Password: </label><span style="font-family:Arial;font-size:12px;">At least 8 characters including uppercase, lowercase and number</span><span id="password_msg" style="font-family:Arial;font-size:13px;color:#cc0000;"><?php echo form_individual_error("password"); ?></span><input type="password" id="password" name="password" placeholder="Password" value="<?php echo set_value("password"); ?>"/>
<label for="confirm_password"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>Confirm Password: </label><span id="confirm_password_msg" style="font-family:Arial;font-size:13px;color:#cc0000;"><?php echo form_individual_error("confirm_password"); ?></span><input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" value="<?php echo set_value("confirm_password"); ?>"/>
<input type="submit" id="pass_change_btn" name="pass_change_btn" value="Change Password"/>
</form> 
<?php echo $success_msg; ?>
</div>
<?php endif; ?>
<?php if($exp == true): ?>
<div style="text-align:center;">
<div style="text-align:center;margin-bottom:5px;">
<img src="http://<?php echo ROOT_URL; ?>apps/frontend/public/images/warning_icon.png" style="vertical-align:middle;"/>
</div>
<span style="font-family:Arial;color:#242424;font-size:16px;">
Sorry! Your password reset key has been expired.
</span>
</div>
<?php endif; ?>


