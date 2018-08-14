<!DOCTYPE HTML>
<html>
    <head>
     	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<!--       	<link href="../css/style.css" rel="stylesheet" type="text/css" media="all"/> -->
	    <link href="../css/bootstrap.min.css" rel="stylesheet">
	    <script src="../js/jquery.min.js"></script>
	    <script src="../js/bootstrap.min.js"></script>
	    <script src="../js/jquery.cookie.js"></script>
	    <script src="../js/sweetalert.min.js"></script> 
	    <script src="../js/swooleClient.js"></script> 
	    <link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
	    <link rel="stylesheet" href="../css/myFont.css" />
	    <script type="text/javascript" src="../js/zepto.js?2"></script>
	    <script src="../js/redefinedAlert.js"></script><!-- 重定义alert样式  -->
	    <meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- bootstrap中的屏幕自适应，能够使不同屏幕大小布局相同 -->
        <style type="text/css">
            *{padding:0;margin:0;}
            body{
            	min-width: 988px;
            }
        	.playButton{/*播放按钮内容居中*/
          		text-align: center; 
          		height:38px;
        	}
        	#chooseDevice{
        		height:206px;
        		border-radius: 12px;
        		min-width: 988px;
        	} 
        	#chooseDevice .deviceName{
        		height:206px;
        		width: 25%;
        		border-radius: 12px;
        		text-align: center;
        		float: left;
        		background-color: rgba(40, 60, 81, 0.84);
        		/*border: 2px solid #8a6d3b;*/
        		box-shadow: 2px 2px 7px #888888; 
        		color: #FFFFFF;
        	}
        	#chooseDevice .deviceName h1{
        		padding-top:50px;
        	}
        	#chooseDevice .deviceName h2{
        		padding-top:40px;
        		display: none;
        	}
        	#chooseDevice .deviceName .h5{
        		padding-top:20px;
        	}
        	#chooseDevice .deviceName h5{
        		display: none;
        	}
        	#chooseDevice .deviceChoose{
        		height:206px;
        		border-radius: 12px;
        		text-align: center;
        		width: 75%;
        		float: left;
        		border-radius: 12px;
        		background-color: rgba(40, 60, 81, 0.84);
        		box-shadow: 2px 2px 7px #888888;
        		color: #FFFFFF;
        	}
        	#chooseDevice .deviceChoose h3{
        		font-size: 18px;
        	}
        	#chooseDevice .deviceChoose .selectdevice{
        		width: 100%;
        		float: left;
        	}
        	#chooseDevice .deviceChoose .selectdevice h5{
        		margin-left: 22%;
        		float: left;
        	}
        	#chooseDevice .deviceChoose .selectdevice #selectGroup{
        		width: 128px;
	            height: 30px;
	            color: #555;
	            padding: 6px 8px;
	            background-color: #fff;
	            border: 1px solid #ccc;
	            border-radius: 4px;
        		margin-left: 10px;
        		float: left;
        		font-size: 12px;
        	}
        	#chooseDevice .deviceChoose .selectdevice .deviceCode{
        		float: left;
        		width: 200px;
        		height: 30px;
        		font-size: 12px;
        		margin-left: 24px;
        	}
        	#chooseDevice .deviceChoose .selectdevice .select{
        		float: left;
        		height: 30px;
        		font-size: 12px;
        		margin-left: 5px;
        	}
        	#chooseDevice .deviceChoose .selectdevice .cancel{
        		float: left;
        		height: 30px;
        		font-size: 12px;
        		margin-left: 5px;
        	}
        	.devicelist{
        		height: 110px;
        		width: 50%;
        		margin: 0 auto;
        		margin-top: 49px;
        		border-radius: 12px;
        		background-color: #FFFFFF;
        		color: hsl(38, 47%, 41%);
        		overflow-y:scroll;
        		overflow-x:hidden;
        	}
        	.devicelist::-webkit-scrollbar {
			    width:10px;
			    height:10px;
			}
			.devicelist::-webkit-scrollbar-button    {
			    display: none;
			}
			.devicelist::-webkit-scrollbar-track     {
			    display: none;
			}
			.devicelist::-webkit-scrollbar-thumb{
			    background:hsl(38, 47%, 41%);
			    border-radius:12px;
			}
			.devicelist::-webkit-scrollbar-corner {
			    background:#82AFFF;
			}
			.devicelist::-webkit-scrollbar-resizer  {
			    background:#FF0BEE;
			}
        	.choose{
        		margin-top: -64px;
        		margin-right: -628px;
        		width: 86px;
        	}
        	.devicelist table{
        		margin: 0 auto;
        	}
      	</style>     
    </head>
    <body>
    	<script type="text/javascript">
	        function GetQueryString(name) {//使用正则表达式获取当前页面的参数
	          var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)","i");
	          var r = window.location.search.substr(1).match(reg);
	          if (r!=null) return (r[2]); 
	          return null;
	        }

	        function formatSeconds(value) {

		        var second = parseInt(value);// 秒
		        var minute = 0;// 分
		        var hour = 0;// 小时
		        if(second >= 60) {
		            minute = parseInt(second/60);
		            second = parseInt(second%60);
		            if(minute >= 60) {
		            	hour = parseInt(minute/60);
		                minute = parseInt(minute%60);
		            }
	          	}

	          	if(hour<10){
			        hour = "0" + hour;
			    }
			    if(minute<10){
			    	minute = "0" + minute;
			    }
			    if(second<10){
			        second = "0" + second;
			    }
 	
 				var result = ""+second;
 				result = ""+minute+":"+result;
	            result = ""+hour+":"+result;

	          	return result;
        	}

        	function unix_to_datetime(unix) {
	         	var now = new Date(parseInt(unix) * 1000);
	         	return now.toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ");
        	}

	        function queryMovieList() {
	              var deviceId = $.cookie("deviceId");        	
	        	  $.get("../Controller/MovieController.php?method=getMovieList&&devid="+deviceId,{},function(data){

		        		movies = eval('(' +data+ ')'); 
		        		for(var o in movies){
		        			
		        			$("#movieTab tbody").append("<tr>"
                                    +"<td>"+movies[o]['id']+"</td>"
                                    +"<td>"+movies[o]['file_name']+"</td>"
                                    +"<td class='playButton'>"+'<button onclick="playMovie(this)" class="btn btn-primary  btn-md">播放</button>'+"</td>"

                                    +"</tr>"); 
		        		}
	        		}
	        	);        	
	       
	        }

	        function sortById(){
	        	var devid = $.cookie("deviceId");
	        	  var playsortType = $.cookie("playsortType");
		          if(playsortType != "idU" && playsortType != "idD"){
		            $.cookie('playsortType', 'idU', { expires: 7 });   //第一次点击ID升序排列
		          }else{
		            if(playsortType == "idU"){
		              $.cookie('playsortType', 'idD', { expires: 7 });   //从升序变为降序
		            }else{
		              $.cookie('playsortType', 'idU', { expires: 7 });   //从降序变为升序
		            }
		          }
		          $.get("../Controller/MovieController.php?method=getMovieList&&devid="+devid,{},function(data){
		        		movies = eval('(' +data+ ')');
		        		var playsortType = $.cookie("playsortType");
		        		function sortId(movies){
		        			if(playsortType == "idU"){
			        			for(var i=0;i<movies.length;i++){
				                  for(var j=i;j<movies.length;j++){
				                    if(parseInt(movies[i]["id"])>parseInt(movies[j]["id"])){
				                       var temp = movies[i];
				                       movies[i] = movies[j];
				                       movies[j] = temp;
				                    }
				                  }           
				                }
			        		}else{
			        			for(var i=0;i<movies.length;i++){
				                  for(var j=i;j<movies.length;j++){
				                    if(parseInt(movies[i]["id"])<parseInt(movies[j]["id"])){
				                       var temp = movies[i];
				                       movies[i] = movies[j];
				                       movies[j] = temp;
				                    }
				                  }           
				                }
			        		}
			        		return movies;
		        		}
		        		$("#movieTab tbody tr").remove();
		        		for(var o in sortId(movies)){
		        			//console.log(movies[o]['id']);
		        			$("#movieTab tbody").append("<tr>"
                                    +"<td>"+movies[o]['id']+"</td>"
                                    +"<td>"+movies[o]['file_name']+"</td>"
                                    +"<td class='playButton'>"+'<button onclick="playMovie(this)" class="btn btn-primary  btn-md">播放</button>'+"</td>"

                                    +"</tr>"); 
		        		}
	        		});

	        }

	        function sortByFileName(){
	        	var devid = $.cookie("deviceId");
	        	var playsortType = $.cookie("playsortType");
		        if(playsortType != "fileNameU" && playsortType != "fileNameD"){
		            $.cookie('playsortType', 'fileNameU', { expires: 7 });   //第一次点击ID升序排列
		        }else{
		          if(playsortType == "fileNameU"){
		              $.cookie('playsortType', 'fileNameD', { expires: 7 });   //从升序变为降序
		          }else{
		              $.cookie('playsortType', 'fileNameU', { expires: 7 });   //从降序变为升序
		          }
		        }

		        $.get("../Controller/MovieController.php?method=getMovieList&&devid="+devid,{},function(data){
		        		videos = eval('(' +data+ ')');
		        		var playsortType = $.cookie("playsortType");
		        		function pySegSort(videos,empty) {
			                if(!String.prototype.localeCompare)
			                  return null;

			                var letters ="abcdefghjklmnopqrstwxyz".split('');
			                var EN ="ABCDEFGHJKLMNOPQRSTWXYZ".split('');
			                var zh ="啊把差大额发噶哈级卡啦吗那哦爬器然啥他哇西呀咋".split('');

			                var curr = [];
			                var sortType = $.cookie("playsortType");
			                if(sortType == "fileNameU"){
			                  for(i=0;i<letters.length;i++){
			                    for(j=0;j<videos.length;j++){
			                      if(((!zh[i] || zh[i].localeCompare(videos[j]["file_name"]) <= 0) && videos[j]["file_name"].localeCompare(zh[i+1]) == -1) || ((!EN[i] || EN[i].localeCompare(videos[j]["file_name"]) <= 0) && videos[j]["file_name"].localeCompare(EN[i+1]) == -1)) {
			                        curr.push(videos[j]);
			                      }
			                    }
			                  }
			                }else{
			                  for(i=letters.length;i>=0;i--){
			                    for(j=0;j<videos.length;j++){
			                      if(((!zh[i] || zh[i].localeCompare(videos[j]["file_name"]) >= 0) && videos[j]["file_name"].localeCompare(zh[i-1]) >= 0) || ((!EN[i] || EN[i].localeCompare(videos[j]["file_name"]) >= 0) && videos[j]["file_name"].localeCompare(EN[i-1]) >= 0)) {
			                        curr.push(videos[j]);
			                      }
			                    }
			                  }
			                }
			                return curr;
			            }
			            var VideoList = pySegSort(videos);
		        		$("#movieTab tbody tr").remove();
		        		for(var o in VideoList){
		        			$("#movieTab tbody").append("<tr>"
                                    +"<td>"+VideoList[o]['id']+"</td>"
                                    +"<td>"+VideoList[o]['file_name']+"</td>"
                                    +"<td class='playButton'>"+'<button onclick="playMovie(this)" class="btn btn-primary  btn-md">播放</button>'+"</td>"

                                    +"</tr>"); 
		        		}
	        		});
	        }

	        function playMovie(curItem){
	        	var deviceId = $.cookie("deviceId");
	        	swal({  
			        		title:"",  
			        		text:"确定要播放: "+$(curItem).parent().prev().html()+"吗？",  
			        		type:"warning",  
			        		showCancelButton:"true",  
			        		showConfirmButton:"true",  
			        		confirmButtonText:"确定",  
			        		cancelButtonText:"取消",  
			        		animation:"slide-from-top"  
			      	}, function() {  
			      		show_loading();
			     		//console.log($("#devid").val());
			      		postOrder("play",deviceId.toLowerCase(),$(curItem).parent().prev().prev().html(),$(curItem).parent().prev().html());//下发采用websocket通道，下发函数不同提供ip,需要传递参数
				      	// $.ajax({  
				       //    	type:"get",  
				       //    	url:"DeviceController.php?method=postOrder",  
				       //    	data:{"flag":"play","devid":$("#devid").val(),"ip":$("#ip").val(),"id":$(curItem).parent().prev().prev().html(),"file_name":$(curItem).parent().prev().html()}  
				      	// }).done(function(data) {  
				       //          swal(data,"success");  				        
				       //       }).error(function(data) {  
				       //          swal("请重试");  
				       //       });  
				});  
	        	clearInterval(timer);
	        	window.setTimeout("close_loading();resetTimer();",5000);
	        }

	        function stopMovie(curItem){
	        	// console.log($(curItem).parent().prev().prev().prev().children("span:last").html());
	        	// console.log($(curItem).parent().prev().prev().html());
	        	var filename=$(curItem).parent().prev().prev().prev().children("span:last").html();
	        	// console.log(filename);
	        	var deviceId = $.cookie("deviceId");
	     		swal({  
			 	    title:"",  
			 	    text:"确定要停止播放: "+$(curItem).parent().prev().prev().prev().children("span:last").html()+"吗？",  
			 	    type:"warning",  
			 	    showCancelButton:"true",  
			 	    showConfirmButton:"true",  
			 	    confirmButtonText:"确定",  
			 	    cancelButtonText:"取消",  
			 	    animation:"slide-from-top"  
			 	}, function() {
			 		//show_loading();
			 		postOrder("stop",deviceId.toLowerCase(),"XXXXXX",filename);//注意要将id转换为小写交给后端匹配
	 	       		// $.ajax({  
 	          //  			type:"get",  
 	          //  			url:"DeviceController.php?method=postOrder",  
 	          //  			data:{"flag":"stop","devid":$("#devid").val(),"ip":$("#ip").val(),"id":"XXXXXX","file_name":filename}  //id默认XXX
 	       			// }).done(function(data) {  				
 	          //        		swal(data,"success");  				        
 	          //     		}).error(function(data) {  
 	          //        		swal("请重试");  
 	          //     	});  
				}); 

	        	// $.get("DeviceController.php?method=postOrder",{flag:"stop",devid:$("#devid").val(),ip:$("#ip").val(),id:$(curItem).parent().prev().prev().html(),file_name:$(curItem).parent().prev().html()},function(data){
	        	// 	swal(data); 
	        	// });
				resetTimer();
	        	// clearInterval(timer);
	        	// window.setTimeout("close_loading();resetTimer();",5000);
	        }

	        function resetTimer(){
	        	queryDeviceStatus();
				timer=window.setInterval(queryDeviceStatus,3000);
	        }

	        function testDevice(){
	            var deviceId = $.cookie("deviceId");
	            var online;   
	            //动态生成设备表
	            $.ajax({
	              type: "GET",
		          url: "../Controller/DeviceController.php?method=getOnlineDevices",
		          data: "deviceId="+deviceId,
		          async: false,                 //改变ajax的执行顺序，使它先执行
		          success: function(data){
		            online = data;
		          }
		        });
		        return online;
	        }

			function chooseDevice(index){
			    $("#choosenDevice").remove();
			    if(alias[index]!=undefined){
			    	$("#selectDevice").parent().parent().append("<button id='choosenDevice' class='glyphicon glyphicon-hdd btn btn-default dropdown-toggle'><font color='blue'> "+alias[index]+"</font>已选中</button>"); 
			    	$("#devid").val(devid[index]);//添加已选中设备id 
			    	$("#ip").val(ip[index]);//添加已选中
			    	$("#movieTab tbody").children().remove()
			    	queryMovieList($("#devid").val());
			    	queryDeviceStatus();
			    	$.get("../Utils/ChoosedDevice.php?method=save&deviceIndex="+index,{},function(data){ //在session中注册index 
            			;  
        			});
			    }
			}

			function queryDeviceStatus(){
				var deviceId = $.cookie("deviceId");
				$.ajaxSetup({  
			     	async : false //取消异步  
			    });   
				$.get("../Controller/DeviceController.php?method=getDeviceStatus",{devid:deviceId},function(data){
				 	var device=eval('(' +data+ ')');
				 	if(device['status']!=$("#deviceStatus thead tr td:eq(0)").html()||
				 		device['curmovie']!=$("#deviceStatus thead tr td:eq(1)").html()||
				 		device['status']=="undefined"||device['curmovie']=="undefined"){//当设备状态为空或设备状态没有改变时不做刷新
				 		var status;
				 		var color="";
				 		switch(device['status']){
				 			case '1':
					 			status="播放电影";
					 			color="#3470AB";
					 			break;

				 			case '2':
					 			status="播放广告";
					 			color="#3470AB";
					 			break;

				 			case '3':
					 			status="待机";
					 			color="#FF5500";
					 			break;

				 			case '4':
					 			status="下载影片";
					 			color="#7AB900";
					 			break;

				 			case '5':
					 			status="下载广告";
					 			color="#7AB900";
					 			break;

					 		case '6':
					 			status="离线";
					 			color="#FF5500";
					 			break;

				 			default:
				 				status="关机";
              					color="#FF5500";

				 		}

					 	$("#deviceStatus thead tr").find('td').remove();
					 	$("#deviceStatus thead tr").append('<td><span style="font-weight:bold;">设备状态：</span>'+"<span style='color:"+color+"';>"+status+"</span></td>"
					 		
					 		);

					 	if(status=='播放电影'||status=='播放广告'){

		    				var movieName=device['curmovie'];
					 		$("#deviceStatus thead tr").append('<td><span style="font-weight:bold;">影片名称：</span>'+'<span>'+device['curmovie']+'</span></td>'
					 			+'<td><span style="font-weight:bold;">已播放：</span>'+formatSeconds(device['curr_pos'])+"</td>");
					 			$.get("../Controller/MovieController.php?method=getMovieTime",{movie:movieName},function(data){
					 			
										$("#deviceStatus thead tr").append("<td><span style='font-weight:bold;'>"+"影片时长：</span>"+formatSeconds(data)+"</td>");
										$("#deviceStatus thead tr").append('<td><button onclick="stopMovie(this)" class="btn btn-danger  btn-md ">停止播放</button></td>');
									});
					 			
					 	}
					 }
				});
			}

			function loadGroup(){
				$.post('../Controller/DeviceController.php?method=getGroup', {}, function(data){
                    var grouplist = eval("("+data+")");
                    $("#selectGroup option").remove();
                    $("#selectGroup").append('<option selected="">请选择组别</option>');
                    for(var o in grouplist){
                        $("#selectGroup").append('<option>'+grouplist[o]['group_name']+'</option>')
                    }
                })
			}

			function loadDevice(){
				var deviceName = $.cookie('deviceName');
				var deviceGroup = $.cookie('deviceGroup');
				var deviceId = $.cookie('deviceId');
				$("#chooseDevice .deviceName h2").html(deviceName);
				$("#chooseDevice .deviceName .h5").html(deviceGroup);
				$("#chooseDevice .deviceName .h52").html(deviceId);
				$("#chooseDevice .deviceName h1").hide();
				$("#chooseDevice .deviceName h2,h5").show();
			}

			$(function(){
				$(".choose").click(function(){
					var deviceId = $('input[name="deviceId"]:checked').parent().next().html();
					var deviceName = $('input[name="deviceId"]:checked').parent().next().next().html();
					var deviceGroup = $('input[name="deviceId"]:checked').parent().next().next().next().html();
					$("#chooseDevice .deviceName h2").html(deviceName);
					$("#chooseDevice .deviceName .h5").html(deviceGroup);
					$("#chooseDevice .deviceName .h52").html(deviceId);
					$("#chooseDevice .deviceName h1").hide();
					$("#chooseDevice .deviceName h2,h5").show();
					$("#movieTab tbody").children().remove();
					$.cookie('deviceId', deviceId, { expires: 7 });
					$.cookie('deviceName', deviceName, { expires: 7 });
					$.cookie('deviceGroup', deviceGroup, { expires: 7 });
			    	queryMovieList();
			    	queryDeviceStatus();
				})

				$(".select").click(function(){
					var group_name = $("#selectGroup").val();
					var deviceCode = $(".deviceCode").val();
					if(group_name == "请选择组别"){
						group_name = "";
					}
					$.post('../Controller/DeviceController.php?method=selectdevice', {group_name:group_name,deviceCode:deviceCode}, function(data){
	                    var devices = eval("("+data+")");
	                    $(".devicelist tbody tr").remove();
	                    for(var o in devices){
	                    	$(".devicelist tbody").append("<tr>"
	                    	                          +'<td width="25px"><input name="deviceId" type="radio" value="" /></td>'
	                    	                          +'<td width="200px">'+devices[o]['deviceid']+'</td>'
	                    	                          +'<td width="200px">'+devices[o]['alias']+'</td>'
	                    	                          +'<td width="200px">'+devices[o]['group_name']+'</td>'
	                    	                          +'<tr>'
	                    	                          )
	                    }
	                })
				})

                $(".cancel").click(function(){
                	$("#selectGroup").val("请选择组别");
                	$(".deviceCode").val("");
                	$(".devicelist tbody tr").remove();
                })
			})

	        function initInfo(){
	        	loadGroup();
	        	var online = testDevice();
	        	if(online == 1){
	        		queryMovieList();
			        loadDevice();
	        	}
		    }
        </script>

	    <div class="container main-container">
	    	<div class="row" id="chooseDevice">
          		<div class="deviceName">
          			<h1>影厅</h1>
          			<h2>胡的影厅</h2>
          			<h5 class="h5">朝阳区</h5>
          			<h5 class="h52">0040ca99a271</h5>
          		</div>
          		<div class="deviceChoose">
          			<h3>设备控制</h3>
          			<div  class="selectdevice">
          				<h5>选择组别:</h5>
      					<select id="selectGroup">
                           <option selected="">请选择组别</option>
                           <option>朝阳区</option>
                           <option>海淀区</option>
                        </select>
                        <input class="form-control deviceCode" type="text" placeholder="请输入关键词">
  						<button type="button" class="btn btn-info select">搜索</button>
  						<button type="button" class="btn btn-info cancel">取消</button>
          			</div>
          			<div class="deviceContent">
	          			<div class="devicelist">
	          				<table border="1" width="100%" cellpadding="0" cellspacing="0" bordercolor="#8a6d3b">
		          				<tbody>
								  <!-- 动态加载 -->
								</tbody>
							</table>
	          			</div>
	          			<button type="button" class="btn btn-info choose">选择</button>
	          		</div>
          		</div>
          	</div>
          	<div class="row" style="min-width: 1088px;">
	    		<br>
	    		<br>
	    			<legend>设备状态</legend>
	    			<table id="deviceStatus" class="table table-hover ">       
			          <thead>
			            <tr>
			            	<!--   动态添加设备状态   -->
			            </tr>
			          </thead>
			        </table>
	    		<br>
	    		<br>
          	</div>

		    <div class="row"  style="min-width: 1088px;">
		        <legend>影片列表</legend>
		        <input id="deviceId" type="hidden"  value=""/>
		        <table id="movieTab" class="table table-hover table-striped table-bordered">       
		          <thead>
		            <tr>
		            	<th class="col-lg-2"><a href="javascript:;" style="text-decoration: none;" onclick="sortById()">影片id&#8593&#8595</a></th>
		              	<th class="col-lg-4"><a href="javascript:;" style="text-decoration: none;" onclick="sortByFileName()">影片名&#8593&#8595</a></th>
		              	<th class="col-lg-2 playButton">操作</th>
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
    		timer=window.setInterval(queryDeviceStatus,1000);
  		</script>

    </body>
</html>