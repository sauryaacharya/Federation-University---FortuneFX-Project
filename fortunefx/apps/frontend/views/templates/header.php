<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <noscript>
        <style>
            #body_wrapper
            {
                display:none;
            }
        </style>
        <meta http-equiv="refresh" content="0; URL=http://localhost/fortunefx/noscript.php" />
        </noscript>
        <title>
            <?php echo $title; ?>
        </title>
        <link href="http://<?php echo ROOT_URL; ?>apps/frontend/public/engine1/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css"/>
        <script src="https://code.jquery.com/jquery-1.12.3.js" type="text/javascript"></script>
        <script type="text/javascript" src="http://<?php echo ROOT_URL; ?>apps/frontend/public/js/tool.js"></script>     
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="http://<?php echo ROOT_URL; ?>apps/frontend/public/js/live_fx_rate.js"></script>
        <link rel="stylesheet" type="text/css" href="http://<?php echo ROOT_URL; ?>apps/frontend/public/css/style.css"/>
        
        </head>
    <body>
        <div id="box" style="display:none;background:rgba(255, 255, 255, 0.80);width:100%;height:100%;position:fixed;z-index:4000;margin:0 auto;"></div>
        <div id="body_wrapper">
        <div id="header">
            <div id="header_content">
                <div id="header_right_cont"> 
                <div id="soc_net_link">
                    <a href="#"><img src="http://<?php echo ROOT_URL; ?>apps/frontend/public/images/Facebook.png" alt="Facebook" /></a>
                    <a href="#"><img src="http://<?php echo ROOT_URL; ?>apps/frontend/public/images/Twitter.png" alt = "Twitter" /></a>
                    <a href="#"><img src="http://<?php echo ROOT_URL; ?>apps/frontend/public/images/GooglePlus.png" alt="Google Plus" /></a>
                    <a href="#"><img src="http://<?php echo ROOT_URL; ?>apps/frontend/public/images/LinkedIn.png" alt="Linked In" /></a>
                    
                </div>
                    <div style="clear:both;"></div>
                    <div id="member_act">
                        <?php if(!isset($_SESSION["authentication"])):?>
                        <a href="http://localhost/fortunefx/login"><img src="http://<?php echo ROOT_URL; ?>apps/frontend/public/images/loginicon.png" alt="Login" style="vertical-align: middle;border:none;"/>&nbsp;Login</a>
                        <?php else:?>
                        <form method="post" action="http://localhost/fortunefx/logout" style="margin:0;padding:0;display:inline;">
                            <button><i class="fa fa-power-off fa-2x" aria-hidden="true" style="vertical-align:middle;"></i>&nbsp;Logout</button>    
                        </form>
                        <a href="http://localhost/fortunefx/dashboard"><i class="fa fa-tachometer fa-2x" aria-hidden="true" style="vertical-align:middle;"></i>&nbsp;Dashboard</a>
                        <?php endif; ?>
                        <?php if(!isset($_SESSION["authentication"])):?>
                        <a href="http://localhost/fortunefx/signup"><img src="http://<?php echo ROOT_URL; ?>apps/frontend/public/images/registericon.png" alt="Register" style="vertical-align: middle;border:none;"/>&nbsp;Open An Account</a>
                        <?php endif; ?>
                        <a href="tel:0416749696"><img src="http://<?php echo ROOT_URL; ?>apps/frontend/public/images/phoneicon.png" alt="Facebook" style="vertical-align: middle;border:none;" width="20" height="20"/>&nbsp;Call Us</a>
                    </div>
                    
                </div>
                <div id="logo">
                    <a href="#"><img src="http://<?php echo ROOT_URL; ?>apps/frontend/public/images/fx_logo.png" alt="Fortune Fx" width="205" height="58"/></a>
                </div>
                <!--end logo-->
            </div>
            <!--end header_content-->
        </div>
            <!--end header-->
            
            <div id="navbar">
                <div id="navbar_content">
                    <ul>
                        <li><a href="http://localhost/fortunefx">HOME</a></li>
                        <li><a href="http://localhost/fortunefx/allcurrency">LIVE RATES</a></li>
                        <li><a href="http://localhost/fortunefx/calendar">CALENDAR</a></li>
                        <li>
                            <a href="http://localhost/fortunefx/news">NEWS</a>
                            <ul>
                                <li><a href="http://localhost/fortunefx/news/breakingnews">Breaking News</a></li>
                                <li><a href="http://localhost/fortunefx/news/technicalnews">Technical News</a></li>
                                <li><a href="http://localhost/fortunefx/news/fxindustrynews">Forex Industry News</a></li>
                                <li><a href="http://localhost/fortunefx/news/fundamentalanalysisnews">Fundamental Analysis News</a></li>
                                <li><a href="http://localhost/fortunefx/news/entertainmentnews">Entertainment News</a></li>
                            </ul>
                        </li>
                        <!--
                        <li>
                            <a href="#">TOOLS</a>
                            <ul>
                                <li><a href="http://localhost/fortunefx/news/breakingnews">Currency Converter</a></li>
                                <li><a href="http://localhost/fortunefx/news/breakingnews">Forex Rates</a></li>
                                <li><a href="http://localhost/fortunefx/news/breakingnews">Forex Charts</a></li>   
                            </ul>
                        </li>
                        -->
                        <li><a href="#">ABOUT US</a></li>
                        <li><a href="http://localhost/fortunefx/contact">CONTACT US</a></li>
                    </ul>
                </div>
                <!--end navbar_content-->
            </div>
            <!--end navbar-->
            