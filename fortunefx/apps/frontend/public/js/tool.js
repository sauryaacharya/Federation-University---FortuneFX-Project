$(document).ready(function(){
    $("#currency_amt").keydown(function(e){
        var value = String.fromCharCode(e.keyCode);
        if(isNaN(value) && e.keyCode != 8 && e.keyCode != 190)
        {
            return false;
        }
        return true;
    });
    
    $("#convert_btn").click(function(){
       var currency_from = $("#country_currency_from").val();
       var currency_to = $("#country_currency_to").val();
       var pair = currency_from+currency_to;
       var amount = $("#currency_amt").val();
       
       if(amount === "" || isNaN(amount))
       {
           $(".convert_result").html("<span style='font-family:Arial;color:#e60000;font-size:13px;'>Enter the amount to convert.</span>");
       }
       else
       {
       convertCurrency(pair, amount, currency_from, currency_to);   
       }
    });
    
    $("#pip_trade_size").keydown(function(e){
        var value = String.fromCharCode(e.keyCode);
        if(isNaN(value) && e.keyCode != 8)
        {
            return false;
        }
        return true;
    });
    
    $("#mg_trade_size").keydown(function(e){
        var value = String.fromCharCode(e.keyCode);
        if(isNaN(value) && e.keyCode != 8)
        {
            return false;
        }
        return true;
    });
    
    $("#pip_calc_btn").click(function(){
        var pair = $("#pip_currency_pair").val();
        var base_currency = $("#pip_base_currency").val();
        var sliced_pair = pair.slice(3);
        var base_rate_pair = base_currency + sliced_pair;
        var trade_size = $("#pip_trade_size").val();
        if(trade_size === "" || isNaN(trade_size))
        {
            $("#pip_result").html("<span style='font-family:Arial;color:#e60000;font-size:13px;'>Enter the trading size.</span>");
        }
        else
        {
        calculatePip(base_rate_pair, trade_size, base_currency);
        }
    });
    
    $("#margin_calc_btn").click(function(){
        var pair = $("#mg_currency_pair").val();
        var base_currency = $("#mg_base_currency").val();
        var sliced_pair = pair.slice(0, 3);
        var base_rate_pair = sliced_pair + base_currency;
       
        var trade_size = $("#mg_trade_size").val();
        var leverage = $("#mg_leverage").val();
        if(trade_size === "" || isNaN(trade_size))
        {
            $("#margin_result").html("<span style='font-family:Arial;color:#e60000;font-size:13px;'>Enter the trading size.</span>");
        }
        else
        {
        calculateMargin(base_rate_pair, trade_size, leverage, base_currency);
        }
    });
});

function convertCurrency(pair, amount, currency_from, currency_to)
{
    $.ajax({
        type: "POST",
        url: "http://localhost/fortunefx/ajaxservice/getLiveFxRate/" + pair,
        cache: false,
        beforeSend: function(){
            $("#ajax_loader").css("visibility", "visible");
        },
        success: function(data)
        {
            var converted_result = amount * data[0].rate;
            //var result_string = converted_result.toString().split(".");
            //var final_result_st = result_string[0].toString() + "." + result_string[1].slice(0, 4);
            var converted_html = amount + " " + currency_from + " = " + converted_result + " " + currency_to;
            $(".convert_result").html("<span style='font-family:Arial;font-size:15px;color:#4d4d4d;font-weight:bold;'>" + converted_html + "</span>");
            $("#ajax_loader").css("visibility", "hidden");
        }
        
    });
}

function calculatePip(pair, trade_size, base_currency)
{
    $.ajax({
        type: "POST",
        url: "http://localhost/fortunefx/ajaxservice/getLiveFxRate/" + pair,
        cache: false,
        beforeSend: function(){
            $("#ajax_loader_pip").css("visibility", "visible");
        },
        success: function(data)
        {
            var pip_value = (0.0001 * trade_size)/data[0].rate;
            $("#pip_result").html("<span style='font-family:Arial;font-size:15px;color:#4d4d4d;font-weight:bold;'>Pip Value("+base_currency+")= "+pip_value.toFixed(4)+ "</span>");
            $("#ajax_loader_pip").css("visibility", "hidden");
        }
    }); 
}

function calculateMargin(pair, trade_size, leverage, base_currency)
{
    $.ajax({
        type: "POST",
        url: "http://localhost/fortunefx/ajaxservice/getLiveFxRate/" + pair,
        cache: false,
        beforeSend: function(){
            $("#ajax_loader_margin").css("visibility", "visible");
        },
        success: function(data)
        {
            
             var lev = leverage.split("/");
             var result = (trade_size/lev[1])*data[0].rate;
             $("#margin_result").html("<span style='font-family:Arial;font-size:15px;color:#4d4d4d;font-weight:bold;'>Required Margin("+base_currency+")= "+result.toFixed(4)+ "</span>");
             $("#ajax_loader_margin").css("visibility", "hidden");
        }
    }); 
}