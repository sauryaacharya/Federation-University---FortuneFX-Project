$(document).ready(function(){
    var timer;
    
    getAccountSummary();
    
    $("#card_edit_btn").click(function(event){
       event.preventDefault();
       $(".card_panel").fadeOut(200, showEditPanel);
    });
    
    $("#contact_edit_btn").click(function(event){
        event.preventDefault();
        $("#contact_panel").fadeOut(200, displayContactEditPanel);
    });
   
   $("#cls_btn").click(function(event){
      event.preventDefault();
      $("#contact_panel").fadeOut(200, displayContactPanel);
   });
   
    $("#close_btn").click(function(event){
        event.preventDefault();
        $(".card_panel").fadeOut(200, displayToCardPanel);  
    });
    
    $("#arrow_down").click(function(event){
       event.preventDefault();
       clearInterval(timer);
       $("#order_place_table").animate({bottom: '-40%', display: 'none'}, fadeMenIn);
       
    });
    
    $("#arrow_up").click(function(event){
       event.preventDefault();
       getLiveRate();
       timer = setInterval(getLiveRate, 1500);
       $("#order_place_table").fadeIn().animate({bottom: '0%'}, fadeMenOut);

    });
    
    $("#fund_amt").keydown(function(e){
        var value = String.fromCharCode(e.keyCode);
        if(isNaN(value) && e.keyCode != 8 && e.keyCode != 190)
        {
            return false;
        }
        return true;
    });
    
    $("#pass_change_btn").click(function(event){
        updatePassword(event);
    });
    
    $("#fund_btn").click(function(){
       var amount = $("#fund_amt").val();
       if(amount === "" || isNaN(amount))
       {
           $("#fund_error_msg").html("<span style='font-family:Arial;color:#e60000;font-size:13px;'>Enter the amount to deposit.</span>");
       }
       else
       {
           $.ajax({
        type: "POST", 
        cache: false,
        url: "http://localhost/fortunefx/ajaxservice/deposit",
        data: {fund_amt: amount},
        beforeSend: function(){
            $("#box").css("display", "block");
           $("#box").html('<div style="position:relative;top:35%;text-align:center;"><i class="fa fa-spinner fa-spin fa-5x fa-fw"></i><br/><span style="font-family:Arial;font-size:13px;color:#333;">Processing Your Payment.Please wait...</span></div>');
           $("body").css("overflow", "hidden");
        }, 
        success: function(data)
        {
            if(data.status == "approved")
            {
            $("#box").html('<div style="position:relative;top:35%;text-align:center;"><i class="fa fa-check-circle fa-5x" aria-hidden="true" style="color:#216C2A;"></i><br/><span style="font-family:Arial;font-size:13px;color:#333;">Your payment has been approved.</span></div>').delay(2500).fadeOut(500);
            $("body").css("overflow", "auto");
            $("#acc_bal").html("$"+data.amt);
        }
        else
        {
            $("#box").html('<div style="position:relative;top:35%;text-align:center;"><i class="fa fa-exclamation-triangle fa-5x" aria-hidden="true" style="color:#CC0000;"></i><br/><span style="font-family:Arial;font-size:13px;color:#333;">Error! Your payment has not been approved.</span></div>').delay(2500).fadeOut(500);
            $("body").css("overflow", "auto");
        }
        }   
    });
           
       }
    });
});

function fadeMenIn()
{
    $("#order_place_men").fadeIn(500);
}

function fadeMenOut()
{
    $("#order_place_men").fadeOut(500);
}

function getAccountSummary()
{ 
    $.ajax({
        type: "GET",
        url: "http://localhost/fortunefx/ajaxservice/accountsummary",
        beforeSend: function(){
            //$("#acc_summ_panel i").css("visibility", "visible");
        },
        success: function(data)
        {
            $("#acc_summ_panel").html(getSummHtml(data));
            getAccountSummary();
        } 
    });
}

function getSummHtml(json_data)
{
    var html = "";
       html += "<table id='summary_tbl'>";
        html += "<tr><td><strong>Account Balance: </strong></td><td>$"+json_data.account_summary.account_balance+"</td></tr>";
        html += "<tr><td><strong>Marginal Balance: </strong></td><td>$"+json_data.account_summary.marginal_balance+"</td></tr>";
        html += "<tr><td><strong>Realized P&L: </strong></td><td><span style='color:"+(json_data.account_summary.realized_pl < 0 ? '#cc0000;' : 'green;')+"'>$"+json_data.account_summary.realized_pl+"</span></td></tr>";
        html += "<tr><td><strong>Unrealized P&L: </strong></td><td><span style='color:"+(json_data.account_summary.unrealized_pl < 0 ? '#cc0000;' : 'green;')+"'>$"+json_data.account_summary.unrealized_pl+"</span></td></tr>";
        html += "</table>";
    return html;
}


function validatePassword()
{
        
        var password = $("#password").val();
        var confirm_password = $("#confirm_password").val();
        var old_password = $("#old_password").val();
        
        var error_free = true;
        
        if(password == "")
        {
            $("#password_msg").html("&nbsp;&nbsp;Please enter the password.");
            $("#password").css("border", "2px solid #cc0000");
            error_free = false;
        }
        else
        {
            if(password.length < 8)
            {
                $("#password_msg").html("&nbsp;&nbsp;Please enter the password of at least 8 characters.");
                $("#password").css("border", "2px solid #cc0000");
                error_free = false;
            }
            
            else
            {
                if(!isValidPassword(password))
                {
                    $("#password_msg").html("&nbsp;&nbsp;Please enter the password including uppercase, lowercase and number.");
                    $("#password").css("border", "2px solid #cc0000");
                    error_free = false;
                }
            }
           
        }
        if(confirm_password == "")
        {
            $("#confirm_password_msg").html("Please enter the confirm password.");
            $("#confirm_password").css("border", "2px solid #cc0000");
            error_free = false; 
        }
        else
        {
            if(password !== confirm_password)
            {
                $("#confirm_password_msg").html("Password mismatch.");
                $("#confirm_password").css("border", "2px solid #cc0000");
                error_free = false; 
            }
        }
        
        if(old_password == "")
        {
            setError("#old_password_msg", "#old_password", "Please enter the old password.");
            error_free = false;
        }
        else
        {
            $("#old_password_msg").html("");
            $("#old_password").css("border", "2px solid #B8B8B8");
        }
        
        return error_free;
        
}

function validateContact()
{
    var phone = $("#phone").val();
    var country = $("#country").val();
    var add1 = $("#add1").val();
    var state = $("#state").val();
    var suburb = $("#suburb").val();
    var postcode = $("#postcode").val();
    
    var error_free = true;
    
    if(phone == "")
        {
            setError("#phn_msg", "#phone", "Please enter the phone number.");
            error_free = false;
        }
        else
        {
            setValidSign("#phn_msg", "#phone");
        }
        if(country == "")
        {
            setError("#country_msg", "#country", "Please select the country.");
            error_free = false;
        }
        else
        {
            setValidSign("#country_msg", "#country");
        }
        if(add1 == "")
        {
            setError("#add1_msg", "#add1", "Please enter the address.");
            error_free = false;
        }
        else
        {
            setValidSign("#add1_msg", "#add1");
        }
        if(state == "")
        {
            setError("#state_msg", "#state", "Please enter the state.");
            error_free = false;
        }
        else
        {
            setValidSign("#state_msg", "#state");
        }
        if(suburb == "")
        {
            setError("#suburb_msg", "#suburb", "Please enter the suburb.");
            error_free = false;
        }
        else
        {
            setValidSign("#suburb_msg", "#suburb");
        }
        if(postcode == "")
        {
            setError("#postcode_msg", "#postcode", "Please enter the postcode.");
            error_free = false;
        }
        else
        {
            setValidSign("#postcode_msg", "#postcode");
        }
        return error_free;
}

