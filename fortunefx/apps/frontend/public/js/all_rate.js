$(document).ready(function(){
    getAllRate();
});

function getAllRate()
{
    var table = $('#all_live_rate_table').DataTable({
        "ordering" : false,
        "paging" : false,
        "info" : false,
        "lengthChange" : false,
        "searching" : false,
        "columnDefs" : [{
                "targets" : 4,
                "data" : "name",
                "render" : function(data, type, full, meta){
                              return '<a href="http://localhost/fortunefx/chart/currencypair/'+data.replace("/", "")+'" class="chart_link" target="_blank">'+'<img src="http://localhost/fortunefx/apps/frontend/public/images/chart_icon.png" alt="Loading" width="20" height="20"/></a>';
                          }
        }
            
        ],
        "ajax":{
            "url" : "http://localhost/fortunefx/ajaxservice/getLiveFxRate",
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
}
/*
var is_request_first = true;

function getRate()
{
    var rate_tbl = $("#rate_tbl");
    
    $.ajax({
        type: "POST",
        url: "http://localhost/fortunefx/ajaxservice/getLiveFxRate",
        cache: false,
        beforeSend: function () {
            if(is_request_first)
            {
            $("#ajax_loader").wrap("<div style='text-align:center;'></div>");
            var loader_html = '<img src="http://localhost/fortunefx/apps/frontend/public/images/ajax_loader_bar.gif" alt="Loading" style="vertical-align:middle;"/>';
            loader_html += "<br/> <span style='font-family:Arial;font-size:15px;color:#4d4d4d;'>Loading...</span>";
               $("#ajax_loader").html(loader_html);
            }
        },
        success: function(data)
        {
            is_request_first = false;
            var rate_arr = data;
            rate_tbl.html(getRateHtml(rate_arr));
            $("#ajax_loader").html(""); 
        }
        
    });
}

function getRateHtml(rate_arr)
{
    var i;
    var arr_length = rate_arr.length;
    var html = "<table id='all_live_rate_tbl'>";
    html += "<tr><th>Pair</th><th>Rate</th><th>Buy</th><th>Sell</th><th>Spread</th><th>Chart</th></tr>";
    for(i = 0; i < arr_length; i++)
    {
        var id = rate_arr[i].id;
        var link_id = id.replace("=X", "");
        var spread = (rate_arr[i].buy - rate_arr[i].sell) * 10000;
        var spread_str = spread.toString().split(".");
        var st = spread_str[0].toString() + "." + spread_str[1].slice(0, 2);
        //var st = spread_str[0].toString() + "." + spread_str[1].toString()+spread_str[2].toLocaleString();
        html += "<tr>";
        html += "<td style='font-weight:bold;'>" + rate_arr[i].name + "</td>";
        html += "<td>" + rate_arr[i].rate + "</td>";
        html += "<td>" + rate_arr[i].sell + "</td>";
        html += "<td>" + rate_arr[i].buy + "</td>";
        html += "<td>"+ st + "</td>";
        html += '<td><a href="http://localhost/fortunefx/chart/currencypair/'+link_id+'" class="chart_link">'+'<img src="http://localhost/fortunefx/apps/frontend/public/images/chart_icon.png" alt="Loading" width="30" height="32"/></a></td>';
        html += "</tr>";
    }
    html += "</table>";
    return html;
}
*/