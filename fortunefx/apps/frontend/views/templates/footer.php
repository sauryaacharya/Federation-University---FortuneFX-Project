</div>
<!--end main_page_content-->
</div>
<!--end main_page-->
<div style="background:#f2f2f2;width:100%;padding:10px;border-bottom:1px solid #e4e4e4;">
    <div style="width:80%;margin:0 auto;">
        <span style="font-family:Arial;font-weight:bold;font-size:15px;color:#b30000;">Risk Warning:</span>
        <span style="font-family:Arial;color:#4d4d4d;font-size:13px;">Our services includes products that are traded on margin and carry a risk of losses to your invested capital and may not be suitable for everyone. Please ensure that you fully understand the risks involved.</span> 
    </div>
</div>
<div id="footer">
    <div id="footer_content">
        <div class="footer_grid" id="foot_contact_us">
            <h4 style="font-family:Arial;color:#f2f2f2;padding-bottom:5px;">Contact Us</h4>
            <span style="color:#b3b3b3;font-family:Arial;font-size:13px;">
            <img src="http://<?php echo ROOT_URL; ?>apps/frontend/public/images/emailicon.png" style="vertical-align:middle;" alt="Email"/>&nbsp;Email: info@fortunefx.com.au<br/><br/>
            <img src="http://<?php echo ROOT_URL; ?>apps/frontend/public/images/wphoneicon.png" width="25" height="25" style="vertical-align:middle;" alt="Phone"/>&nbsp;Phone: 02345433<br/><br/>
            <img src="http://<?php echo ROOT_URL; ?>apps/frontend/public/images/locationicon.png" style="vertical-align:middle;" alt="Phone"/>&nbsp;Location: 42 Sheffield Street, Merrylands, NSW, 2160
            </span>
        </div>
        <div class="footer_grid" id="foot_aboutus_links">
            <h4 style="font-family:Arial;color:#f2f2f2;padding-bottom:5px;">About Us</h4>
            <ul>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Why Fortune Fx?</a></li>
                <li><a href="#">Our Objectives</a></li>
            </ul>
        </div>
        <div class="footer_grid" id="foot_quick_links">
            <h4 style="font-family:Arial;color:#f2f2f2;padding-bottom:5px;">Quick Links</h4>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">Enquiry</a></li>
                <li><a href="#">Policy</a></li>
                <li><a href="#">Sitemap</a></li>
            </ul>
        </div>
        <div class="footer_grid" id="foot_tools_links">
            <h4 style="font-family:Arial;color:#f2f2f2;padding-bottom:5px;">Our Tools</h4>
            <ul>
                <li><a href="#">Currency Converter</a></li>
                <li><a href="#">Live FX Rates</a></li>
                <li><a href="#">FX Rates Chart</a></li>
            </ul>
        </div>
        <div class="footer_grid" id="foot_soc_link">
            <h4 style="font-family:Arial;color:#f2f2f2;padding-bottom:5px;">Find Us On</h4>
            <a href="#"><img src="http://<?php echo ROOT_URL; ?>apps/frontend/public/images/WFacebook.png" alt="Facebook" onmouseover="this.src='http://<?php echo ROOT_URL; ?>apps/frontend/public/images/Facebook.png';" onmouseout="this.src='http://<?php echo ROOT_URL; ?>apps/frontend/public/images/WFacebook.png';"/></a>
                    <a href="#"><img src="http://<?php echo ROOT_URL; ?>apps/frontend/public/images/WTwitter.png" alt = "Twitter" onmouseover="this.src='http://<?php echo ROOT_URL; ?>apps/frontend/public/images/Twitter.png';" onmouseout="this.src='http://<?php echo ROOT_URL; ?>apps/frontend/public/images/WTwitter.png';"/></a>
                    <a href="#"><img src="http://<?php echo ROOT_URL; ?>apps/frontend/public/images/WGooglePlus.png" alt="Google Plus" onmouseover="this.src='http://<?php echo ROOT_URL; ?>apps/frontend/public/images/GooglePlus.png';" onmouseout="this.src='http://<?php echo ROOT_URL; ?>apps/frontend/public/images/WGooglePlus.png';"/></a>
                    <a href="#"><img src="http://<?php echo ROOT_URL; ?>apps/frontend/public/images/WLinkedIn.png" alt="Linked In" onmouseover="this.src='http://<?php echo ROOT_URL; ?>apps/frontend/public/images/LinkedIn.png';" onmouseout="this.src='http://<?php echo ROOT_URL; ?>apps/frontend/public/images/WLinkedIn.png';"/></a>
        </div>
        <div style="clear: both;"></div>
        <br/>
        <span style="font-family:Arial;font-size:12px;color:#ccc;">
        Fortune FX is a trading name of Fortune FX Pty Ltd, ABN 73 451 102 302 and is regulated by the Australian Securities and Investments Commission (ASIC). Australian Financial Services (AFS) License no. 394882.   
        <br/>
        Copyright &copy; 2016 Fortune Fx Pty. Ltd. All rights reserved.
        </span>
    </div>