function updatePassword(event)
{
    if(validatePassword(event) == true)
    {
        var old_password = $("#old_password").val();
        var new_password = $("#password").val();
        //var confirm_password = $("#confirm_password").val();
        
        $.ajax({
            type: "POST",
            url: "http://localhost/fortunefx/ajaxservice/changepassword",
            data: {old_password: old_password, new_password:new_password},
            beforeSend: function(){
                $("#pass_loader").css("visibility", "visible");
            },
            success: function(data)
            {
                $("#pass_loader").css("visibility", "hidden");
                if(data.response.status == "success")
                {
                    $(".pass_msg").html("<span style='font-family:Arial;color:green;font-size:13px;border:1px solid #eaeaea;padding:10px;background:#f2f2f2;'>" + data.response.msg + "</span>");
                }
                else
                {
                    $(".pass_msg").html("<span style='font-family:Arial;color:#cc0000;font-size:13px;border:1px solid #eaeaea;padding:10px;background:#f2f2f2;'>Error! " + data.response.msg + "</span>");
                }
            }
            
        });
    }
}

function displayContactEditPanel()
{
    $.ajax({
        type: "GET", 
        url: "http://localhost/fortunefx/ajaxservice/userdetails",
        success: function(data)
        {
            $("#contact_panel").html(getContactEditPanelHtml(data)).fadeIn();
            $("#cls_btn").css("display", "inline");
            $("#contact_edit_btn").css("display", "none");
        }   
    });
}

function displayContactPanel()
{
    $.ajax({
        type: "GET", 
        url: "http://localhost/fortunefx/ajaxservice/userdetails",
        success: function(data)
        {
            $("#contact_panel").html(getContactPanelHtml(data)).fadeIn();
            $("#cls_btn").css("display", "none");
            $("#contact_edit_btn").css("display", "inline");
        }   
    });
}

function getContactPanelHtml(json_data)
{
    var i;
    var html = "";
    var data_length = json_data.user_detail.length;
    for(i = 0; i < data_length; i++)
    {
        html += '<table>';
        html += '<tr><td><strong>Country: </strong></td><td>'+json_data.user_detail[i].country+'</td></tr>';
        html += '<tr><td><strong>Address Line 1: </strong></td><td>'+json_data.user_detail[i].address_1+'</td></tr>';
        html += '<tr><td><strong>Address Line 2: </strong></td><td>'+json_data.user_detail[i].address_2+'</td></tr>';
        html += '<tr><td><strong>State: </strong></td><td>'+json_data.user_detail[i].state+'</td></tr>';
        html += '<tr><td><strong>Suburb: </strong></td><td>'+json_data.user_detail[i].suburb+'</td></tr>';
        html += '<tr><td><strong>PostCode: </strong></td><td>'+json_data.user_detail[i].post_code+'</td></tr>';
        html += '<tr><td><strong>Phone: </strong></td><td>'+json_data.user_detail[i].phone+'</td></tr>';
        html += '</table>';
    }
    return html;
}

