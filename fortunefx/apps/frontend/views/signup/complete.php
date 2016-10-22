<script src="http://<?php echo ROOT_URL; ?>apps/frontend/public/js/validation.js" type="text/javascript"></script>
<script src="http://<?php echo ROOT_URL; ?>apps/frontend/public/js/common.js" type="text/javascript"></script>
<div>
<div style="text-align:center;">
<img src="http://<?php echo ROOT_URL; ?>apps/frontend/public/images/success_icon.png"/>
</div>
<br/>
<span style="font-family:Arial;color:#242424;font-size:16px;">
Congratulations! Your account has been created. A confirmation email has been sent to your email. Please follow the link given in your email to activate your account.
<br/><br/>
<strong>Didn't get an email. Send again</strong>
</span>
<br/>
<form method="post" action="" id="confirm_email_send">
<input type="text" placeholder="Email" id="email" name="email" style="width:30%;margin-top:5px;"/>
<input type="submit" id="send_btn" name="send_btn" value="Send"/>
</form>
<div id="email_error_msg" style="font-family:Arial;font-size:13px;"></div>
</div>

