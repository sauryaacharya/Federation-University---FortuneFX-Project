<?php
class ChartModel extends Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function isValidCurrencyPair($pair)
    {
        $valid = false;
        $currency_pair = array("AUDUSD", "AUDNZD", "AUDCAD", "AUDCHF", "AUDJPY", "CADCHF", "CADJPY",
                               "CHFJPY", "EURAUD", "EURCAD", "EURCHF", "EURCZK", "EURDKK", "EURGBP", 
                               "EURJPY", "EURNOK", "EURNZD", "EURUSD", "GBPAUD", "GBPCAD", 
                               "GBPCHF", "GBPJPY", "GBPNZD", "GBPUSD", "NZDCAD", "NZDCHF", "NZDJPY", 
                               "NZDUSD", "SGDJPY", "USDCAD", "USDCHF", "USDCNH", "USDDKK", "USDHKD", 
                               "USDJPY", "USDNOK", "USDRUB", "USDSGD");
        if(in_array($pair, $currency_pair))
        {
            $valid = true;
        }
        return $valid;
    }
}