function getContactEditPanelHtml(json_data)
{
    var i;
    var html = "";
    var data_length = json_data.user_detail.length;
    
    for(i = 0; i < data_length; i++)
    {
        html += '<div class="form_panel">';
        html += '<label for="country"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>Country: </label>';
        html += '<span id="country_msg" style="font-family:Arial;font-size:13px;color:#cc0000;"></span>';
        html += '<select id="country" name="country">';
        html += '<option value="Afghanistan" ' +(json_data.user_detail[i].country == "Afghanistan" ? 'selected' : ' ') + '>Afghanistan</option>';
		html += '<option value="Albania" ' +(json_data.user_detail[i].country == "Albania" ? 'selected' : ' ') + '>Albania</option>';
		html += '<option value="Algeria" ' +(json_data.user_detail[i].country == "Algeria" ? 'selected' : ' ') + '>Algeria</option>';
		html += '<option value="American Samoa" ' +(json_data.user_detail[i].country == "American Samoa" ? 'selected' : ' ') + '>American Samoa</option>';
		html += '<option value="Andorra" ' +(json_data.user_detail[i].country == "Andorra" ? 'selected' : ' ') + '>Andorra</option>';
		html += '<option value="Angola"" ' +(json_data.user_detail[i].country == "Angola" ? 'selected' : ' ') + '>Angola</option>';
		html += '<option value="Anguilla" ' +(json_data.user_detail[i].country == "Anguilla" ? 'selected' : ' ') + '>Anguilla</option>';
		html += '<option value="Antarctica" ' +(json_data.user_detail[i].country == "Antarctica" ? 'selected' : ' ') + '>Antarctica</option>';
		html += '<option value="Antigua" ' +(json_data.user_detail[i].country == "Antigua" ? 'selected' : ' ') + '>Antigua</option>';
		html += '<option value="Argentina" ' +(json_data.user_detail[i].country == "Argentina" ? 'selected' : ' ') + '>Argentina</option>';
		html += '<option value="Armenia" ' +(json_data.user_detail[i].country == "Armenia" ? 'selected' : ' ') + '>Armenia</option>';
		html += '<option value="Aruba" ' +(json_data.user_detail[i].country == "Aruba" ? 'selected' : ' ') + '>Aruba</option>';
		html += '<option value="Australia"  ' +(json_data.user_detail[i].country == "Australia"  ? 'selected' : ' ') + '>Australia</option>';
		html += '<option value="Austria" ' +(json_data.user_detail[i].country == "Austria" ? 'selected' : ' ') + '>Austria</option>';
		html += '<option value="Azerbaijan" ' +(json_data.user_detail[i].country == "Azerbaijan" ? 'selected' : ' ') + '>Azerbaijan</option>';
		html += '<option value="Bahamas" ' +(json_data.user_detail[i].country == "Bahamas" ? 'selected' : ' ') + '>Bahamas</option>';
		html += '<option value="Bahrain" ' +(json_data.user_detail[i].country == "Bahrain" ? 'selected' : ' ') + '>Bahrain</option>';
		html += '<option value="Bangladesh" ' +(json_data.user_detail[i].country == "Bangladesh" ? 'selected' : ' ') + '>Bangladesh</option>';
		html += '<option value="Barbados" ' +(json_data.user_detail[i].country == "Barbados" ? 'selected' : ' ') + '>Barbados</option>';
		html += '<option value="Belarus" ' +(json_data.user_detail[i].country == "Belarus" ? 'selected' : ' ') + '>Belarus</option>';
		html += '<option value="Belgium" ' +(json_data.user_detail[i].country == "Belgium" ? 'selected' : ' ') + '>Belgium</option>';
		html += '<option value="Belize" ' +(json_data.user_detail[i].country == "Belize" ? 'selected' : ' ') + '>Belize</option>';
		html += '<option value="Benin" ' +(json_data.user_detail[i].country == "Benin" ? 'selected' : ' ') + '>Benin</option>';
		html += '<option value="Bermuda"  ' +(json_data.user_detail[i].country == "Bermuda"  ? 'selected' : ' ') + '>Bermuda</option>';
		html += '<option value="Bhutan" ' +(json_data.user_detail[i].country == "Bhutan" ? 'selected' : ' ') + '>Bhutan</option>';
		html += '<option value="Bolivia" ' +(json_data.user_detail[i].country == "Bolivia" ? 'selected' : ' ') + '>Bolivia</option>';
		html += '<option value="Bosnia And Herzegowina" ' +(json_data.user_detail[i].country == "Bosnia And Herzegowina" ? 'selected' : ' ') + '>Bosnia And Herzegowina</option>';
		html += '<option value="Botswana" ' +(json_data.user_detail[i].country == "Botswana" ? 'selected' : ' ') + '>Botswana</option>';
		html += '<option value="Bouvet Island" ' +(json_data.user_detail[i].country == "Bouvet Island" ? 'selected' : ' ') + '>Bouvet Island</option>';
		html += '<option value="Brazil" ' +(json_data.user_detail[i].country == "Brazil" ? 'selected' : ' ') + '>Brazil</option>';
		html += '<option value="British Indian Ocean Territory" ' +(json_data.user_detail[i].country == "British Indian Ocean Territory" ? 'selected' : ' ') + '>British Indian Ocean Territory</option>';
		html += '<option value="Brunei Darussalam" ' +(json_data.user_detail[i].country == "Brunei Darussalam" ? 'selected' : ' ') + '>Brunei Darussalam</option>';
		html += '<option value="Bulgaria" ' +(json_data.user_detail[i].country == "Bulgaria" ? 'selected' : ' ') + '>Bulgaria</option>';
		html += '<option value="Burkina Faso" ' +(json_data.user_detail[i].country == "Burkina Faso" ? 'selected' : ' ') + '>Burkina Faso</option>';
		html += '<option value="Burundi" ' +(json_data.user_detail[i].country == "Burundi" ? 'selected' : ' ') + '>Burundi</option>';
		html += '<option value="Cambodia" ' +(json_data.user_detail[i].country == "Cambodia" ? 'selected' : ' ') + '>Cambodia</option>';
		html += '<option value="Cameroon" ' +(json_data.user_detail[i].country == "Cameroon" ? 'selected' : ' ') + '>Cameroon</option>';
		html += '<option value="Canada" ' +(json_data.user_detail[i].country == "Canada" ? 'selected' : ' ') + '>Canada</option>';
		html += '<option value="Cape Verde" ' +(json_data.user_detail[i].country == "Cape Verde" ? 'selected' : ' ') + '>Cape Verde</option>';
		html += '<option value="Cayman Islands" ' +(json_data.user_detail[i].country == "Cayman Islands" ? 'selected' : ' ') + '>Cayman Islands</option>';
		html += '<option value="Central African Republic" ' +(json_data.user_detail[i].country == "Central African Republic" ? 'selected' : ' ') + '>Central African Republic</option>';
		html += '<option value="Chad" ' +(json_data.user_detail[i].country == "Chad" ? 'selected' : ' ') + '>Chad</option>';
		html += '<option value="Chile" ' +(json_data.user_detail[i].country == "Chile" ? 'selected' : ' ') + '>Chile</option>';
		html += '<option value="China" ' +(json_data.user_detail[i].country == "China" ? 'selected' : ' ') + '>China</option>';
		html += '<option value="Christmas Island" ' +(json_data.user_detail[i].country == "Christmas Island" ? 'selected' : ' ') + '>Christmas Island</option>';
		html += '<option value="Cocos (Keeling) Islands" ' +(json_data.user_detail[i].country == "Cocos (Keeling) Islands" ? 'selected' : ' ') + '>Cocos (Keeling) Islands</option>';
		html += '<option value="Colombia" ' +(json_data.user_detail[i].country == "Colombia" ? 'selected' : ' ') + '>Colombia</option>';
		html += '<option value="Comoros" ' +(json_data.user_detail[i].country == "Comoros" ? 'selected' : ' ') + '>Comoros</option>';
		html += '<option value="Congo" ' +(json_data.user_detail[i].country == "Congo" ? 'selected' : ' ') + '>Congo</option>';
		html += '<option value="Cook Islands" ' +(json_data.user_detail[i].country == "Cook Islands" ? 'selected' : ' ') + '>Cook Islands</option>';
		html += '<option value="Costa Rica" ' +(json_data.user_detail[i].country == "Costa Rica" ? 'selected' : ' ') + '>Costa Rica</option>';
		html += '<option value="Cote D\'Ivoire" ' +(json_data.user_detail[i].country == "Cote D\'Ivoire" ? 'selected' : ' ') + '>Cote D\'Ivoire</option>';
		html += '<option value="Croatia"  ' +(json_data.user_detail[i].country == "Croatia"  ? 'selected' : ' ') + '>Croatia</option>';
		html += '<option value="Cuba" ' +(json_data.user_detail[i].country == "Cuba" ? 'selected' : ' ') + '>Cuba</option>';
		html += '<option value="Cyprus" ' +(json_data.user_detail[i].country == "Cyprus" ? 'selected' : ' ') + '>Cyprus</option>';
		html += '<option value="Czech Republic" ' +(json_data.user_detail[i].country == "Czech Republic" ? 'selected' : ' ') + '>Czech Republic</option>';
		html += '<option value="Denmark" ' +(json_data.user_detail[i].country == "Denmark" ? 'selected' : ' ') + '>Denmark</option>';
		html += '<option value="Djibouti" ' +(json_data.user_detail[i].country == "Djibouti" ? 'selected' : ' ') + '>Djibouti</option>';
		html += '<option value="Dominica" ' +(json_data.user_detail[i].country == "Dominica" ? 'selected' : ' ') + '>Dominica</option>';
		html += '<option value="Dominican Republic" ' +(json_data.user_detail[i].country == "Dominican Republic" ? 'selected' : ' ') + '>Dominican Republic</option>';
		html += '<option value="East Timor" ' +(json_data.user_detail[i].country == "East Timor" ? 'selected' : ' ') + '>East Timor</option>';
		html += '<option value="Ecuador" ' +(json_data.user_detail[i].country == "Ecuador"? 'selected' : ' ') + '>Ecuador</option>';
		html += '<option value="Egypt" ' +(json_data.user_detail[i].country == "Egypt" ? 'selected' : ' ') + '>Egypt</option>';
		html += '<option value="El Salvador"  ' +(json_data.user_detail[i].country == "El Salvador"  ? 'selected' : ' ') + '>El Salvador</option>';
		html += '<option value="Equatorial Guinea"' +(json_data.user_detail[i].country == "Equatorial Guinea" ? 'selected' : ' ') + '>Equatorial Guinea</option>';
		html += '<option value="Eritrea" ' +(json_data.user_detail[i].country == "Eritrea" ? 'selected' : ' ') + '>Eritrea</option>';
		html += '<option value="Estonia" ' +(json_data.user_detail[i].country == "Estonia"? 'selected' : ' ') + '>Estonia</option>';
		html += '<option value="Ethiopia" ' +(json_data.user_detail[i].country == "Ethiopia" ? 'selected' : ' ') + '>Ethiopia</option>';
		html += '<option value="Falkland Islands (Malvinas)" ' +(json_data.user_detail[i].country == "Falkland Islands (Malvinas)" ? 'selected' : ' ') + '>Falkland Islands (Malvinas)</option>';
		html += '<option value="Faroe Islands" ' +(json_data.user_detail[i].country == "Faroe Islands" ? 'selected' : ' ') + '>Faroe Islands</option>';
		html += '<option value="Fiji" ' +(json_data.user_detail[i].country == "Fiji" ? 'selected' : ' ') + '>Fiji</option>';
		html += '<option value="Finland" ' +(json_data.user_detail[i].country == "Finland"? 'selected' : ' ') + '>Finland</option>';
		html += '<option value="France" ' +(json_data.user_detail[i].country == "France" ? 'selected' : ' ') + '>France</option>';
		html += '<option value="French Guiana" ' +(json_data.user_detail[i].country == "French Guiana" ? 'selected' : ' ') + '>French Guiana</option>';
		html += '<option value="French Polynesia" ' +(json_data.user_detail[i].country == "French Polynesia" ? 'selected' : ' ') + '>French Polynesia</option>';
		html += '<option value="French Southern Territories" ' +(json_data.user_detail[i].country == "French Southern Territories" ? 'selected' : ' ') + '>French Southern Territories</option>';
		html += '<option value="Gabon" ' +(json_data.user_detail[i].country == "Gabon" ? 'selected' : ' ') + '>Gabon</option>';
		html += '<option value="Gambia" ' +(json_data.user_detail[i].country == "Gambia" ? 'selected' : ' ') + '>Gambia</option>';
		html += '<option value="Georgia" ' +(json_data.user_detail[i].country == "Georgia" ? 'selected' : ' ') + '>Georgia</option>';
		html += '<option value="Germany" ' +(json_data.user_detail[i].country == "Germany" ? 'selected' : ' ') + '>Germany</option>';
		html += '<option value="Ghana" ' +(json_data.user_detail[i].country == "Ghana" ? 'selected' : ' ') + '>Ghana</option>';
		html += '<option value="Gibraltar" ' +(json_data.user_detail[i].country == "Gibraltar" ? 'selected' : ' ') + '>Gibraltar</option>';
		html += '<option value="Greece" ' +(json_data.user_detail[i].country == "Greece" ? 'selected' : ' ') + '>Greece</option>';
		html += '<option value="Greenland" ' +(json_data.user_detail[i].country == "Greenland" ? 'selected' : ' ') + '>Greenland</option>';
		html += '<option value="Grenada" ' +(json_data.user_detail[i].country == "Grenada" ? 'selected' : ' ') + '>Grenada</option>';
		html += '<option value="Guadeloupe" ' +(json_data.user_detail[i].country == "Guadeloupe" ? 'selected' : ' ') + '>Guadeloupe</option>';
		html += '<option value="Guam" ' +(json_data.user_detail[i].country == "Guam" ? 'selected' : ' ') + '>Guam</option>';
		html += '<option value="Guatemala" ' +(json_data.user_detail[i].country == "Guatemala" ? 'selected' : ' ') + '>Guatemala</option>';
		html += '<option value="Guinea" ' +(json_data.user_detail[i].country == "Guinea" ? 'selected' : ' ') + '>Guinea</option>';
		html += '<option value="Guinea-Bissau" ' +(json_data.user_detail[i].country == "Guinea-Bissau" ? 'selected' : ' ') + '>Guinea-Bissau</option>';
		html += '<option value="Guyana" ' +(json_data.user_detail[i].country == "Guyana" ? 'selected' : ' ') + '>Guyana</option>';
		html += '<option value="Haiti"  ' +(json_data.user_detail[i].country == "Haiti"  ? 'selected' : ' ') + '>Haiti</option>';
		html += '<option value="Austria" ' +(json_data.user_detail[i].country == "Austria" ? 'selected' : ' ') + '>Austria</option>';
		html += '<option value="Heard And Mc Donald Islands" ' +(json_data.user_detail[i].country == "Heard And Mc Donald Islands" ? 'selected' : ' ') + '>Heard And Mc Donald Islands</option>';
		html += '<option value="Holy See (Vatican City State)" ' +(json_data.user_detail[i].country == "Holy See (Vatican City State)" ? 'selected' : ' ') + '>Holy See (Vatican City State)</option>';
		html += '<option value="Honduras" ' +(json_data.user_detail[i].country == "Honduras" ? 'selected' : ' ') + '>Honduras</option>';
		html += '<option value="Hong Kong"' +(json_data.user_detail[i].country == "Hong Kong" ? 'selected' : ' ') + '>Hong Kong</option>';
		html += '<option value="Hungary" ' +(json_data.user_detail[i].country == "Hungary" ? 'selected' : ' ') + '>Hungary</option>';
		html += '<option value="Iceland" ' +(json_data.user_detail[i].country == "Iceland" ? 'selected' : ' ') + '>Iceland</option>';
		html += '<option value="India" ' +(json_data.user_detail[i].country == "India" ? 'selected' : ' ') + '>India</option>';
		html += '<option value="Indonesia" ' +(json_data.user_detail[i].country == "Indonesia" ? 'selected' : ' ') + '>Indonesia</option>';
		html += '<option value="Iran" ' +(json_data.user_detail[i].country == "Iran" ? 'selected' : ' ') + '>Iran</option>';
		html += '<option value="Iraq"  ' +(json_data.user_detail[i].country == "Iraq"  ? 'selected' : ' ') + '>Iraq</option>';
		html += '<option value="Ireland" ' +(json_data.user_detail[i].country == "Ireland" ? 'selected' : ' ') + '>Ireland</option>';
		html += '<option value="Israel" ' +(json_data.user_detail[i].country == "Israel" ? 'selected' : ' ') + '>Israel</option>';
		html += '<option value="Italy" ' +(json_data.user_detail[i].country == "Italy" ? 'selected' : ' ') + '>Italy</option>';
		html += '<option value="Jamaica" ' +(json_data.user_detail[i].country == "Jamaica" ? 'selected' : ' ') + '>Jamaica</option>';
		html += '<option value="Japan" ' +(json_data.user_detail[i].country == "Japan" ? 'selected' : ' ') + '>Japan</option>';
		html += '<option value="Jordan" ' +(json_data.user_detail[i].country == "Jordan" ? 'selected' : ' ') + '>Jordan</option>';
		html += '<option value="Kazakhstan" ' +(json_data.user_detail[i].country == "Kazakhstan" ? 'selected' : ' ') + '>"Kazakhstan"</option>';
		html += '<option value="Kenya" ' +(json_data.user_detail[i].country == "Kenya" ? 'selected' : ' ') + '>Kenya</option>';
		html += '<option value="Kiribati" ' +(json_data.user_detail[i].country == "Kiribati" ? 'selected' : ' ') + '>Kiribati</option>';
		html += '<option value="Korea, Democratic People\'s Republic" ' +(json_data.user_detail[i].country == "Korea, Democratic People\'s Republic" ? 'selected' : ' ') + '>Korea, Democratic People\'s Republic</option>';
		html += '<option value="Korea, Republic Of" ' +(json_data.user_detail[i].country == "Korea, Republic Of" ? 'selected' : ' ') + '>Korea, Republic Of</option>';
		html += '<option value="Kuwait" ' +(json_data.user_detail[i].country == "Kuwait" ? 'selected' : ' ') + '>Kuwait</option>';
		html += '<option value="Kyrgyzstan"' +(json_data.user_detail[i].country == "Kyrgyzstan" ? 'selected' : ' ') + '>Kyrgyzstan</option>';
		html += '<option value="Lao People\'s Dem Republic" ' +(json_data.user_detail[i].country == "Lao People\'s Dem Republic" ? 'selected' : ' ') + '>Lao People\'s Dem Republic</option>';
		html += '<option value="Latvia" ' +(json_data.user_detail[i].country == "Latvia" ? 'selected' : ' ') + '>Latvia</option>';
		html += '<option value="Lebanon"  ' +(json_data.user_detail[i].country == "Lebanon"  ? 'selected' : ' ') + '>Lebanon</option>';
		html += '<option value="Lesotho" ' +(json_data.user_detail[i].country == "Lesotho" ? 'selected' : ' ') + '>Lesotho</option>';
		html += '<option value="Libyan Arab Jamahiriya" ' +(json_data.user_detail[i].country == "Libyan Arab Jamahiriya" ? 'selected' : ' ') + '>Libyan Arab Jamahiriya</option>';
		html += '<option value="Liechtenstein" ' +(json_data.user_detail[i].country == "Liechtenstein" ? 'selected' : ' ') + '>Liechtenstein</option>';
		html += '<option value="Lithuania" ' +(json_data.user_detail[i].country == "Lithuania" ? 'selected' : ' ') + '>Lithuania</option>';
		html += '<option value="Luxembourg"' +(json_data.user_detail[i].country == "Luxembourg"? 'selected' : ' ') + '>Luxembourg</option>';
		html += '<option value="Macau" ' +(json_data.user_detail[i].country == "Macau"? 'selected' : ' ') + '>Macau</option>';
		html += '<option value="Macedonia" ' +(json_data.user_detail[i].country == "Macedonia" ? 'selected' : ' ') + '>Macedonia</option>';
		html += '<option value="Madagascar" ' +(json_data.user_detail[i].country == "Madagascar" ? 'selected' : ' ') + '>Madagascar</option>';
		html += '<option value="Malawi" ' +(json_data.user_detail[i].country == "Malawi" ? 'selected' : ' ') + '>Malawi</option>';
		html += '<option value="Malaysia" ' +(json_data.user_detail[i].country == "Malaysia" ? 'selected' : ' ') + '>Malaysia</option>';
		html += '<option value="Maldives"  ' +(json_data.user_detail[i].country == "Maldives"  ? 'selected' : ' ') + '>Maldives</option>';
		html += '<option value="Mali" ' +(json_data.user_detail[i].country == "Mali" ? 'selected' : ' ') + '>Mali</option>';
		html += '<option value="Malta" ' +(json_data.user_detail[i].country == "Malta" ? 'selected' : ' ') + '>Malta</option>';
		html += '<option value="Marshall Islands" ' +(json_data.user_detail[i].country == "Marshall Islands" ? 'selected' : ' ') + '>Marshall Islands</option>';
		html += '<option value="Martinique" ' +(json_data.user_detail[i].country == "Martinique" ? 'selected' : ' ') + '>Martinique</option>';
		html += '<option value="Mauritania" ' +(json_data.user_detail[i].country == "Mauritania" ? 'selected' : ' ') + '>Mauritania>';
		html += '<option value="Mauritius" ' +(json_data.user_detail[i].country == "Mauritius" ? 'selected' : ' ') + '>Mauritius</option>';
		html += '<option value="Mayotte" ' +(json_data.user_detail[i].country == "Mayotte" ? 'selected' : ' ') + '>"Mayotte"</option>';
		html += '<option value="Mexico" ' +(json_data.user_detail[i].country == "Mexico" ? 'selected' : ' ') + '>Mexico</option>';
		html += '<option value="Micronesia, Federated States" ' +(json_data.user_detail[i].country == "Micronesia, Federated States" ? 'selected' : ' ') + '>Micronesia, Federated States</option>';
		html += '<option value="Moldova, Republic Of" ' +(json_data.user_detail[i].country == "Moldova, Republic Of" ? 'selected' : ' ') + '>Moldova, Republic Of</option>';
		html += '<option value="Monaco" ' +(json_data.user_detail[i].country == "Monaco" ? 'selected' : ' ') + '>Monaco</option>';
		html += '<option value="Mongolia"' +(json_data.user_detail[i].country == "Mongolia" ? 'selected' : ' ') + '>Mongolia</option>';
		html += '<option value="Montserrat" ' +(json_data.user_detail[i].country == "Montserrat" ? 'selected' : ' ') + '>Montserrat</option>';
		html += '<option value="Morocco" ' +(json_data.user_detail[i].country == "Morocco" ? 'selected' : ' ') + '>Morocco</option>';
		html += '<option value="Mozambique" ' +(json_data.user_detail[i].country == "Mozambique" ? 'selected' : ' ') + '>Mozambique</option>';
		html += '<option value="Myanmar" ' +(json_data.user_detail[i].country == "Myanmar" ? 'selected' : ' ') + '>Myanmar</option>';
		html += '<option value="Namibia"' +(json_data.user_detail[i].country == "Namibia"? 'selected' : ' ') + '>Namibia</option>';
		html += '<option value="Nauru" ' +(json_data.user_detail[i].country == "Nauru"? 'selected' : ' ') + '>Nauru</option>';
		html += '<option value="Nepal" ' +(json_data.user_detail[i].country == "Nepal" ? 'selected' : ' ') + '>Nepal</option>';
		html += '<option value="Netherlands" ' +(json_data.user_detail[i].country == "Netherlands" ? 'selected' : ' ') + '>Netherlands</option>';
		html += '<option value="Netherlands Ant Illes" ' +(json_data.user_detail[i].country == "Netherlands Ant Illes" ? 'selected' : ' ') + '>Netherlands Ant Illes</option>';
		html += '<option value="New Caledonia" ' +(json_data.user_detail[i].country == "New Caledonia" ? 'selected' : ' ') + '>New Caledonia</option>';
		html += '<option value="Maldives"  ' +(json_data.user_detail[i].country == "Maldives"  ? 'selected' : ' ') + '>Maldives</option>';
		html += '<option value="New Zealand"' +(json_data.user_detail[i].country == "New Zealand"? 'selected' : ' ') + '>New Zealand</option>';
		html += '<option value="Nicaragua" ' +(json_data.user_detail[i].country == "Nicaragua" ? 'selected' : ' ') + '>Nicaragua</option>';
		html += '<option value="Niger" ' +(json_data.user_detail[i].country == "Niger" ? 'selected' : ' ') + '>Niger</option>';
		html += '<option value="Nigeria" ' +(json_data.user_detail[i].country == "Nigeria" ? 'selected' : ' ') + '>Nigeria</option>';
		html += '<option value="Niue" ' +(json_data.user_detail[i].country == "Niue" ? 'selected' : ' ') + '>Niue>';
		html += '<option value="Norfolk Island" ' +(json_data.user_detail[i].country == "Norfolk Island" ? 'selected' : ' ') + '>Norfolk Island</option>';
		html += '<option value="Northern Mariana Islands" ' +(json_data.user_detail[i].country == "Northern Mariana Islands" ? 'selected' : ' ') + '>Northern Mariana Islands</option>';
		html += '<option value="Norway" ' +(json_data.user_detail[i].country == "Norway" ? 'selected' : ' ') + '>Norway</option>';
		html += '<option value="Oman" ' +(json_data.user_detail[i].country == "Oman" ? 'selected' : ' ') + '>Oman</option>';
		html += '<option value="Pakistan" ' +(json_data.user_detail[i].country == "Pakistan" ? 'selected' : ' ') + '>Pakistan</option>';
		html += '<option value="Palau" ' +(json_data.user_detail[i].country == "Palau" ? 'selected' : ' ') + '>Palau</option>';
		html += '<option value="Panama"' +(json_data.user_detail[i].country == "Panama" ? 'selected' : ' ') + '>Panama</option>';
		html += '<option value="Papua New Guinea" ' +(json_data.user_detail[i].country == "Papua New Guinea" ? 'selected' : ' ') + '>Papua New Guinea</option>';
		html += '<option value="Paraguay" ' +(json_data.user_detail[i].country == "Paraguay" ? 'selected' : ' ') + '>Paraguay</option>';
		html += '<option value="Peru" ' +(json_data.user_detail[i].country == "Peru" ? 'selected' : ' ') + '>Peru</option>';
		html += '<option value="Philippines" ' +(json_data.user_detail[i].country == "Philippines" ? 'selected' : ' ') + '>Philippines</option>';
		html += '<option value="Pitcairn" ' +(json_data.user_detail[i].country == "Pitcairn" ? 'selected' : ' ') + '>Pitcairn</option>';
		html += '<option value="Poland"' +(json_data.user_detail[i].country == "Poland" ? 'selected' : ' ') + '>Poland</option>';
		html += '<option value="Portugal" ' +(json_data.user_detail[i].country == "Portugal" ? 'selected' : ' ') + '>Portugal</option>';
		html += '<option value="Puerto Rico" ' +(json_data.user_detail[i].country == "Puerto Rico" ? 'selected' : ' ') + '>Puerto Rico</option>';
		html += '<option value="Qatar" ' +(json_data.user_detail[i].country == "Qatar" ? 'selected' : ' ') + '>Qatar</option>';
		html += '<option value="Reunion" ' +(json_data.user_detail[i].country == "Reunion" ? 'selected' : ' ') + '>Reunion</option>';
		html += '<option value="Romania"' +(json_data.user_detail[i].country == "Romania"? 'selected' : ' ') + '>Romania</option>';
		html += '<option value="Russian Federation" ' +(json_data.user_detail[i].country == "Russian Federation"? 'selected' : ' ') + '>Russian Federation</option>';
		html += '<option value="Rwanda" ' +(json_data.user_detail[i].country == "Rwanda" ? 'selected' : ' ') + '>Rwanda</option>';
		html += '<option value="Saint K Itts And Nevis" ' +(json_data.user_detail[i].country == "Saint K Itts And Nevis" ? 'selected' : ' ') + '>Saint K Itts And Nevis</option>';
		html += '<option value="Saint Lucia" ' +(json_data.user_detail[i].country == "Saint Lucia" ? 'selected' : ' ') + '>Saint Lucia</option>';
		html += '<option value="Saint Vincent, The Grenadines" ' +(json_data.user_detail[i].country == "Saint Vincent, The Grenadines" ? 'selected' : ' ') + '>Saint Vincent, The Grenadines</option>';
		html += '<option value="Samoa"  ' +(json_data.user_detail[i].country == "Samoa"  ? 'selected' : ' ') + '>Samoa</option>';
		html += '<option value="San Marino"' +(json_data.user_detail[i].country == "San Marino"? 'selected' : ' ') + '>San Marino</option>';
		html += '<option value="Sao Tome And Principe" ' +(json_data.user_detail[i].country == "Sao Tome And Principe" ? 'selected' : ' ') + '>Sao Tome And Principe</option>';
		html += '<option value="Saudi Arabia" ' +(json_data.user_detail[i].country == "Saudi Arabia" ? 'selected' : ' ') + '>Saudi Arabia</option>';
		html += '<option value="Senegal" ' +(json_data.user_detail[i].country == "Senegal" ? 'selected' : ' ') + '>Senegal</option>';
		html += '<option value="Seychelles" ' +(json_data.user_detail[i].country == "Seychelles" ? 'selected' : ' ') + '>"Seychelles"</option>';
		html += '<option value="Sierra Leone" ' +(json_data.user_detail[i].country == "Sierra Leone" ? 'selected' : ' ') + '>Sierra Leone</option>';
		html += '<option value="Singapore" ' +(json_data.user_detail[i].country == "Singapore" ? 'selected' : ' ') + '>Singapore</option>';
		html += '<option value="Slovakia (Slovak Republic)" ' +(json_data.user_detail[i].country == "Slovakia (Slovak Republic)" ? 'selected' : ' ') + '>Slovakia (Slovak Republic)</option>';
		html += '<option value="Slovenia" ' +(json_data.user_detail[i].country == "Slovenia" ? 'selected' : ' ') + '>Slovenia</option>';
		html += '<option value="Solomon Islands" ' +(json_data.user_detail[i].country == "Solomon Islands" ? 'selected' : ' ') + '>Solomon Islands</option>';
		html += '<option value="Somalia"' +(json_data.user_detail[i].country == "Somalia" ? 'selected' : ' ') + '>Somalia</option>';
		html += '<option value="South Africa" ' +(json_data.user_detail[i].country == "South Africa" ? 'selected' : ' ') + '>South Africa</option>';
		html += '<option value="South Georgia , S Sandwich Is." ' +(json_data.user_detail[i].country == "South Georgia , S Sandwich Is." ? 'selected' : ' ') + '>South Georgia , S Sandwich Is.</option>';
		html += '<option value="Spain" ' +(json_data.user_detail[i].country == "Spain" ? 'selected' : ' ') + '>Spain</option>';
		html += '<option value="Sri Lanka" ' +(json_data.user_detail[i].country == "Sri Lanka" ? 'selected' : ' ') + '>Sri Lanka</option>';
		html += '<option value="St. Helena" ' +(json_data.user_detail[i].country == "St. Helena" ? 'selected' : ' ') + '>St. Helena</option>';
		html += '<option value="St. Pierre And Miquelon" ' +(json_data.user_detail[i].country == "St. Pierre And Miquelon" ? 'selected' : ' ') + '>St. Pierre And Miquelon</option>';
		html += '<option value="Sudan"' +(json_data.user_detail[i].country == "Sudan" ? 'selected' : ' ') + '>Sudan</option>';
		html += '<option value="Suriname" ' +(json_data.user_detail[i].country == "Suriname" ? 'selected' : ' ') + '>Suriname</option>';
		html += '<option value="Svalbard, Jan Mayen Islands" ' +(json_data.user_detail[i].country == "Svalbard, Jan Mayen Islands" ? 'selected' : ' ') + '>Svalbard, Jan Mayen Islands</option>';
		html += '<option value="Sw Aziland" ' +(json_data.user_detail[i].country == "Sw Aziland" ? 'selected' : ' ') + '>Sw Aziland</option>';
		html += '<option value="Sweden" ' +(json_data.user_detail[i].country == "Sweden" ? 'selected' : ' ') + '>Sweden</option>';
		html += '<option value="Syrian Arab Republic"' +(json_data.user_detail[i].country == "Syrian Arab Republic"? 'selected' : ' ') + '>Syrian Arab Republic</option>';
		html += '<option value="Taiwan" ' +(json_data.user_detail[i].country == "Taiwan"? 'selected' : ' ') + '>Taiwan</option>';
		html += '<option value="Tajikistan" ' +(json_data.user_detail[i].country == "Tajikistan" ? 'selected' : ' ') + '>Tajikistan</option>';
		html += '<option value="Tanzania, United Republic Of" ' +(json_data.user_detail[i].country == "Tanzania, United Republic Of" ? 'selected' : ' ') + '>Tanzania, United Republic Of</option>';
		html += '<option value="Thailand" ' +(json_data.user_detail[i].country == "Thailand" ? 'selected' : ' ') + '>Thailand</option>';
		html += '<option value="Togo" ' +(json_data.user_detail[i].country == "Togo" ? 'selected' : ' ') + '>Togo</option>';
		html += '<option value="Tokelau" ' +(json_data.user_detail[i].country == "Tokelau"  ? 'selected' : ' ') + '>Tokelau</option>';
		html += '<option value="Tonga"' +(json_data.user_detail[i].country == "Tonga"? 'selected' : ' ') + '>Tonga</option>';
		html += '<option value="Trinidad And Tobago" ' +(json_data.user_detail[i].country == "Trinidad And Tobago" ? 'selected' : ' ') + '>Trinidad And Tobago</option>';
		html += '<option value="Tunisia" ' +(json_data.user_detail[i].country == "Tunisia" ? 'selected' : ' ') + '>Tunisia</option>';
		html += '<option value="Turkey" ' +(json_data.user_detail[i].country == "Turkey" ? 'selected' : ' ') + '>Turkey</option>';
		html += '<option value="Turkmenistan"  ' +(json_data.user_detail[i].country == "Turkmenistan"  ? 'selected' : ' ') + '>Turkmenistan</option>';
		html += '<option value="Turks And Caicos Islands" ' +(json_data.user_detail[i].country == "Turks And Caicos Islands" ? 'selected' : ' ') + '>Turks And Caicos Islands</option>';
		html += '<option value="Tuvalu" ' +(json_data.user_detail[i].country == "Tuvalu" ? 'selected' : ' ') + '>Tuvalu</option>';
		html += '<option value="Uganda" ' +(json_data.user_detail[i].country == "Uganda" ? 'selected' : ' ') + '>Uganda</option>';
		html += '<option value="Ukraine" ' +(json_data.user_detail[i].country == "Ukraine" ? 'selected' : ' ') + '>Ukraine</option>';
		html += '<option value="United Arab Emirates" ' +(json_data.user_detail[i].country == "United Arab Emirates" ? 'selected' : ' ') + '>United Arab Emirates</option>';
		html += '<option value="United Kingdom"' +(json_data.user_detail[i].country == "United Kingdom" ? 'selected' : ' ') + '>United Kingdom</option>';
		html += '<option value="United States" ' +(json_data.user_detail[i].country == "United States" ? 'selected' : ' ') + '>United States</option>';
		html += '<option value="United States Minor Is." ' +(json_data.user_detail[i].country == "United States Minor Is." ? 'selected' : ' ') + '>United States Minor Is.</option>';
		html += '<option value="Uruguay" ' +(json_data.user_detail[i].country == "Uruguay" ? 'selected' : ' ') + '>Uruguay</option>';
		html += '<option value="Uzbekistan" ' +(json_data.user_detail[i].country == "Uzbekistan"  ? 'selected' : ' ') + '>Uzbekistan</option>';
		html += '<option value="Vanuatu"' +(json_data.user_detail[i].country == "Vanuatu"? 'selected' : ' ') + '>Vanuatu</option>';
		html += '<option value="Venezuela" ' +(json_data.user_detail[i].country == "Venezuela" ? 'selected' : ' ') + '>Venezuela</option>';
		html += '<option value="Vietnam" ' +(json_data.user_detail[i].country == "Vietnam" ? 'selected' : ' ') + '>Vietnam</option>';
		html += '<option value="Virgin Islands (British)" ' +(json_data.user_detail[i].country == "Virgin Islands (British)" ? 'selected' : ' ') + '>Virgin Islands (British)</option>';
		html += '<option value="Virgin Islands (U.S.)"  ' +(json_data.user_detail[i].country == "Virgin Islands (U.S.)"  ? 'selected' : ' ') + '>Virgin Islands (U.S.)</option>';
		html += '<option value="Wallis And Futuna Islands" ' +(json_data.user_detail[i].country == "Wallis And Futuna Islands" ? 'selected' : ' ') + '>Wallis And Futuna Islands</option>';
		html += '<option value="Western Sahara" ' +(json_data.user_detail[i].country == "Western Sahara" ? 'selected' : ' ') + '>Western Sahara</option>';
		html += '<option value="Yemen" ' +(json_data.user_detail[i].country == "Yemen" ? 'selected' : ' ') + '>Yemen</option>';
		html += '<option value="Zaire" ' +(json_data.user_detail[i].country == "Zaire" ? 'selected' : ' ') + '>Zaire</option>';
		html += '<option value="Zambia" ' +(json_data.user_detail[i].country == "Zambia" ? 'selected' : ' ') + '>Zambia</option>';
		html += '<option value="Zimbabwe"' +(json_data.user_detail[i].country == "Zimbabwe" ? 'selected' : ' ') + '>Zimbabwe</option>';
                html += '</select>';
        html += '<label for="phone"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>Phone: </label><span id="phn_msg" style="font-family:Arial;font-size:13px;color:#cc0000;"><?php echo form_individual_error("phone"); ?></span><input type="text" id="phone" name="phone" placeholder="Phone" value="'+json_data.user_detail[i].phone+'"/>';
        html += '<label for="add1"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>Address Line 1: </label><span id="add1_msg" style="font-family:Arial;font-size:13px;color:#cc0000;"><?php echo form_individual_error("add1"); ?></span><input type="text" id="add1" name="add1" placeholder="Address Line 1" value="'+json_data.user_detail[i].address_1+'"/>';
        html += '<label for="add2">Address Line 2: (Optional) </label><input type="text" id="add2" name="add2" placeholder="Address Line 2" value="'+json_data.user_detail[i].address_2+'"/>';
        html += '<label for="state"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>State: </label><span id="state_msg" style="font-family:Arial;font-size:13px;color:#cc0000;"><?php echo form_individual_error("state"); ?></span><input type="text" id="state" name="state" placeholder="State" value="'+json_data.user_detail[i].state+'"/>';
        html += '<label for="suburb"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>Suburb: </label><span id="suburb_msg" style="font-family:Arial;font-size:13px;color:#cc0000;"><?php echo form_individual_error("suburb"); ?></span><input type="text" id="suburb" name="suburb" placeholder="Suburb" value="'+json_data.user_detail[i].suburb+'"/>';
        html += '<label for="postcode"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>Postcode: </label><span id="postcode_msg" style="font-family:Arial;font-size:13px;color:#cc0000;"></span><input type="text" id="postcode" name="postcode" placeholder="Postcode" value="'+json_data.user_detail[i].post_code+'"/>';
        html += '<input type="submit" id="update_cont" name="update_cont" value="Update" onclick="updateContactDetail();"/>';
        html += '<i class="fa fa-spinner fa-spin fa-2x fa-fw" style="vertical-align:middle;visibility:hidden;" id="con_loader"></i>';
        html += '</div>';
    }
    return html;
}

