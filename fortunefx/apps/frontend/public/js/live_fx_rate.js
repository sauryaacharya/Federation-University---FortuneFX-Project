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
    
    getRate();
    /*
    getRate();
    setInterval(getRate, 3300);
    */
});

/*
var is_request_first = true;
function getRate()
{
    $.ajax({
        type: "POST",
        url: "http://localhost/fortunefx/ajaxservice/getLiveFxRate/limit",
        cache: false,
        beforeSend: function(){
            var loader_html = "<img src='http://localhost/fortunefx/apps/frontend/public/images/ajax_loader.gif' alt='Loading' style='vertical-align:middle;'/><br/><span style='font-family:Arial;font-size:13px;color:#4d4d4d;'>Loading Currency Rate</span>";
            $("#ajax_loader1").html(loader_html);
        },
        success: function(data)
        {
            is_request_first = false;
            var rate_arr = data;
            $("#rate_tbl").html(getRateHtml(rate_arr));
            $("#ajax_loader1").html("");
        }
        
    });
}
*/
/*
function getRateHtml(rate_arr)
{
    var i;
    var html = "<table id='live_rate_tbl'>";
    html += "<tr><th>Pair</th><th>Buy</th><th>Sell</th><th>Spread</th></tr>";
    for(i = 0; i < 5; i++)
    {
        var spread = (rate_arr.live_rates[i].buy - rate_arr.live_rates[i].sell) * 10000;
        var spread_str = spread.toString().split(".");
        var st = spread_str[0].toString() + "." + spread_str[1].slice(0, 2);
        //var st = spread_str[0].toString() + "." + spread_str[1].toString()+spread_str[2].toLocaleString();
        html += "<tr>";
        html += "<td style='font-weight:bold;font-size:11px;color:#1f7a7a;'>" + rate_arr.live_rates[i].name + "</td>";
        html += "<td>" + rate_arr.live_rates[i].sell + "</td>";
        html += "<td>" + rate_arr.live_rates[i].buy + "</td>";
        html += "<td>"+ st + "</td>";
        html += "</tr>";
    }
    html += "</table>";
    return html;
}
*/
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
            var converted_result = amount * data.live_rates[0].rate;
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
            var pip_value = (0.0001 * trade_size)/data.live_rates[0].rate;
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
             var result = (trade_size/lev[1])*data.live_rates[0].rate;
             $("#margin_result").html("<span style='font-family:Arial;font-size:15px;color:#4d4d4d;font-weight:bold;'>Required Margin("+base_currency+")= "+result.toFixed(4)+ "</span>");
             $("#ajax_loader_margin").css("visibility", "hidden");
        }
    }); 
}

function getRate()
{
    var table = $('#live_rate_table').DataTable({
        "ordering" : false,
        "paging" : false,
        "info" : false,
        "lengthChange" : false,
        "searching" : false,
        "ajax":{
            "url" : "http://localhost/fortunefx/ajaxservice/getLiveFxRate/limit",
            "dataSrc" : "live_rates"
        },
        "language": {
             "loadingRecords": "<span style='color:#000;'><i class='fa fa-spinner fa-spin fa-3x fa-fw'></i> <br/>Loading</span>"
            },
        "columns" : [
            {"data" : "name"}, 
            {"data" : "buy"}, 
            {"data" : "sell"},
            {"data" : "spread"}
        ]
    });
    
    table.on( 'xhr', function ( e, settings, json ) {
    table.ajax.reload();
} );
    /*
    setInterval(function(){
        table.ajax.reload();
    }, 1500);
    */
}
