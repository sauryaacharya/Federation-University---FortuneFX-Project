<script type="text/javascript">
    $(document).ready(function(){
        var agreement_check = document.getElementById("agreement");
        var reg_btn = document.getElementById("submit_reg");
      $("#agreement").change(function(){
          if(agreement_check.checked == true)
          {
              reg_btn.disabled = false;
              $("#submit_reg").css("background", "#216C2A");
          }
          else if(agreement_check.checked == false)
          {
              $("#submit_reg").css("background", "#8cd9b3");
              reg_btn.disabled = true;
          }
      });
    }); 
</script>
<h2 style="font-family:Arial;color:#333333;text-shadow: 1px 1px 2px #ccc;">Register at Fortune FX</h2>
<hr/>
<div id="reg_step">
        <ul>
            <li>1. Personal Details</li>
            <li>2. Account Credentials</li>
            <li>3. Funding Details</li>
            <li style="background:#0086b3;color:#fff;">4. Finish</li>
        </ul>
    <div style="width:0;height:0;border-left:10px solid transparent;border-right:10px solid transparent;border-top:10px solid #0086b3;position:relative;left:700px;"></div>
    </div>
<div class="form_panel">
    <span style="font-family:Arial;font-size:15px;color:#404040;">Please fill up the form below to register at Fortune FX.</span> <span style="color:#216C2A;font-family:Arial;font-size:15px;">* Required Field.</span><br/><br/>
    <h3 style="font-family:Arial;color:#333333;text-shadow: 0px 0px 1px #ccc;">Terms and Condition Acceptance</h3>
    <hr/>
 <form method="post" action="">
     <input type="checkbox" id="agreement" name="agreement" value="Terms" <?php echo set_checkbox("agreement", "Terms"); ?>/>
        <label for="agreement"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>I accept the terms and conditions of the Fortune FX and register to the website. </label><br/><br/>
        <input type="submit" id="submit_reg" name="submit_reg" value="Register" disabled/>
        <span id="agreement_msg" style="font-family:Arial;font-size:13px;color:#cc0000;"><?php echo form_individual_error("agreement"); ?></span>
</form>
</div>