function updateContactDetail()
{
    if(validateContact() == true)
    {
        var phone = $("#phone").val();
        var country = $("#country").val();
        var add1 = $("#add1").val();
        var add2 = $("#add2").val();
        var state = $("#state").val();
        var suburb = $("#suburb").val();
        var postcode = $("#postcode").val();
        
        $.ajax({
            type: "POST", 
            url: "http://localhost/fortunefx/ajaxservice/userdetails", 
            data: {phone: phone, country: country, address_1: add1, address_2: add2, state: state, suburb: suburb, postcode: postcode},
            beforeSend: function(){
                $("#con_loader").css("visibility", "visible");
            }, 
            success: function(data){
                $("#con_loader").css("visibility", "hidden");
                if(data.response.status == "success")
                {
                    $("#contact_panel").fadeOut(200, displayContactPanel);
                }
            }
        });
    }
}

function updateCardDetails(event)
{
    event.preventDefault();
    if(validateStep3(event) == true)
    {
    var card_type = $("#card_type").val();
    var card_name = $("#holder_name").val();
    var card_num = $("#card_number").val();
    var ccv = $("#ccv").val();
    var expiry = $("#expiry").val();
    
    $.ajax({
        type: "POST",
        url: "http://localhost/fortunefx/ajaxservice/carddetails", 
        data: {card_type: card_type, holder_name: card_name, card_number: card_num, ccv: ccv, expiry: expiry},
        beforeSend: function(){
            $(".fa-spinner").css("visibility", "visible");
        },
        success: function(data){
            //alert(JSON.stringify(data));
            $(".fa-spinner").css("visibility", "hidden");
            if(data.response.status == "failed")
            {
                $(".err_msg").html("<span style='font-family:Arial;color:#cc0000;font-size:13px;border:1px solid #eaeaea;padding:10px;background:#f2f2f2;'>Error! " + data.response.error.desc + "</span>");
            }
            else
            {
            $(".card_panel").fadeOut(200, displayToCardPanel);
        }
        }
    });
    }
}

