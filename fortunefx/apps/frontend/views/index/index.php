<script type="text/javascript" src="http://<?php echo ROOT_URL; ?>apps/frontend/public/js/live_fx_news.js"></script>     
<script type="text/javascript" src="http://<?php echo ROOT_URL; ?>apps/frontend/public/js/jquery.nicescroll.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
       $(".news_box").niceScroll({styler:"fb",cursorcolor:"#000"});
    });   
</script>
<div id="left_sidebar" class="sidebar_grid">
    <div id="forext_news" class="sidebar_cont">
      <h3 style="font-family:Arial;color:#f2f2f2;background:#4d4d4d;padding:5px 0px 5px 5px;">Latest Forex News</h3>
      <hr/>
    <div id="technical_news" class="news_box"> 
        <?php
        foreach($main_news as $news):
        ?>
        <div class="news_row">
            <a href="<?php echo $news["link"]; ?>" target="_blank" class="news_link"><h4 style="font-family:Arial;color:#006680;"><?php echo $news["title"]; ?></h4></a>
            <span style="font-family:Arial;font-size:11px;color:#999999;"><?php echo $news["pub_date"]; ?></span><br/>
            <span style="font-family:Arial;font-size:13px;color:#666666;"><?php echo $news["content"]; ?></span><br/>
            <br/><span style="font-family:Arial;font-size:13px;"><a href="<?php echo $news["link"]?>" target="_blank" class="readmore_link">Read More >></a></span>
        </div>
        <?php 
        endforeach;
        ?>
    </div>
      <!--end news_tbl-->
    </div>
    <!--end forex_news-->
    <div id="calendar" class="sidebar_cont">
      <h3 style="font-family:Arial;color:#f2f2f2;background:#4d4d4d;padding:5px 0px 5px 5px;">Economic Calendar</h3>
      <hr/>
      <iframe src="http://ec.forexprostools.com/?ecoDayBackground=%23dedede&defaultFont=%233d3d3d&columns=exc_flags,exc_currency,exc_importance,exc_actual,exc_forecast,exc_previous&category=_employment,_economicActivity,_inflation,_credit,_centralBanks,_confidenceIndex,_balance,_Bonds&importance=1,2,3&features=datepicker,timezone,filters&countries=25,32,6,37,72,22,17,39,14,48,10,35,42,7,43,60,45,36,110,11,26,12,46,4,5&calType=day&timeZone=31&lang=1" style="width:100%;height:700px;border:none;padding:0px 0px 1px 12px;border:1px solid #eaeaea;" id="cal_if">
      </iframe>
    </div>
    <!--end calendar-->
</div>
<!--end left_sidebar-->
<?php
include "./apps/frontend/views/templates/main_sidebar.php";
?>
<div style="clear:both;"></div>
<br/>
<hr/>
<br/>
<h1 style="text-align:center;font-family:Arial;text-transform:uppercase;color:#333333;">Forex Trading Online Platform</h1>
<br/>
<div style="font-family:Arial;font-size:14px;color:#4d4d4d;" class="index_bann" id="bann_cap">
    Fortune Fx offers complete suit of tool for web with 24 hours a day support through it's real-time forex trading paltform. It provides the real time currency rate quotes and daily, weekly and monthly charts for various currency pairs.
    <br/><br/>
    <h2 style="font-family:Arial;text-transform:uppercase;color:#333333;">Why Trade With <span style="font-family:Arial;color:#216C2A;">Fortune FX</span></h2>
    <ul>
        <li>Online Forex trading with live real time quotes</li>
        <li>Competitive Spreads</li>
        <li>Live Forex Charts</li>
        <li>No software needed</li>
        <li>Start trading within a minute</li>
        <li>No commission</li>
    </ul>
</div>
<div class="index_bann" id="bann_img">
<img src="http://<?php echo ROOT_URL; ?>apps/frontend/public/images/homebann.jpg" alt="Banner"/>
</div>
<div style="clear:both;"></div>
<script>
    $(window).load(function () {
        $(".news").customScrollbar();
    });
</script>