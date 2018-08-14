<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no, -ms-touch-action: none">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="format-detection" content="telephone=no">
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/myFont.css" />
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/sweetalert.min.js"></script> 
        <link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
        <script type="text/javascript">
        function formatSeconds(value) {
          var theTime = parseInt(value);// 秒
          var theTime1 = 0;// 分
          var theTime2 = 0;// 小时
          if(theTime > 60) {
              theTime1 = parseInt(theTime/60);
              theTime = parseInt(theTime%60);
                  if(theTime1 > 60) {
                  theTime2 = parseInt(theTime1/60);
                  theTime1 = parseInt(theTime1%60);
                  }
          }
              var result = ""+parseInt(theTime)+"秒";
              if(theTime1 > 0) {
              result = ""+parseInt(theTime1)+"分"+result;
              }
              if(theTime2 > 0) {
              result = ""+parseInt(theTime2)+"小时"+result;
              }
          return result;
        }
        function unix_to_date(unix) {
          var now = new Date(parseInt(unix) * 1000);
          Y = now.getFullYear() + '-';
          M = (now.getMonth()+1 < 10 ? '0'+(now.getMonth()+1) : now.getMonth()+1) + '-';
          D = now.getDate();
          date = Y+M+D;
          return date;
        }

        function toFileTypeText(film_type){
          var film_type_text = [];
          for(i=0;i<film_type.length;i++){
            if(film_type[i] == "1"){
              film_type_text.push("爱情");
            }
            if(film_type[i] == "5"){
              film_type_text.push("动作");
            }
            if(film_type[i] == "16"){
              film_type_text.push("科幻");
            }
            if(film_type[i] == "13"){
              film_type_text.push("家庭");
            }
            if(film_type[i] == "15"){
              film_type_text.push("剧情");
            }
            if(film_type[i] == "19"){
              film_type_text.push("冒险");
            }
            if(film_type[i] == "20"){
              film_type_text.push("奇幻");
            }
            if(film_type[i] == "25"){
              film_type_text.push("喜剧");
            }
            if(film_type[i] == "27"){
              film_type_text.push("悬疑");
            }
            if(film_type[i] == "14"){
              film_type_text.push("惊悚");
            }
            if(film_type[i] == "22"){
              film_type_text.push("武侠");
            }
            if(film_type[i] == "4"){
              film_type_text.push("动画");
            }
            if(film_type[i] == "7"){
              film_type_text.push("儿童");
            }
            if(film_type[i] == "10"){
              film_type_text.push("古装");
            }
            if(film_type[i] == "17"){
              film_type_text.push("恐怖");
            }
            if(film_type[i] == "30"){
              film_type_text.push("战争");
            }
            if(film_type[i] == "8"){
              film_type_text.push("犯罪");
            }
          }
          return film_type_text.join(",");
        }

        function loadDetails(){
        	var fileName = '<?php echo $_GET['mv'];?>';
          var url = "../Utils/GetVideoListByFileName.php";
        	$.get(url,{fileName:fileName},function(data){
        		var movies = eval('(' +data+ ')');
        		for(var o in movies){
        			var movieSize = (movies[o]["size"]/1024/1024/1024).toFixed(2)+"GB";
        			var play_type = (movies[o]["play_type"]==1) ? "2D":"3D";
              var film_type= movies[o]["film_type"].split(",");
              $("#movieImage").attr('src','/Uploads/pic'+movies[o]["file_path"]+'thumb_l_'+movies[o]["pic"]);
        			$("#detailContent").append("<tr>"
						        				+'<td style="text-align:right;color: #999;height:40px;">电影名称：</td>'
						        				+'<td style="WORD-WRAP: break-word;width:80%;padding-left:15px;">'+movies[o]["file_name"]+'</td>'
						        				+"</tr>"
						        				+"<tr>"
						        				+'<td style="text-align:right;color: #999;height:40px;">时长：</td>'
						        				+'<td style="WORD-WRAP: break-word;width:80%;padding-left:15px;">'+formatSeconds(movies[o]["time"])+'</td>'
						        				+"</tr>"
						        				+"<tr>"
						        				+'<td style="text-align:right;color: #999;height:40px;">大小：</td>'
						        				+'<td style="WORD-WRAP: break-word;width:80%;padding-left:15px;">'+movieSize+'</td>'
						        				+"</tr>"
						        				+"<tr>"
						        				+'<td style="text-align:right;color: #999;height:40px;">上传日期：</td>'
						        				+'<td style="WORD-WRAP: break-word;width:80%;padding-left:15px;">'+unix_to_date(movies[o]["uptime"])+'</td>'
						        				+"</tr>"
						        				+"<tr>"
						        				+'<td style="text-align:right;color: #999;height:40px;">导演：</td>'
						        				+'<td style="WORD-WRAP: break-word;width:80%;padding-left:15px;">'+movies[o]["direct"]+'</td>'
						        				+"</tr>"
						        				+"<tr>"
						        				+'<td style="text-align:right;color: #999;height:40px;">演员：</td>'
						        				+'<td style="WORD-WRAP: break-word;width:80%;padding-left:15px;">'+movies[o]["starring"]+'</td>'
						        				+"</tr>"
						        				+"<tr>"
						        				+'<td style="text-align:right;color: #999;height:40px;">评分：</td>'
						        				+'<td style="WORD-WRAP: break-word;width:80%;padding-left:15px;">'+movies[o]["score"]+'</td>'
						        				+"</tr>"
						        				+"<tr>"
						        				+'<td style="text-align:right;color: #999;height:40px;">语言：</td>'
						        				+'<td style="WORD-WRAP: break-word;width:80%;padding-left:15px;">'+movies[o]["language"]+'</td>'
						        				+"</tr>"
						        				+"<tr>"
						        				+'<td style="text-align:right;color: #999;height:40px;">播放类型：</td>'
						        				+'<td style="WORD-WRAP: break-word;width:80%;padding-left:15px;">'+play_type+'</td>'
						        				+"</tr>"
						        				+"<tr>"
						        				+'<td style="text-align:right;color: #999;height:40px;">影片类型：</td>'
						        				+'<td style="WORD-WRAP: break-word;width:80%;padding-left:15px;">'+toFileTypeText(film_type)+'</td>'
						        				+"</tr>"
						        				+"<tr>"
						        				+'<td style="text-align:right;color: #999;height:40px;">上映日期：</td>'
						        				+'<td style="WORD-WRAP: break-word;width:80%;padding-left:15px;">'+movies[o]["release_date"]+'</td>'
						        				+"</tr>"
						        				+"<tr>"
						        				+'<td style="text-align:right;color: #999;height:40px;">出品国家：</td>'
						        				+'<td style="WORD-WRAP: break-word;width:80%;padding-left:15px;">'+movies[o]["country"]+'</td>'
						        				+"</tr>"
						        				+"<tr>"
						        				+'<td style="text-align:right;color: #999;height:40px;">简介：</td>'
						        				+'<td style="WORD-WRAP: break-word;width:80%;padding-left:15px;">'+movies[o]["drama_cn"]+'</td>'
						        				+"</tr>"
						        				);
        		}
        	})
        }
        function initInfo(){
	        loadDetails();
	    }
	    $(window).load(initInfo());
	    window.onresize=function(){  
                changeImgHeight();  
            }
        function changeImgHeight(){
        	var ImgWidth = $("#movieImage").width();
        	height = ImgWidth * 1.52;
        	$("#movieImage").css("height", height);  // 设定等比例缩放后的高度
        }
        function goBack(){
        	var refurl = '<?php echo $_SERVER['HTTP_REFERER'];?>';
        	window.location.href=refurl;
        }
        </script>
    </head>

    <body style="min-width:988px;">
    	<div class="container main-container">
    		<div id="header" style="width:100%;height:62px;border: 2px solid rgba(0, 0, 0, 0.06);background: #eee;">
    			<h4 style="margin-top:25px;margin-left:20px;font-size:15px;font-style:italic;color: #1da8e1;">影片详情</h4>
    			<button type="button" onclick="goBack()" style="float:right;margin-top:-31px;margin-right:15px;border: solid 1px #b2b2b2;text-align:center;background-color:#eee;color: #1da8e1;">返回</button>
    		</div>
    		<div id="content" style="width:100%;margin-top:25px;">
    			<img id="movieImage" src="" onerror="javascript:this.src='../images/defaultfilm.jpg'" width="36%" height="595">
    		    <table id="detailContent" border="0" align="right" style="word-break:break-all; word-wrap:break-all;width:62%">
				  <!-- 动态加载 -->
				</table>
    		</div>
    	</div>
    </body>
</html>