function showEditPanel()
{
   // eval('var card = new Card({form: "form", container: ".card_viewer", formSelectors: {numberInput: "input#card_number",expiryInput: "input#expiry",cvcInput: "input#ccv",nameInput: "input#holder_name"}, formatting:true});');
    $.ajax({
        type: "GET", 
        url: "http://localhost/fortunefx/ajaxservice/carddetails",
        success: function(data)
        {
            $(".card_panel").html(showCardEditPanel(data)).fadeIn();
            $("#close_btn").css("display", "inline");
            $("#card_edit_btn").css("display", "none");
        }   
    });
}

function displayToCardPanel()
{
    $.ajax({
        type: "GET", 
        url: "http://localhost/fortunefx/ajaxservice/carddetails",
        
        success: function(data)
        {
            $(".card_panel").html(getCardDetailHtml(data)).fadeIn();
            $("#close_btn").css("display", "none");
            $("#card_edit_btn").css("display", "inline");
        }   
    });
}

function getCardDetailHtml(json_data)
{
    var i;
    var html = "";
    var data_length = json_data.card.length;
    
    for(i = 0; i < data_length; i++)
    {
    html += '<table>';
    html += '<tr><td><strong>Card Type: </strong></td><td><i class="fa fa-cc-'+json_data.card[i].card_type+' fa-2x" aria-hidden="true"></i></td></tr>';
    html += '<tr><td><strong>Card Holder Name: </strong></td><td>'+json_data.card[i].card_holder_name+'</td></tr>';
    html += '<tr><td><strong>Card Number: </strong></td><td>'+json_data.card[i].card_number+'</td></tr>';
    html += '<tr><td><strong>CVV: </strong></td><td>'+json_data.card[i].ccv+'</td></tr>';
    html += '<tr><td><strong>Expiry: </strong></td><td>'+json_data.card[i].expiry+'</td></tr>'
    html += '</table>';
    }
    
    return html;
}

