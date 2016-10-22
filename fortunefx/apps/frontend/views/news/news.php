<script type="text/javascript" src="http://<?php echo ROOT_URL; ?>apps/frontend/public/js/live_fx_news.js"></script>     
<script type="text/javascript" src="http://<?php echo ROOT_URL; ?>apps/frontend/public/js/jquery.nicescroll.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
	$(".news_box").niceScroll({styler:"fb",cursorcolor:"#000"});
    });
</script>
<div id="left_sidebar" class="sidebar_grid">
    <div id="forexb_news" class="sidebar_cont">
      <h3 style="font-family:Arial;color:#f2f2f2;background:#4d4d4d;padding:5px 0px 5px 5px;">Breaking News</h3>
      <hr/>
    <div id="breaking_news" class="news_box"> 
        <?php
        foreach($breaking_news as $news):
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
    </div>
    
    <div id="forext_news" class="sidebar_cont">
      <h3 style="font-family:Arial;color:#f2f2f2;background:#4d4d4d;padding:5px 0px 5px 5px;">Technical News</h3>
      <hr/>
    <div id="technical_news" class="news_box"> 
        <?php
        foreach($technical_news as $news):
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
    </div>
    
    <div id="forexind_news" class="sidebar_cont">
      <h3 style="font-family:Arial;color:#f2f2f2;background:#4d4d4d;padding:5px 0px 5px 5px;">Forex Industry News</h3>
      <hr/>
    <div id="fx_industry_news" class="news_box"> 
        <?php
        foreach($fx_ind_news as $news):
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
    </div>
    
    <div id="forexf_news" class="sidebar_cont">
      <h3 style="font-family:Arial;color:#f2f2f2;background:#4d4d4d;padding:5px 0px 5px 5px;">Fundamental Analysis News</h3>
      <hr/>
    <div id="fundamental_news" class="news_box"> 
         <?php
        foreach($fundamental_news as $news):
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
    </div>
    
    <div id="forexe_news" class="sidebar_cont">
      <h3 style="font-family:Arial;color:#f2f2f2;background:#4d4d4d;padding:5px 0px 5px 5px;">Entertainment News</h3>
      <hr/>
    <div id="ent_news" class="news_box"> 
        <?php
        foreach($ent_news as $news):
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
    </div>
</div>
<!--end left_sidebar-->
<?php
include "./apps/frontend/views/templates/main_sidebar.php";
?>
<div style="clear:both;"></div>