<h2 style="font-family:Arial;color:#333333;text-shadow: 1px 1px 2px #ccc;"><?php echo $heading; ?></h2>
<hr/>
<div style="margin:0 auto;">
<script type="text/javascript" src="https://d33t3vvu2t2yu5.cloudfront.net/tv.js"></script>
<script type="text/javascript">
new TradingView.widget({
  "width": "100%",
  "height": 550,
  "symbol": "FX_IDC:<?php echo $currency_pair; ?>",
  "interval": "3",
  "timezone": "Australia/Sydney",
  "theme": "White",
  "style": "2",
  "locale": "en",
  "toolbar_bg": "rgba(242, 242, 242, 1)",
  "hide_top_toolbar": true,
  "withdateranges": true,
  "allow_symbol_change": true,
  "news":["headlines"],
  "hideideas": true, 
  "show_popup_button":true,
  "popup_width":"1050",
  "popup_height":"650"
});
</script>
</div>