</div>
</div>
<?php if(defined("IS_DASHBOARD")):?>
<?php if(Registry::getObject("authentication")->isLoggedIn()): ?>
<div id="order_place_men">
    <a href="#" id="arrow_up" style='float:right;'><i class="fa fa-angle-double-up fa-2x" aria-hidden="true"></i></a>    
    <div style="font-family:Arial;font-weight:bold;color:#444;margin:10px 0px 0px 10px;">Place Your Order Here</div>
</div>
<div id="order_place_table">
    <a href="#" id="arrow_down"><i class="fa fa-angle-double-down fa-2x" aria-hidden="true"></i></a>
    <div id="tbl_content">
        <div style="font-family:Arial;font-weight:bold;color:#444;margin:10px 0px 0px 10px;">Place Your Order Here</div>
        <div style="border-top:1px solid #b3b3b3;margin-top:5px;margin-bottom:10px;"></div>
        <br/>
        <label for="trade_type">Buy/Sell</label>
        <select id="trade_type" name="trade_type">
            <option value="B">Buy</option>
            <option value="S">Sell</option>
        </select>
        <label for="product">Product:</label>
    <select id="product" name="product">
        <option value="AUDUSD">AUDUSD</option>
                <option value="AUDNZD">AUDNZD</option>
                <option value="AUDCAD">AUDCAD</option>
                <option value="AUDCHF">AUDCHF</option>
                <option value="AUDJPY">AUDJPY</option>
                <option value="CADCHF">CADCHF</option>
                <option value="CADJPY">CADJPY</option>
                <option value="CHFJPY">CHFJPY</option>
                <option value="EURAUD">EURAUD</option>
                <option value="EURCAD">EURCAD</option>
                <option value="EURCHF">EURCHF</option>
                <option value="EURCZK">EURCZK</option>
                <option value="EURDKK">EURDKK</option>
                <option value="EURGBP">EURGBP</option>
                <option value="EURJPY">EURJPY</option>
                <option value="EURNOK">EURNOK</option>
                <option value="EURNZD">EURNZD</option>
                <option value="EURUSD">EURUSD</option>
                <option value="GBPAUD">GBPAUD</option>
                <option value="GBPCAD">GBPCAD</option>
                <option value="GBPCHF">GBPCHF</option>
                <option value="GBPJPY">GBPJPY</option>
                <option value="GBPNZD">GBPNZD</option>
                <option value="GBPUSD">GBPUSD</option>
                <option value="NZDCAD">NZDCAD</option>
                <option value="NZDCHF">NZDCHF</option>
                <option value="NZDJPY">NZDJPY</option>
                <option value="NZDUSD">NZDUSD</option>
                <option value="SGDJPY">SGDJPY</option>
                <option value="USDCAD">USDCAD</option>
                <option value="USDCHF">USDCHF</option>
                <option value="USDCNH">USDCNH</option>
                <option value="USDDKK">USDDKK</option>
                <option value="USDHKD">USDHKD</option>
                <option value="USDJPY">USDJPY</option>
                <option value="USDNOK">USDNOK</option>
                <option value="USDRUB">USDRUB</option>
                <option value="USDSGD">USDSGD</option>
    </select>
        <label for="trading_size">Size: </label>
        <select id="trading_size" name="trading_size">
            <option value="1000">1000</option>
            <option value="2000">2000</option>
            <option value="5000">5000</option>
            <option value="10000">10000</option>
            <option value="20000">20000</option>
            <option value="30000">30000</option>
            <option value="50000">50000</option>
            <option value="80000">80000</option>
            <option value="100000">100000</option>
        </select>
        <label for="trading_size">Live Rate: </label>
        <select id="rate" name="rate">
            <option value=""></option>
        </select>
        <input type="button" id="place_order_btn" name="place_order_btn" value="Place Order"/>
        <span style="color:#000;visibility:hidden;" id="ord_spinner"><i class='fa fa-spinner fa-spin fa-2x fa-fw' style="vertical-align:middle;"></i></span>
    </div>
</div>
<?php endif; ?>
<?php endif; ?>
<!--end body_wrapper-->

    <!-- Start of LiveChat (www.livechatinc.com) code -->
    
<script type="text/javascript">
window.__lc = window.__lc || {};
window.__lc.license = 8311621;
(function() {
  var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
  lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
})();
</script>
<!-- End of LiveChat code -->
    
<script type="text/javascript">
    $(document).ready(function(){
   executeVisitorAnalytics();
    
});
    
    function executeVisitorAnalytics()
    {
        $.ajax({
            url: "http://localhost/fortunefx/visitor/visitor.php",
            type: "GET", 
            beforeSend: function(){
                
            },
            success: function(data){
                
            }
        });
    }
</script>
</body>
</html>