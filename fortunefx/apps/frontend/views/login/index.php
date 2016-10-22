<h2 style="font-family:Arial;color:#333333;text-shadow: 1px 1px 2px #ccc;">Member Login</h2>
<hr/>
<div class="form_panel mem_grid">
<form method="post" action="">
    <span style="font-family:Arial;font-size:15px;color:#404040;">Login at Fortune Fx.</span> <span style="color:#216C2A;font-family:Arial;font-size:15px;">* Required Field.</span><br/><br/>
    <label for="email_id"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>Email: </label><input type="text" id="email_id" name="email_id" placeholder="Email" value="<?php echo set_value("email_id"); ?>"/>
    <label for="password"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>Password: </label><input type="password" id="password" name="password" placeholder="Password" value="<?php echo set_value("password"); ?>"/>
        <!--<input type="checkbox" id="remember_me_checkbox" name="remember_me_checkbox" value="Remember Me"/> Remember Me <br/>-->
        <a href="./utils/passwordreset" id="forget_pass_link">Forget Password</a><br/><br/>
        <input type="submit" id="login_btn" name="login_btn" value="Login">
</form>
    <?php echo form_individual_error("login_btn", "<div class=\"error\" style=\"font-family:Arial;color:#cc0000;font-size:13px;border:1px solid #eaeaea;padding:10px;background:#f2f2f2;\">", "</div>"); ?>
</div>
<div id="create_acc_panel" class="mem_grid">
    <h4 style="font-family:Arial;color:#333333;text-shadow: 0px 0px 1px #ccc;">Open Your New Account </h4>
    <br/>
    <div>
        <span style="font-family:Arial;font-size:14px;color:#4d4d4d;">Create an account with us and you'll be able to:</span>
    <ul>
        <li>Start online trading</li>
        <li>Buy / Sell Currency</li>
        <li>View Economic Calendar</li>
        <li>View various currency pair charts and so on</li>
    </ul>
    </div>
    <br/>
    <input type="button" value="Click Here To Open A New Account >" id="create_acc_btn" onclick="location.href='http://localhost/fortunefx/signup';"/>
</div>
<div style="clear: both;"></div>