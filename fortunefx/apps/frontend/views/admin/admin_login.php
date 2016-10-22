<!DOCTYPE html>
<html>
    <head>
        <title>
            Admin Login - Fortune FX
        </title>
        <style type="text/css">
            body
            {
                background:#fcfcfc;
            }
            
            
            h1, h2, h3, h4
{
    margin:0;
    padding:0;
}
hr {
    height:1px;
    border:none;
    color:#cccccc;
    background:#cccccc;
    display:block;
}
            #ad_login_panel
{
    width:400px;
    margin:0 auto;
    padding:25px;
    background:#f8f8f8;
    border:1px solid #ddd;
    border-radius:3px;
    
}

#ad_login_panel label
{
    font-family:Arial;
    font-size:15px;
    color:#595959;
    font-weight:bold;
}

#ad_login_panel input, select
{
    margin:0px 0px 20px 0px;
}

#ad_login_panel form
{
    width:100%;
}

#email_id, #password
{
    width:100%;
    height:42px;
    border:2px solid #B8B8B8;
    font-family:Arial;
    font-size:17px;
    color:#5F5F5F;
    padding-left:5px;
    transition:all 0.3s ease-in-out;
    -moz-transition:all 0.3s ease-in-out;
    -webkit-transition:all 0.3s ease-in-out;
    -ms-transition:all 0.3s ease-in-out;
    -o-transition:all 0.3s ease-in-out;
}

#email_id:hover, #password:hover
{
    border:2px solid #216C2A;
}

#email_id:focus, #password:focus
{
    border:2px solid #1f7a7a;
    box-shadow:0px 0px 4px #1f7a7a;
}

#ad_login_btn
{
    background:#216C2A;;
    border:none;
    color:#ffffff;
    font-family:Arial;
    font-size:16px;
    width:160px;
    height:37px;
    cursor:pointer;
    border-radius:2px;
    transition:all 0.3s ease-in-out;
-moz-transition:all 0.3s ease-in-out;
-webkit-transition:all 0.3s ease-in-out;
-ms-transition:all 0.3s ease-in-out;
-o-transition:all 0.3s ease-in-out;
}

#ad_login_btn:hover
{
    background:#309c3d;
}
        </style>
    </head>
    <body>
            <br/><br/>
            <div style="width:400px;margin:0 auto;text-align:center;padding:0px 20px 0px 20px;">
                <img src="http://<?php echo ROOT_URL; ?>apps/frontend/public/images/fx_logo.png" alt="Fortune Fx" width="205" height="58" style="text-align:center;"/>
            </div>
            <div id="ad_login_panel">
                
    <h3 style="font-family:Arial;color:#333333;text-shadow: 1px 1px 2px #ccc;">Admin Login</h3>
<hr/>
    <form method="post" action="">
        <span style="font-family:Arial;font-size:15px;color:#404040;">Login at Fortune FX Admin Panel. </span> <span style="color:#cc0000;font-family:Arial;font-size:15px;">* Required Field.</span><br/><br/>
    
        <label for="email_id"><span style="color:#cc0000;font-family:Arial;font-size:17px;">*</span>Username: </label><input type="text" id="email_id" name="email_id" placeholder="Username" value="<?php echo set_value("email_id"); ?>"/>
        <label for="password"><span style="color:#cc0000;font-family:Arial;font-size:17px;">*</span>Password: </label><input type="password" id="password" name="password" placeholder="Password" value="<?php echo set_value("password"); ?>"/>
        <input type="submit" id="ad_login_btn" name="ad_login_btn" value="Login"/>
    </form>
    <?php echo form_individual_error("ad_login_btn", "<div class=\"error\" style=\"font-family:Arial;color:#cc0000;font-size:13px;border:1px solid #eaeaea;padding:10px;background:#f2f2f2;\">", "</div>"); ?>

            </div>
    </body>
</html>