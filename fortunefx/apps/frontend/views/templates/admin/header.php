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
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" type="text/css" href="http://<?php echo ROOT_URL; ?>apps/frontend/public/css/style.css"/>
        <script type="text/javascript">
            $(document).ready(function(){
               getTotalVisitor();
            });
            
            function getTotalVisitor()
            {
                $.ajax({
                  url: "/fortunefx/ajaxservice/totalvisits",
                  type: "GET",
                  beforeSend: function(){
                      
                  },
                  success: function(data){
                      $("#tot_visit").html(data.total_visit);
                     
                  }
               });
            }
        </script>
        </head>
    <body>
        <div id="box" style="display:none;background:rgba(255, 255, 255, 0.80);width:100%;height:100%;position:fixed;z-index:4000;margin:0 auto;"></div>
        <div id="body_wrapper">
        <div id="header">
            <div id="header_content">
                <div id="header_right_cont"> 
                    <div id="member_act">
                        
                        <form method="post" action="http://localhost/fortunefx/logout" style="margin:0;padding:0;display:inline;">
                            <button><i class="fa fa-power-off fa-2x" aria-hidden="true" style="vertical-align:middle;"></i>&nbsp;Logout</button>    
                        </form>
                        </div>
                    
                </div>
                <div id="logo">
                    <a href="#"><img src="http://<?php echo ROOT_URL; ?>apps/frontend/public/images/fx_logo.png" alt="Fortune Fx" width="205" height="58"/></a> <span style="font-family:Arial;font-size:16px;font-weight:bold;color:#444;">Admin Panel</span>
                </div>
                <!--end logo-->
            </div>
            <!--end header_content-->
        </div>
            <!--end header-->
            <div style="border:1px solid green;width:100%;">
                
            </div>