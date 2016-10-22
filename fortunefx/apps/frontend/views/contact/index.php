<script src="http://<?php echo ROOT_URL; ?>apps/frontend/public/js/validation.js" type="text/javascript"></script>
<h2 style="font-family:Arial;color:#333333;text-shadow: 1px 1px 2px #ddd;">Contact Us</h2>
<hr/>
<div class="form_panel">
<div class="contact_grid contact_form">
    <form method="post" action="#success_msg" id="contact_form_form">
    <span style="font-family:Arial;font-size:15px;color:#404040;">Please fill up the form below to contact us.</span> <span style="color:#216C2A;font-family:Arial;font-size:15px;">* Required Field.</span><br/><br/>
        <label for="full_name"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>Name: </label><span id="full_name_msg" style="font-family:Arial;font-size:13px;color:#cc0000;"><?php echo form_individual_error("full_name"); ?></span><input type="text" id="full_name" name="full_name" placeholder="Name" value="<?php echo set_value("full_name"); ?>"/>
        <label for="email"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>Email: </label><span id="email_msg" style="font-family:Arial;font-size:13px;color:#cc0000;"><?php echo form_individual_error("email"); ?></span><input type="text" id="email" name="email" placeholder="Email" value="<?php echo set_value("email"); ?>"/>
        <label for="subject"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>Subject: </label><span id="sub_msg" style="font-family:Arial;font-size:13px;color:#cc0000;"><?php echo form_individual_error("subject"); ?></span><input type="text" id="subject" name="subject" placeholder="Subject" value="<?php echo set_value("subject"); ?>"/>
        <label for="message"><span style="color:#216C2A;font-family:Arial;font-size:17px;">*</span>Message: </label>
        <span id="msg_msg" style="font-family:Arial;font-size:13px;color:#cc0000;"><?php echo form_individual_error("message"); ?></span>
        <textarea id="message" name="message" placeholder="Message"><?php echo set_value("message"); ?></textarea>
        <input type="submit" id="contact_submit_btn" name="contact_submit_btn" value="Submit">
</form>
    <span id="con_msg"></span>
    <?php echo $success_msg; ?>
</div>
</div>
<div id="contact_map" class="contact_grid">
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA1G0t5gywOeoUX38nhIdTJsSBxHx8DsOA"></script>
<script>
var myCenter=new google.maps.LatLng(-33.8320103,150.9883252);

function initialize()
{
var mapProp = {
  center:myCenter,
  zoom:16,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };

var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

var marker=new google.maps.Marker({
  position:myCenter,
  });

marker.setMap(map);

var infowindow = new google.maps.InfoWindow({
  content:"Fortune FX"
  });

infowindow.open(map,marker);
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>
<div id="googleMap" style="width:100%;height:300px;">  
</div><br/>
<span style="color:#444;font-family:Arial;font-size:13px;">
            <img src="http://<?php echo ROOT_URL; ?>apps/frontend/public/images/emailicon.png" style="vertical-align:middle;" alt="Email"/>&nbsp;Email: info@fortunefx.com.au<br/><br/>
            <img src="http://<?php echo ROOT_URL; ?>apps/frontend/public/images/wphoneicon.png" width="25" height="25" style="vertical-align:middle;" alt="Phone"/>&nbsp;Phone: 02345433<br/><br/>
            <img src="http://<?php echo ROOT_URL; ?>apps/frontend/public/images/locationicon.png" style="vertical-align:middle;" alt="Phone"/>&nbsp;Location: 42 Sheffield Street, Merrylands, NSW, 2160
            </span>
</div>
<div style="clear:both;"></div>