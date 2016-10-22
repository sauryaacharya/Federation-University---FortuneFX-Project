/*
$(document).ready(function(){
    
    getTechnicalNews();
    //setInterval(getLiveNews, 30000);
    getBreakingNews();
    getFxIndustryNews();
    getFundamentalNews();
    getEntertainmentNews();
    
});
*/
function getTechnicalNews()
{
    var news_table = $("#technical_news");
    $.ajax({
        type: "POST",
        url: "http://localhost/fortunefx/ajaxservice/getTechnicalNews",
        beforeSend: function(){
            var loader_html = "<img src='http://localhost/fortunefx/apps/frontend/public/images/ajax_loader.gif' alt='Loading' style='vertical-align:middle;'/><br/><span style='font-family:Arial;font-size:13px;color:#4d4d4d;'>Loading News</span>";
            $("#ajax_loader_news").html(loader_html);
        }, 
        success: function(data){
            var news_arr = data;
            news_table.html(getLiveNewsHtml(news_arr));
            $("#ajax_loader_news").html(""); 
        }
        
    });
}

function getBreakingNews()
{
    var news_table = $("#breaking_news");
    $.ajax({
        type: "POST",
        url: "http://localhost/fortunefx/ajaxservice/getBreakingNews",
        beforeSend: function(){
            var loader_html = "<img src='http://localhost/fortunefx/apps/frontend/public/images/ajax_loader.gif' alt='Loading' style='vertical-align:middle;'/><br/><span style='font-family:Arial;font-size:13px;color:#4d4d4d;'>Loading News</span>";
            $("#breaking_news_loader").html(loader_html);
        }, 
        success: function(data){
            var news_arr = data;
            news_table.html(getLiveNewsHtml(news_arr));
            $("#breaking_news_loader").html(""); 
        }
        
    });
}

function getFxIndustryNews()
{
    var news_table = $("#fx_industry_news");
    $.ajax({
        type: "POST",
        url: "http://localhost/fortunefx/ajaxservice/getFxIndustryNews",
        beforeSend: function(){
            var loader_html = "<img src='http://localhost/fortunefx/apps/frontend/public/images/ajax_loader.gif' alt='Loading' style='vertical-align:middle;'/><br/><span style='font-family:Arial;font-size:13px;color:#4d4d4d;'>Loading News</span>";
            $("#fxind_news_loader").html(loader_html);
        }, 
        success: function(data){
            var news_arr = data;
            news_table.html(getLiveNewsHtml(news_arr));
            $("#fxind_news_loader").html(""); 
        }
        
    });
}

function getFundamentalNews()
{
    var news_table = $("#fundamental_news");
    $.ajax({
        type: "POST",
        url: "http://localhost/fortunefx/ajaxservice/getFundamentalNews",
        beforeSend: function(){
            var loader_html = "<img src='http://localhost/fortunefx/apps/frontend/public/images/ajax_loader.gif' alt='Loading' style='vertical-align:middle;'/><br/><span style='font-family:Arial;font-size:13px;color:#4d4d4d;'>Loading News</span>";
            $("#fundamental_news_loader").html(loader_html);
        }, 
        success: function(data){
            var news_arr = data;
            news_table.html(getLiveNewsHtml(news_arr));
            $("#fundamental_news_loader").html(""); 
        }
        
    });
}

function getEntertainmentNews()
{
    var news_table = $("#ent_news");
    $.ajax({
        type: "POST",
        url: "http://localhost/fortunefx/ajaxservice/getEntertainmentNews",
        beforeSend: function(){
            var loader_html = "<img src='http://localhost/fortunefx/apps/frontend/public/images/ajax_loader.gif' alt='Loading' style='vertical-align:middle;'/><br/><span style='font-family:Arial;font-size:13px;color:#4d4d4d;'>Loading News</span>";
            $("#ent_news_loader").html(loader_html);
        }, 
        success: function(data){
            var news_arr = data;
            news_table.html(getLiveNewsHtml(news_arr));
            $("#ent_news_loader").html(""); 
        }
        
    });
}

function getLiveNewsHtml(news_arr)
{
    var i;
    var arr_length = news_arr.length;
    var html = "";
    for(i = 0; i < arr_length; i++)
    {
        html += '<div class="news_row">';
        html += '<a href="'+news_arr[i].link+'" target="_blank" class="news_link">'+'<h4 style="font-family:Arial;color:#006680;">'+news_arr[i].title+'</h4></a>';
        html += '<span style="font-family:Arial;font-size:11px;color:#999999;">' + news_arr[i].pub_date + '</span><br/>';
        html += '<span style="font-family:Arial;font-size:13px;color:#666666;">'+news_arr[i].content+'</span><br/>';
        html += '<br/><span style="font-family:Arial;font-size:13px;"><a href="'+news_arr[i].link+'" target="_blank" class="readmore_link">Read More >></a></span>';
        html += '</div>';
    }
    return html;
}