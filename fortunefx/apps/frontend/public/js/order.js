var selected_trade_type ;
var selected_product;
var rate;
var table;

$(document).ready(function(){
    getOpenOrders();
    selected_trade_type = $("#trade_type").val();
    selected_product = $("#product").val();
    
    
    
    //setInterval(function(){alert(selected_trade_type + selected_product);}, 3000);
    
    $("#trade_type").change(function(){
        //var selectedText = $(this).find("option:selected").text();
        selected_trade_type = $(this).val();
        //alert(selectedVal + selectedText);
        getLiveRate(selected_trade_type, selected_product);
    });
    
    $("#product").change(function(){
        
        selected_product = $(this).val();
        getLiveRate(selected_trade_type, selected_product);
    });
    
    
   // setInterval(function(){alert(rate)}, 1500);
    //setInterval(function(){alert($("#rate").val());}, 2000);
    
    $("#place_order_btn").click(function(){
        placeOrder();
    });
    
    
    
});

function getOpenOrders()
{
    table = $('#open_order_table').DataTable({
        "paging" : false,
        "info" : false,
        "searching" : false,
        "ordering" : false,
        "columnDefs": [ {
                          "targets": 5,
                          "data": "unrealized_pl",
                          "render": function ( data, type, full, meta ) {
                              var color;
                              if(data >= 0)
                              {
                                  color = "color:#008000;";
                              }
                              else
                              {
                                  color = "color:#cc0000;";
                              }
                          return '<span style="'+color+';font-weight:bold;">$'+data+'</span>';
                          }
                      },
                      {
                          "targets" : 0,
                          "data" : "product",
                          "render" : function(data, type, full, meta){
                              return "<strong>"+data+"</strong>";
                          }
                      },
                      {
                          "targets" : 6,
                          "data" : "transaction_id",
                          "render" : function(data, type, full, meta){
                              return "<i class='fa fa-spinner fa-spin fa-fw' aria-hidden='true' id='cls_spin"+data+"' style='visibility:hidden;'></i><button name='ord_cls_btn' class='ord_cls_btn' onclick='closeOrder("+data+")'><i class='fa fa-times aria-hidden='true'></i> Close</button>";
                          }
                      }
                      ],
        "ajax":{
            "url" : "http://localhost/fortunefx/ajaxservice/openorders",
            "dataSrc" : "open_orders"
        },
        "language": {
             "loadingRecords": "<span style='color:#000;'><i class='fa fa-spinner fa-spin fa-3x fa-fw'></i> <br/>Loading</span>"
            },
        "columns" : [
            {"data" : "product"}, 
            {"data" : "amount"}, 
            {"data" : "description"},
            {"data" : "deal_rate"}, 
            {"data" : "live_rate"},
            {"data" : "unrealized_pl"}
        ]
    });
    
    
    table.on( 'xhr', function ( e, settings, json ) {
    table.ajax.reload();
} );
}

function closeOrder(transaction_id)
{
    $.ajax({
       url: "http://localhost/fortunefx/ajaxservice/closeorder", 
       type: "POST", 
       data : {transaction_id : transaction_id}, 
       beforeSend: function(){
           $("#cls_spin"+transaction_id).css("visibility", "visible");
       }, 
       success: function(data){
           
           $("#order_msg").fadeIn(700, fadeOutOrdMsg);
           $("#cls_spin"+transaction_id).css("visibility", "hidden");
           var color = (data.response.pl < 0) ? "#e60000" : "#008000"; 
           $("#order_msg").html("Your order has been closed.<br/>P/L: <span style='color:"+color+"'>" + data.response.pl + "</span>");
          
           table.ajax.reload();
       }
    });
}

function fadeOutOrdMsg()
{
    $("#order_msg").delay(2000).fadeOut(1000);
}

function placeOrder()
{
    var size = $("#trading_size").val();
    $.ajax({
        type: "POST",
        url: "http://localhost/fortunefx/ajaxservice/placeorder",
        data: {trade_type : selected_trade_type, product: selected_product, trading_size: size},
        beforeSend: function(){
            $("#ord_spinner").css("visibility", "visible");
        },
        success: function(data)
        {
            $("#ord_spinner").css("visibility", "hidden");
            $("#order_msg").fadeIn(700, fadeOutOrdMsg);
            $("#order_msg").html(data.response.desc + "<br/>Size: " + data.response.size);
            table.ajax.reload();
        }
    });
}

function getLiveRate()
{
    $.ajax({
        type: "GET",
        url: "http://localhost/fortunefx/ajaxservice/getLiveFxRate/"+selected_product,
        beforeSend: function(){
            
        },
        success: function(data)
        {
            
            if(selected_trade_type == "S")
            {
                rate = data.live_rates[0].sell;
                $("#rate").prop("selected", true);
                $("#rate").find("option").text(data.live_rates[0].sell);
               
            }
            else if(selected_trade_type == "B")
            {
                rate = data.live_rates[0].buy;
                $("#rate").prop("selected", true);
                $("#rate").find("option").text(data.live_rates[0].buy);
                
            }
            
        }
    });
}