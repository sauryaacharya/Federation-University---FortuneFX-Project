$(document).ready(function(){
    
    $("#email_id").keyup(function(){
        
        
        var email = $("#email_id").val();
        if(isValidEmail(email))
        {
        $.ajax({
            type: "GET", 
            url: "http://localhost/fortunefx/ajaxservice/checkUserNameAvailability/"+email,
            beforeSend: function(){
                
            },
            success: function(data){
                if(data["error"] == 1)
                {
                    setError("#email_msg", "#email_id", "Email not available.");
                }
                else if(data["error"] == 0)
                {
                    setValidSign("#email_msg", "#email_id");
                }
            }
        });
    }
    else
    {
        setError("#email_msg", "#email_id", "Not a valid email.");
    }
    
    if($("#email_id").val() == "")
    {
        setValidSign("#email_msg", "#email_id", "Email available");
    }
        
    });
    
    $("#step1_form").submit(function(event){
        validateStep1(event);
    });
    
    $("#step2_form").submit(function(event){
        validateStep2(event);
    });
    
    $("#step3_form").submit(function(event){
        validateStep3(event); 
    });
    
    $("#contact_form_form").submit(function(event){
       validateContactForm(event); 
    });
    
    $("#pass_recovery_form").submit(function(event){
       validateRecoveryForm(event); 
    });
    
    $("#phone").keydown(function(e){
        if(e.keyCode == 8 || e.keyCode == 107 || (e.keyCode >= 96 && e.keyCode <= 104) || (e.keyCode >= 48 && e.keyCode <= 57))
       {
           return true;
       }
       return false; 
    });
});

function isValidEmail(email)
{
    //var valid = true;
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(!filter.test(email))
    {
        return false;
    }
    else
    {
        return true;
    }
}

function isValidPassword(password)
{
    var filter = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/;
    if(!filter.test(password))
    {
        return false;
    }
    else
    {
        return true;
    }
}

function checkDate(dob, event)
{
    //var valid = true;
    var dob_arr = dob.split("/");
    if(dob_arr.length != 3)
    {
        setError("#dob_msg", "#dob", "Please enter a valid date.");
        event.preventDefault();
        return false;
    }
    else
    {
    //alert(dob_arr[0] + dob_arr[1] + dob_arr[2]);
    $.ajax({
       type: "POST", 
       url: "http://localhost/fortunefx/ajaxservice/checkDate/"+encodeURI(dob_arr[0])+"/"+encodeURI(dob_arr[1])+"/"+encodeURI(dob_arr[2]),
       beforeSend: function(){
           
       }, 
       success: function(data){
           if(data.error != "null")
           {
            setError("#dob_msg", "#dob", "Please enter a valid date.");
            event.preventDefault();
            return false;
        }
       }
    });
    }
    return true;
}

function validateStep1(event)
{
        var first_name = $("#first_name").val();
        var last_name = $("#last_name").val();
        var dob = $("#dob").val();
        var phone = $("#phone").val();
        var country = $("#country").val();
        var add1 = $("#add1").val();
        var state = $("#state").val();
        var suburb = $("#suburb").val();
        var postcode = $("#postcode").val();
        
        var error_free = true;
        if(first_name == "")
        {
            setError("#f_name_msg", "#first_name", "Please enter the firstname.");
            error_free = false;
        }
        else
        {
            setValidSign("#f_name_msg", "#first_name");
        }
        
        if(last_name == "")
        {
            setError("#l_name_msg", "#last_name", "Please enter the lastname");
            error_free = false;
        }
        else
        {
            setValidSign("#l_name_msg", "#last_name");
        }
        if(dob == "")
        {
            setError("#dob_msg", "#dob", "Please enter the date of birth");
            error_free = false;
        }
        else
        {
            if(checkDate(dob, event))
            {
                setValidSign("#dob_msg", "#dob");
            }
        }
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
        if(!error_free)
        {
            $("#step_msg").css({"font-family":"Arial", "font-size":"14px", "background":"#f2f2f2", "color":"#cc0000", "border":"1px solid #eaeaea", "padding":"10px"});
            $("#step_msg").html("You have error in your input. Please check the input above.");
            event.preventDefault();
        }
        return error_free;
}

function validateStep2(event)
{
        var email = $("#email_id").val();
        var password = $("#password").val();
        var confirm_password = $("#confirm_password").val();
        var security_question = $("#security_question").val();
        var answer = $("#answer").val();
        var old_password = $("#old_password").val();
        
        var error_free = true;
        
        if(email == "")
        {
            $("#email_msg").html("Please enter the email.");
            $("#email_id").css("border", "2px solid #cc0000");
            error_free = false;
        }
        else
        {
            if(!isValidEmail(email))
            {
                $("#email_msg").html("Please enter a valid email.");
                $("#email_id").css("border", "2px solid #cc0000");
                error_free = false;
            }
        }
        
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
            setValidSign("#old_password_msg", "#old_password");
        }
        if(security_question == "")
        {
            $("#sec_q_msg").html("Please select the security question.");
            $("#security_question").css("border", "2px solid #cc0000");
            error_free = false;  
        }
        if(answer == "")
        {
            $("#ans_msg").html("Please enter the security answer.");
            $("#answer").css("border", "2px solid #cc0000");
            error_free = false; 
        }
        if(!error_free)
        {
            $("#step_msg").css({"font-family":"Arial", "font-size":"14px", "background":"#f2f2f2", "color":"#cc0000", "border":"1px solid #eaeaea", "padding":"10px"});
            $("#step_msg").html("You have error in your input. Please check the input above.");
            event.preventDefault();
        }
        return error_free;
}

