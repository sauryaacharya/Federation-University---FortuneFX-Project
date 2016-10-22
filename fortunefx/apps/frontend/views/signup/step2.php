<script src="http://<?php echo ROOT_URL; ?>apps/frontend/public/js/validation.js" type="text/javascript"></script>
<h2 style="font-family:Arial;color:#333333;text-shadow: 1px 1px 2px #ccc;">Register at Fortune FX</h2>
<hr/>
<div id="reg_step">
        <ul>
            <li>1. Personal Details</li>
            <li style="background:#0086b3;color:#fff;">2. Account Credentials</li>
            <li>3. Funding Details</li>
            <li>4. Finish</li>
        </ul>
    <div style="width:0;height:0;border-left:10px solid transparent;border-right:10px solid transparent;border-top:10px solid #0086b3;position:relative;left:288px;"></div>
    </div>
<div class="form_panel">
    <span style="font-family:Arial;font-size:15px;color:#404040;">Please fill up the form below to register at Fortune FX.</span> <span style="color:#216C2A;font-family:Arial;font-size:15px;">* Required Field.</span><br/><br/>
    <h3 style="font-family:Arial;color:#333333;text-shadow: 0px 0px 1px #ccc;">Account Credentials</h3>
    <hr/>
 <form method="post" action="" id="step2_form">
        <label for="email_id"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>Email: </label><span id="email_msg" style="font-family:Arial;font-size:13px;color:#cc0000;"><?php echo form_individual_error("email_id"); ?></span><input type="text" id="email_id" name="email_id" placeholder="Email" value="<?php if(isset($_SESSION["reg_step_2"]) && !isset($_POST["save_cont"])){echo $_SESSION["reg_step_2"]["email_id"];} if((isset($_SESSION["reg_step_2"]) || !isset($_SESSION["reg_step_2"])) && isset($_POST["save_cont"])){echo set_value("email_id");} ?>"/>
        <label for="password"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>Password: </label><span style="font-family:Arial;font-size:12px;">At least 8 characters including uppercase, lowercase and number</span><span id="password_msg" style="font-family:Arial;font-size:13px;color:#cc0000;"><?php echo form_individual_error("password"); ?></span><input type="password" id="password" name="password" placeholder="Password" value="<?php if(isset($_SESSION["reg_step_2"]) && !isset($_POST["save_cont"])){echo $_SESSION["reg_step_2"]["password"];} if((isset($_SESSION["reg_step_2"]) || !isset($_SESSION["reg_step_2"])) && isset($_POST["save_cont"])){echo set_value("password");} ?>"/>
        <label for="confirm_password"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>Confirm Password: </label><span id="confirm_password_msg" style="font-family:Arial;font-size:13px;color:#cc0000;"><?php echo form_individual_error("confirm_password"); ?></span><input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" value="<?php if(isset($_SESSION["reg_step_2"]) && !isset($_POST["save_cont"])){echo $_SESSION["reg_step_2"]["confirm_password"];} if((isset($_SESSION["reg_step_2"]) || !isset($_SESSION["reg_step_2"])) && isset($_POST["save_cont"])){echo set_value("confirm_password");} ?>"/>
        <label for="security_question"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>Security Question: </label>
        <span id="sec_q_msg" style="font-family:Arial;font-size:13px;color:#cc0000;"><?php echo form_individual_error("security_question"); ?></span>
        <select id="security_question" name="security_question">
            <option value="">Please select your security question</option>
            <?php foreach($questions as $question):?>
            <option value="<?php echo htmlentities($question["q_id"]); ?>" <?php if(isset($_SESSION["reg_step_2"]) && $_SESSION["reg_step_2"]["security_question"] == $question["q_id"] && !isset($_POST["save_cont"])){echo "selected";} if((isset($_SESSION["reg_step_2"]) || !isset($_SESSION["reg_step_2"])) && isset($_POST["save_cont"])){echo set_select("country", $question["q_id"]);} ?>><?php echo htmlentities($question["question"]); ?></option>
            <?php endforeach;?>
        </select>
        <label for="answer"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>Answer: </label><span id="ans_msg" style="font-family:Arial;font-size:13px;color:#cc0000;"><?php echo form_individual_error("answer"); ?></span><input type="text" id="answer" name="answer" placeholder="Security Answer" value="<?php if(isset($_SESSION["reg_step_2"]) && !isset($_POST["save_cont"])){echo $_SESSION["reg_step_2"]["answer"];} if((isset($_SESSION["reg_step_2"]) || !isset($_SESSION["reg_step_2"])) && isset($_POST["save_cont"])){echo set_value("answer");} ?>"/>
        <input type="submit" id="save_cont" name="save_cont" value="Save and Continue"/>
</form>
    <span id="step_msg"></span>
</div>