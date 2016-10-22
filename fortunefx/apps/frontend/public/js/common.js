$(document).ready(function(){
    
    $("#confirm_email_send").submit(function(event){
        sendConfirmation(event);
    });
    
});

function sendConfirmation(event)
{
    var email_id = $("#email").val();
    if(email_id == "")
    {
        setError("#email_error_msg", "#email", "<span style='color:#cc0000;'>Please enter the email address.</span>");
    }
    else if(!isValidEmail(email_id))
    {
        setError("#email_error_msg", "#email", "<span style='color:#cc0000;'>Not a valid email.</span>");
    }
    else
    {
        /*
        $.ajax({
            type: "GET", 
            url: "http://localhost/fortunefx/ajaxservice/checkUserNameAvailability/"+email_id,
            beforeSend: function(){
                
            },
            success: function(data){
                if(data["error"] == 1)
                {
                    setValidSign("#email_error_msg", "#email");
                }
                else if(data["error"] == 0)
                {
                    setError("#email_error_msg", "#email", "Email not available.");
                }
            }
        });
        **/
        $.ajax({
            type: "POST", 
            url: "http://localhost/fortunefx/ajaxservice/sendConfirmationEmail/"+email_id,
            beforeSend: function(){
                
            },
            success: function(data){
                if(data["error"] == 1)
                {
                    setError("#email_error_msg", "#email", "<span style='color:#cc0000;'>Sorry ! This email has already been activated or not in our database.</span>");
                }
                else if(data["error"] == 0)
                {
                    $("#email_error_msg").html("<span style='color:#009900;'>An email has been sent.</span>");
                    $("#email").css("border", "2px solid #B8B8B8");
                }
            }
        });
    }    
event.preventDefault();   
}