function validateStep3(event)
{
    var card_type = $("#card_type").val();
    var name = $("#holder_name").val();
    var number = $("#card_number").val();
    var ccv = $("#ccv").val();
    var expiry = $("#expiry").val();
    
    var error_free = true;
    
    if(card_type == "")
    {
        setError("#card_type_msg", "#card_type", "Please select the card type.");
        error_free = false;
    }
    else
    {
        setValidSign("#card_type_msg", "#card_type");
    }
    if(name == "")
    {
        $("#holder_name_msg").html("Please enter the card holder's name.");
        $("#holder_name").css("border", "2px solid #cc0000");
        error_free = false;
    }
    if(number == "")
    {
        $("#card_number_msg").html("Please enter the card number.");
        $("#card_number").css("border", "2px solid #cc0000");
        error_free = false;
    }
    if(ccv == "")
    {
        $("#ccv_msg").html("Please enter the CCV.");
        $("#ccv").css("border", "2px solid #cc0000");
        error_free = false;
    }
    if(expiry == "")
    {
        $("#expiry_msg").html("Please enter the expiry date.");
        $("#expiry").css("border", "2px solid #cc0000");
        error_free = false;
    }
    if(!error_free)
    {
        $("#step_msg").css({"font-family":"Arial", "font-size":"14px", "background":"#f2f2f2", "color":"#cc0000", "border":"1px solid #eaeaea", "padding":"10px"});
        $("#step_msg").html("You have error in your input. Please check the input above.");
        event.preventDefault();
    }
    return error_free;
}

function validateContactForm(event)
{
    var error_free = true;
    var full_name = $("#full_name").val();
    var email = $("#email").val();
    var subject = $("#subject").val();
    var msg = $("#message").val();
    if(full_name == "")
    {
        $("#full_name_msg").html("Please enter your name.");
        $("#full_name").css("border", "2px solid #cc0000");
        error_free = false;
    }
    else
    {
        setValidSign("#full_name_msg", "#fullname");
    }
    
    if(subject == "")
    {
        $("#sub_msg").html("Please enter the subject.");
        $("#subject").css("border", "2px solid #cc0000");
        error_free = false;
    }
    else
    {
        setValidSign("#sub_msg", "#subject");
    }
    
    if(msg == "")
    {
        $("#msg_msg").html("Please enter the message.");
        $("#message").css("border", "2px solid #cc0000");
        error_free = false;
    }
    else
    {
        setValidSign("#msg_msg", "#message");
    }
    
    if(email == "")
        {
            $("#email_msg").html("Please enter the email.");
            $("#email").css("border", "2px solid #cc0000");
            error_free = false;
        }
        else
        {
            if(!isValidEmail(email))
            {
                $("#email_msg").html("Please enter a valid email.");
                $("#email").css("border", "2px solid #cc0000");
                error_free = false;
            }
            else
            {
                setValidSign("#email_msg", "#email");
            }
        }
    if(!error_free)
    {
        $("#con_msg").css({"font-family":"Arial", "font-size":"14px", "background":"#f2f2f2", "color":"#cc0000", "border":"1px solid #eaeaea", "padding":"10px"});
        $("#con_msg").html("You have error in your input. Please check the input above.");
        event.preventDefault();
    }
    
}

function validateRecoveryForm(event)
{
    var error_free = true;
    var password = $("#password").val();
    var confirm_password = $("#confirm_password").val();
    
    if(password == "")
        {
            setError("#password_msg", "#password", "Please enter the password.");
            error_free = false;
        }
        else
        {
            if(password.length < 8)
            {
                setError("#password_msg", "#password", "&nbsp;&nbsp;Please enter the password of at least 8 characters.");
                error_free = false;
            }
            
            else
            {
                if(!isValidPassword(password))
                {
                    setError("#password_msg", "#password", "&nbsp;&nbsp;Please enter the password including uppercase, lowercase and number.");
                    error_free = false;
                }
                else
                {
                    setValidSign("#password_msg", "#password");
                }
            }
           
        }
        if(confirm_password == "")
        {
            setError("#confirm_password_msg", "#confirm_password", "Please enter the confirm_password.");
            error_free = false; 
        }
        else
        {
            if(password !== confirm_password)
            {
                setError("#confirm_password_msg", "#confirm_password", "Password mismatch.");
                error_free = false; 
            }
            else
            {
                setValidSign("#confirm_password_msg", "#confirm_password");
            }
        }
        if(!error_free)
        {
            event.preventDefault();
        }
}

function setValidSign(error_selector, input_selector)
{
    $(error_selector).html("");
    $(input_selector).css("border", "2px solid #B8B8B8");
}

function setError(error_selector, input_selector, error_message)
{
    $(error_selector).html(error_message);
    $(input_selector).css("border", "2px solid #cc0000");
}