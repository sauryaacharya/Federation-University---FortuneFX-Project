<h2 style="font-family:Arial;color:#333333;text-shadow: 1px 1px 2px #ddd;">Password Reset</h2>
<hr/>
<span style="font-family:Arial;font-size:15px;color:#404040;">Please fill up the field below to reset your password.</span> <span style="color:#216C2A;font-family:Arial;font-size:15px;">* Required Field.</span><br/><br/> 
<form method="post" action="">
    <label for="email_id" style="font-family:Arial;font-size:15px;color:#595959;font-weight:bold;"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>Email: </label>
    <input type="text" id="email_id" name="email_id" placeholder="Email" style="width:30%;margin-top:5px;" value="<?php echo set_value("email_id"); ?>"/>
    <input type="submit" value="Send" id="send_btn" name="send_btn"/>
    <br/>
    <?php echo form_individual_error("email_id", "<div id='success_msg' style='font-family:Arial;color:#cc0000;font-size:13px;border:1px solid #eaeaea;padding:10px;background:#f2f2f2;'>", "</div>"); ?>
    <?php echo $success_msg; ?>
</form>