function showCardEditPanel(json_data)
{
    var i;
    var html = "";
    var data_length = json_data.card.length;
    for(i = 0; i < data_length; i++)
    {
        
        html += '<div class="form_panel">';
        html += '<h4 style="font-family:Arial;color:#333333;">We Accept</h4>';
        html += '<i class="fa fa-cc-mastercard fa-2x" aria-hidden="true"></i>&nbsp;';
        html += '<i class="fa fa-cc-visa fa-2x" aria-hidden="true"></i>&nbsp;';
        html += '<i class="fa fa-cc-amex fa-2x" aria-hidden="true"></i>&nbsp;';
        html += '<i class="fa fa-cc-discover fa-2x" aria-hidden="true"></i>&nbsp;<br/><br/>';
        html += '<form method="post">';
        html += '<label for="card_type"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>Card Type: </label><span id="card_type_msg" style="font-family:Arial;font-size:13px;color:#cc0000;"></span>';
        html += '<select id="card_type" name="card_type">';
        html += '<option value="">Select Card Type</option>';
        html += '<option value="mastercard" ' +(json_data.card[i].card_type == "mastercard" ? 'selected' : ' ') + '>MasterCard</option>';
        html += '<option value="visa" ' +(json_data.card[i].card_type == "visa" ? 'selected' : ' ') + '>Visa</option>';
        html += '<option value="amex" ' +(json_data.card[i].card_type == "amex" ? 'selected' : ' ') + '>American Express</option>';
        html += '<option value="discover" ' +(json_data.card[i].card_type == "discover" ? 'selected' : ' ') + '>Discover</option>';
        html += '</select>';
        html += '<label for="holder_name"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>Card Holder\'s Name: </label><span id="holder_name_msg" style="font-family:Arial;font-size:13px;color:#cc0000;"></span><input type="text" id="holder_name" name="holder_name" placeholder="Card Holder\'s Name" value="'+json_data.card[i].card_holder_name+'"/>';
        html += '<label for="card_number"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>Card Number: </label><span id="card_number_msg" style="font-family:Arial;font-size:13px;color:#cc0000;"></span><input type="text" id="card_number" name="card_number" placeholder="Card Number" value="'+json_data.card[i].card_number+'"/>';
        html += '<label for="ccv"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>CCV: </label><span id="ccv_msg" style="font-family:Arial;font-size:13px;color:#cc0000;"></span><input type="text" id="ccv" name="ccv" placeholder="CCV" value="'+json_data.card[i].ccv+'"/>';
        html += '<label for="expiry"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>Expiry: </label><span id="expiry_msg" style="font-family:Arial;font-size:13px;color:#cc0000;"></span><input type="text" id="expiry" name="expiry" placeholder="MM/YYYY" value="'+json_data.card[i].expiry+'"/>';
        html += '<input type="submit" id="update_card" name="update_card" value="Update" onclick="updateCardDetails(event);"/>';
        html += '<i class="fa fa-spinner fa-spin fa-2x fa-fw" style="vertical-align:middle;visibility:hidden;"></i>';
        html += '</form>';
        html += '<div class="err_msg" style="padding-bottom:10px;"></div>';
        html += '</div>';
    }
    return html;
}