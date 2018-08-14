<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
      	  <link href="../css/style.css" rel="stylesheet" type="text/css" media="all"/>
	      <link href="../css/bootstrap.min.css" rel="stylesheet">
	      <script src="../js/jquery.min.js"></script>
	      <script src="../js/bootstrap.min.js"></script>
	      <script src="../js/sweetalert.min.js"></script> 
	      <script src="../js/swooleClient.js"></script> 
	      <link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
	      <script type="text/javascript" src="../js/zepto.js?2"></script>
	      <script src="../js/redefinedAlert.js"></script><!-- 重定义alert样式  -->
	      <link rel="stylesheet" href="../css/myFont.css" />
	      <meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- bootstrap中的屏幕自适应，能够使不同屏幕大小布局相同 -->
    </head>
    <body>
    	<script type="text/javascript">
	        function GetQueryString(name) {//使用正则表达式获取当前页面的参数
	          var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)","i");
	          var r = window.location.search.substr(1).match(reg);
	          if (r!=null) return (r[2]); 
	          return null;
	        }

	        function queryMovieList() {
	        	$.get("../Controller/MovieController.php?method=getSavedListByUrlListName",{listName:GetQueryString("listName")},function(data){
	        		//console.log(data);
		        		movies = eval('(' +data+ ')'); 
		        		for(var o in movies){
		        			
		        			$("#movieTab tbody").append("<tr>"
                                    +"<td>"+movies[o]['id']+"</td>"
                                    +"<td>"+movies[o]['file_name']+"</td>"
                                    +"</tr>"); 
		        		}
	        		}
	        	);
	        	$("#deviceId").val(GetQueryString("deviceId"));
	        	$(".nav,.nav-pills").find('li').eq(GetQueryString("listNum")-1).addClass("active");
	        	$(".nav,.nav-pills").find('a').each(function(index,ele){//为每一个超链接添加设备编号
               		 $(ele).attr('href',"SavedMovieList.php?listNum="+(index+1)+"&deviceId="+GetQueryString("deviceId"));
               		 // alert($(ele).attr('href'));
            	});
	        }		

	        function initInfo(){
		        queryMovieList();
		    }
        </script>

	    <div class="container main-container">
		    <div class="row">
		        <input id="deviceId" type="hidden"  value=""/>
		        <table id="movieTab" class="table table-hover">       
		          <thead>
		            <tr>
		            	<th>影片id</th>
		              	<th>影片名</th>
		            </tr>
		          </thead>

		          <tbody>
		          <!--   动态添加表格项   -->
		          </tbody>
		        </table>
		    </div>

		</div>

	

		<script type="text/javascript">
    		window.onload=initInfo();
  		</script>

    </body>
</html>