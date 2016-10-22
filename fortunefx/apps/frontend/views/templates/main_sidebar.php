<div id="right_sidebar" class="sidebar_grid">
    <?php
    $url = isset($_GET["url"]) ? $_GET["url"] : "";
    ?>
<?php if($url != "allcurrency"):?>
<div id="live_fx_rate" class="sidebar_cont">
    <h3 style="font-family:Arial;color:#f2f2f2;background:#4d4d4d;padding:5px 0px 5px 5px;">Live Fx Rates</h3>
    <hr/>
    <table id="live_rate_table" class="custom" cellspacing="0" width="100%">
            <thead>
                      <tr>
                          <th>Pair</th>
                          <th>Buy</th>
                          <th>Sell</th>
                          <th>Spread %</th>
                      </tr>
                  </thead>  
        </table>
    <a href="allcurrency" style="font-family:Arial;font-size:12px;text-decoration:none;color:#0086b3;" onmouseover="this.style.textDecoration='underline';" onmouseout="this.style.textDecoration='none';">View all curency pairs</a>
</div>
    <?php endif; ?>
<div id="currency_converter" class="sidebar_cont">
    <h3 style="font-family:Arial;color:#f2f2f2;background:#4d4d4d;padding:5px 0px 5px 5px;">Live Currency Converter</h3>
    <hr/>
    <div id="converter_panel">
        
            <h4 style="font-family:Arial;color:#4d4d4d;">From:</h4>
            <label for="country_currency_from">Select country currency:</label>
            <select id="country_currency_from" name="country_currency_from">
                <option value="AUD" selected="selected">Australian Dollar (AUD)</option>
                <option value="USD">United States Dollar (USD)</option>
                <option value="NZD">New Zealand Dollar (NZD)</option>
                <option value="CAD">Canadian Dollar (CAD)</option>
                <option value="GBP">Pound Sterling (GBP)</option>
                <option value="CHF">Swiss Franc (CHF)</option>
                <option value="JPY">Japenese Yen (JPY)</option>
                <option value="CZK">Chech Koruna (CZK)</option>
                <option value="DKK">Danish Krone (DKK)</option>
                <option value="NOK">Norwegian Krone (NOK)</option>
                <option value="SGD">Singapore Dollar (SGD)</option>
                <option value="CNH">Chinese Yuan (CNH)</option>
                <option value="HKD">Hong Kong Dollar (HKD)</option>
                <option value="RUB">Russian Ruble (RUB)</option>
            </select>
            <h4 style="font-family:Arial;color:#4d4d4d;">To:</h4>
            <label for="country_currency_to">Select country currency:</label>
            <select id="country_currency_to" name="country_currency_to">
                <option value="AUD">Australian Dollar (AUD)</option>
                <option value="USD" selected="selected">United States Dollar (USD)</option>
                <option value="NZD">New Zealand Dollar (NZD)</option>
                <option value="CAD">Canadian Dollar (CAD)</option>
                <option value="GBP">Pound Sterling (GBP)</option>
                <option value="CHF">Swiss Franc (CHF)</option>
                <option value="JPY">Japenese Yen (JPY)</option>
                <option value="CZK">Chech Koruna (CZK)</option>
                <option value="DKK">Danish Krone (DKK)</option>
                <option value="NOK">Norwegian Krone (NOK)</option>
                <option value="SGD">Singapore Dollar (SGD)</option>
                <option value="CNH">Chinese Yuan (CNH)</option>
                <option value="HKD">Hong Kong Dollar (HKD)</option>
                <option value="RUB">Russian Ruble (RUB)</option>
            </select>
            <label for="currency_amt">Amount:</label>
            <input type="text" id="currency_amt" name="currency_amt" placeholder="Amount"/>
            <input type="button" id="convert_btn" name="convert_btn" value="Convert"/>
            <span id="ajax_loader" style="visibility:hidden;"><img src="http://<?php echo ROOT_URL; ?>apps/frontend/public/images/ajax_loader.gif" alt="Loading" style="vertical-align:middle;"/></span>
            <div class="convert_result">
                
            </div>
    </div>
</div>
    <div id="margin_calculator" class="sidebar_cont">
        <h3 style="font-family:Arial;color:#f2f2f2;background:#4d4d4d;padding:5px 0px 5px 5px;">Margin Calculator</h3>        
    <hr/>
    <div id="margin_calc_panel">
            <label for="mg_currency_pair">Currency Pair:</label>
            <select id="mg_currency_pair">
                <option value="AUDUSD" selected="selected">AUDUSD</option>
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
            <label for="mg_base_currency">Base Currency:</label>
            <select id="mg_base_currency">
                <option value="AUD" selected="selected">AUD</option>
            </select>
            <label for="mg_trade_size">Trade Size (In Units):</label>
            <input type="text" id="mg_trade_size" placeholder="Trade Size"/>
            <label for="mg_leverage">Leverage:</label>
            <select id="mg_leverage">
                <option value="1/1" selected="selected">1:1</option>
                <option value="1/2">1:2</option>
                <option value="1/3">1:3</option>
                <option value="1/5">1:5</option>
                <option value="1/10">1:10</option>
                <option value="1/15">1:15</option>
                <option value="1/20">1:20</option>
                <option value="1/25">1:25</option>
                <option value="1/33">1:33</option>
                <option value="1/50">1:50</option>
                <option value="1/66">1:66</option>
                <option value="1/75">1:75</option>
                <option value="1/100">1:100</option>
                <option value="1/125">1:125</option>
                <option value="1/150">1:150</option>
                <option value="1/175">1:175</option>
                <option value="1/200">1:200</option>
                <option value="1/300">1:300</option>
                <option value="1/400">1:400</option>
                <option value="1/500">1:500</option>
            </select>
            <input type="button" value="calculate" id="margin_calc_btn"/>
            <span id="ajax_loader_margin" style="visibility:hidden;"><img src="http://<?php echo ROOT_URL; ?>apps/frontend/public/images/ajax_loader.gif" alt="Loading" style="vertical-align:middle;"/></span>
            <div id="margin_result">
            </div>
        </div>
    </div>
    
    <div id="pip_calculator" class="sidebar_cont">
        <h3 style="font-family:Arial;color:#f2f2f2;background:#4d4d4d;padding:5px 0px 5px 5px;">Pip Calculator</h3>        
    <hr/>
    <div id="pip_calc_panel">
        <label for="pip_currency_pair">Currency Pair:</label>
        <select id="pip_currency_pair">
                <option value="AUDUSD" selected="selected">AUDUSD</option>
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
        <label for="pip_base_currency">Base Currency:</label>
            <select id="pip_base_currency">
                <option value="AUD" selected="selected">AUD</option>
            </select>
        <label for="pip_trade_size">Trade Size (In Units):</label>
            <input type="text" id="pip_trade_size" placeholder="Trade Size"/>
            <input type="button" value="calculate" id="pip_calc_btn"/>
            <span id="ajax_loader_pip" style="visibility:hidden;"><img src="http://<?php echo ROOT_URL; ?>apps/frontend/public/images/ajax_loader.gif" alt="Loading" style="vertical-align:middle;"/></span>
            <div id="pip_result">
            </div>
    </div>
    </div>
</div>