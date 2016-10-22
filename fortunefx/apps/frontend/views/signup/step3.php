<script src="http://<?php echo ROOT_URL; ?>apps/frontend/public/js/validation.js" type="text/javascript"></script>
<script src="http://<?php echo ROOT_URL; ?>apps/frontend/public/js/card.js" type="text/javascript"></script>
<h2 style="font-family:Arial;color:#333333;text-shadow: 1px 1px 2px #ccc;">Register at Fortune FX</h2>
<hr/>
<div id="reg_step">
        <ul>
            <li>1. Personal Details</li>
            <li>2. Account Credentials</li>
            <li style="background:#0086b3;color:#fff;">3. Funding Details</li>
            <li>4. Finish</li>
        </ul>
    <div style="width:0;height:0;border-left:10px solid transparent;border-right:10px solid transparent;border-top:10px solid #0086b3;position:relative;left:495px;"></div>
    </div>
<div class="form_panel">
    <span style="font-family:Arial;font-size:15px;color:#404040;">Please fill up the form below to register at Fortune FX.</span> <span style="color:#216C2A;font-family:Arial;font-size:15px;">* Required Field.</span><br/><br/>
    <h3 style="font-family:Arial;color:#333333;text-shadow: 0px 0px 1px #ccc;">Funding Details</h3>
    <hr/>
    <h4 style="font-family:Arial;color:#333333;">We Accept</h4>
    <i class="fa fa-cc-mastercard fa-2x" aria-hidden="true"></i>
    <i class="fa fa-cc-visa fa-2x" aria-hidden="true"></i>
    <i class="fa fa-cc-amex fa-2x" aria-hidden="true"></i>
    <i class="fa fa-cc-discover fa-2x" aria-hidden="true"></i>
    
    <div class="card_viewer" style="margin:20px 0px 10px 0px;"></div>
 <form method="post" action="" id="step3_form">
     <label for="card_type"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>Card Type: </label><span id="card_type_msg" style="font-family:Arial;font-size:13px;color:#cc0000;"><?php echo form_individual_error("card_type"); ?></span>
     <select id="card_type" name="card_type">
         <option value="">Select Card Type</option>
         <option value="mastercard" <?php if(isset($_SESSION["reg_step_3"]) && $_SESSION["reg_step_3"]["card_type"] == "mastercard" && !isset($_POST["save_cont"])){echo "selected";} if((isset($_SESSION["reg_step_3"]) || !isset($_SESSION["reg_step_3"])) && isset($_POST["save_cont"])){echo set_select("card_type", "mastercard");} ?>>MasterCard</option>
         <option value="visa" <?php if(isset($_SESSION["reg_step_3"]) && $_SESSION["reg_step_3"]["card_type"] == "visa" && !isset($_POST["save_cont"])){echo "selected";} if((isset($_SESSION["reg_step_3"]) || !isset($_SESSION["reg_step_3"])) && isset($_POST["save_cont"])){echo set_select("card_type", "visa");} ?>>Visa</option>
         <option value="amex" <?php if(isset($_SESSION["reg_step_3"]) && $_SESSION["reg_step_3"]["card_type"] == "amex" && !isset($_POST["save_cont"])){echo "selected";} if((isset($_SESSION["reg_step_3"]) || !isset($_SESSION["reg_step_3"])) && isset($_POST["save_cont"])){echo set_select("card_type", "amex");} ?>>American Express</option>
         <option value="discover" <?php if(isset($_SESSION["reg_step_3"]) && $_SESSION["reg_step_3"]["card_type"] == "discover" && !isset($_POST["save_cont"])){echo "selected";} if((isset($_SESSION["reg_step_3"]) || !isset($_SESSION["reg_step_3"])) && isset($_POST["save_cont"])){echo set_select("card_type", "discover");} ?>>Discover</option>
     </select>
     <label for="holder_name"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>Card Holder's Name: </label><span id="holder_name_msg" style="font-family:Arial;font-size:13px;color:#cc0000;"><?php echo form_individual_error("holder_name"); ?></span><input type="text" id="holder_name" name="holder_name" placeholder="Card Holder's Name" value="<?php if(isset($_SESSION["reg_step_3"]) && !isset($_POST["save_cont"])){echo $_SESSION["reg_step_3"]["holder_name"];} if((isset($_SESSION["reg_step_3"]) || !isset($_SESSION["reg_step_3"])) && isset($_POST["save_cont"])){echo set_value("holder_name");} ?>"/>
        <label for="card_number"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>Card Number: </label><span id="card_number_msg" style="font-family:Arial;font-size:13px;color:#cc0000;"><?php echo form_individual_error("card_number"); ?></span><input type="text" id="card_number" name="card_number" placeholder="Card Number" value="<?php if(isset($_SESSION["reg_step_3"]) && !isset($_POST["save_cont"])){echo $_SESSION["reg_step_3"]["card_number"];} if((isset($_SESSION["reg_step_3"]) || !isset($_SESSION["reg_step_3"])) && isset($_POST["save_cont"])){echo set_value("card_number");} ?>"/>
        <label for="ccv"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>CCV: </label><span id="ccv_msg" style="font-family:Arial;font-size:13px;color:#cc0000;"><?php echo form_individual_error("ccv"); ?></span><input type="text" id="ccv" name="ccv" placeholder="CCV" value="<?php if(isset($_SESSION["reg_step_3"]) && !isset($_POST["save_cont"])){echo $_SESSION["reg_step_3"]["ccv"];} if((isset($_SESSION["reg_step_3"]) || !isset($_SESSION["reg_step_3"])) && isset($_POST["save_cont"])){echo set_value("ccv");} ?>"/>
        <label for="expiry"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>Expiry: </label><span id="expiry_msg" style="font-family:Arial;font-size:13px;color:#cc0000;"><?php echo form_individual_error("expiry"); ?></span><input type="text" id="expiry" name="expiry" placeholder="MM/YYYY" value="<?php if(isset($_SESSION["reg_step_3"]) && !isset($_POST["save_cont"])){echo $_SESSION["reg_step_3"]["expiry"];} if((isset($_SESSION["reg_step_3"]) || !isset($_SESSION["reg_step_3"])) && isset($_POST["save_cont"])){echo set_value("expiry");} ?>"/>
        <input type="submit" id="save_cont" name="save_cont" value="Save and Continue"/>
 </form>
    <span id="step_msg"></span>
    <script type="text/javascript">
        
        var card = new Card({
            form: "form", 
            container: ".card_viewer", 
            formSelectors: {
                numberInput: "input#card_number",
                expiryInput: "input#expiry",
                cvcInput: "input#ccv",
                nameInput: "input#holder_name"
            }, 
            formatting:true
        });
        
    </script>
</div>