<!DOCTYPE HTML>
<html>
    <head>
      <meta http-equiv="content-type" content="text/html; charset=UTF-8">
       <!--  <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/> -->
      <link href="../css/bootstrap.min.css" rel="stylesheet">
      <script src="../js/jquery.min.js"></script>
      <script src="../js/jquery.cookie.js"></script>
      <script src="../js/bootstrap.min.js"></script>
      <script src="../js/sweetalert.min.js"></script> 
      <script src="../js/swooleClient.js"></script> 
      <script src="../js/redefinedAlert.js"></script><!-- 重定义alert样式  -->
      <link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
      
      <script type="text/javascript" src="../js/zepto.js?2"></script>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="../css/font-awesome.min.css" rel="stylesheet" />
      <link rel="stylesheet" href="../css/myFont.css" />
      <style type="text/css">/*表格中内容居中*/
        .table th, .table td { 
          text-align: center; 
          height:38px;
        }
      </style>
    </head>
    <body>	
    	<div class="container main-container">
        <h3>播放列表下发</h3>
        <div class="row" >
          <br>
        </div> 
	      <div class="row">
	        	<div class="col-lg-12">
		          	<legend></legend>
		          	<table id="movieTab" class="table table-hover table-striped table-bordered">       
                  <thead>
                    <tr>
                      <th>序号</th>
                      <th>播放列表名称</th>
                      <th>创建时间</th>
                      <th>操作</th>             
                    </tr>
                  </thead>
			            <tbody>
			            <!--   动态添加表格项   -->
			            </tbody>
		         	 </table>
	        	</div>

            <!-- model模态框显示电影列表的内容 -->
            <div id="movieList" class="modal">
              <div class="modal-dialog" style="width:340px;">
                <div class="modal-content">
                  <div class="modal-header" style="height:60px;">
                    <a class="close" data-dismiss="modal">x</a>
                    <h4 style="font-weight:bold">电影列表</h4>
                  </div>
                  <div class="modal-body">
                    <!-- 电影列表内容 -->
                    
                  </div>
                </div>
              </div>
            </div>
            <!-- model -->

            <!-- model模态框，显示要选择的下发列表 -->
            <div id="submitList" class="modal">
              <div class="modal-dialog" style="width:540px;">
                <div class="modal-content">
                  <div class="modal-header" style="height:60px;">
                    <h4 style="font-weight:bold">下发列表</h4>
                  </div>
                  <div class="modal-body"">
                    <!-- 可选的列表 -->
                    
                  </div>

                  <div><!-- 目标下发设备的id和ip -->
                      <input type="hidden" id="devid" name="devid" value="">
                      <input type="hidden" id="devip" name="devip" value="">
                      <input type="hidden" id="deviceName" name="devip" value="">
                  </div>

                  <div class="modal-footer" style="height:60px;">
                    <!-- 按钮 -->
                      <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                      <button id="submitButton" type="button" class="btn btn-primary">下发列表</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- model -->

            <!-- model模态框，显示已下发的播放列表 -->
            <div id="submitedList" class="modal">
              <div class="modal-dialog" style="width:340px;">
                <div class="modal-content">
                  <div class="modal-header" style="height:60px;">
                    <a class="close" data-dismiss="modal">x</a>
                    <h4 style="font-weight:bold">电影列表</h4>
                  </div>
                  <div class="modal-body">
                    <!-- 电影列表内容 -->
                    
                  </div>
                </div>
              </div>
            </div>
            <!-- model -->

          <!-- paging分页 -->
            <div class="showPage"  align="center"  id="showPage" style="display:block;margin-top:0px;">
              <?php
                require_once('../Class/page.class.php'); //分页类
                require('../Model/MovieModel.php'); //引入视频模型类 
                $showrow = 5; //一页显示的行数 
                $curpage = empty($_GET['page']) ? 1 : $_GET['page']; //当前的页,还应该处理非数字的情况 
                $url = "?page={page}"; //分页地址，如果有检索条件 ="?page={page}&q=".$_GET['q']
                $dao = new MovieModel();
                $data = $dao->getSavedMovieListNames();
                $total= count($data);
                if ($total > $showrow){//总记录数大于每页显示数，显示分页 
                  $page = new page($total, $showrow, $curpage, $url, 2); 
                  echo $page->myde_write("saved_list"); 
                } 
              ?> 
            </div> 
          <!-- paging-->
	      </div>

        <!-- 设备列表 -->
        <div class="row" style="margin-top:20px;">
          <div class="col-lg-12">
            <p style="font-size: 21px;margin-bottom:-27px;">设备列表</p>
            <input type="text" id="deviceCode" style="float:left;margin-bottom:15px;margin-left:406px;" placeholder="请输入关键词">
            <input type="button" onclick="deviceSearch()" style="margin-left:6px;border: solid 1px #1da8e1;background-color:#1da8e1;color:#fff;" value="搜索">
            <input type="button" onclick="clearSearch()" style="margin-left:6px;border: solid 1px #1da8e1;background-color:#1da8e1;color:#fff;" value="清空">
            <p style="float:right;margin-right:10px;margin-bottom:5px;">组别数:<b id="groupTimes" style="color:red;margin-left:5px"></b></p>
            <p style="float:right;margin-right:10px;margin-bottom:5px;">设备数:<b id="deviceCount" style="color:red;margin-left:5px"></b></p>
            <legend></legend>

            <table id="deviceTab" class="table table-hover table-striped table-bordered">       
              <thead>
                <tr>
                <!--   <th>是否勾选</th> -->
                  <th><a href="javascript:;" style="text-decoration: none;" onclick="sortByDeviceId()">设备ID&#8593&#8595</a></th>
                <th><a href="javascript:;" style="text-decoration: none;" onclick="sortByDeviceName()">设备名&#8593&#8595</a></th>
                <th><a href="javascript:;" style="text-decoration: none;" onclick="sortByDeviceIp()">设备IP&#8593&#8595</a></th>
                <th><a href="javascript:;" style="text-decoration: none;" onclick="sortByDeviceVersion()">设备版本&#8593&#8595</a></th>  
                <th><a href="javascript:;" style="text-decoration: none;" onclick="sortByDeviceType()">设备类型&#8593&#8595</a></th>
                <th><a href="javascript:;" style="text-decoration: none;" onclick="sortByDeviceGroup()">组别名&#8593&#8595</a></th> 
                  <th>状态</th> 
                  <th>影片名称</th>   
                  <th>当前播放列表</th>
                  <th>下发列表</th>                
                </tr>
              </thead>

              <tbody>
              <!--   动态添加表格项   -->
              </tbody>
            </table>
          </div>
        </div>
        <!-- 设备列表 -->
      </div>
    <script type="text/javascript">
      function unix_to_datetime(unix) {
        var now = new Date(parseInt(unix) * 1000);
        return now.toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ");
      }
      function querySavedList(){    
          //动态生成电影列表
          $.get("../Controller/MovieController.php?method=getSavedMovieListNames",{},function(data){  
            lists= eval('(' +data+ ')');
            function reverseOrder(lists){
                for(var i=0;i<lists.length;i++){
                   for(var j=i;j<lists.length;j++){
                      if(parseInt(lists[i]["create_time"])<parseInt(lists[j]["create_time"])){
                         var temp = lists[i];
                         lists[i] = lists[j];
                         lists[j] = temp;
                      }
                   }           
                }
                return lists;
            } 
            for(var o in reverseOrder(lists)){
              var curpage = <?php echo $curpage = empty($_GET['page']) ? 1 : $_GET['page'];?>;
              if(o>=(curpage-1)*5&&o<curpage*5){
                var line=parseInt(o)%5;
                listNu=parseInt(o)+1;
                var listName=lists[o]['list_name'];
                $("#movieTab tbody").append("<tr>"+'<td>'+listNu+'</td>'   
                                          +'<td>'+lists[o]['list_name']+'</td>'
                                          +'<td>'+unix_to_datetime(lists[o]['create_time'])+'</td>'                              
                                          +'<td><a href="#movieList" data-toggle="modal" class="btn btn-primary btn-large">查看</a></td></tr>');
                
                
                $("#movieTab tbody tr:eq("+line+") td:eq(3) a").click({listName:listName},function(evt){ 
                  $("#movieList .modal-body").html("<iframe style='height:340px;box-shadow:0px 0px 1px 1px #888888;' frameborder='0' src='SavedMovieList.php?listName="+evt.data.listName+"'></iframe>");
                });
               
              }
             
            }
           
          });
      }

      function queryDeviceList(){    
          //动态生成设备列表
          $.get("../Controller/DeviceController.php?method=getDevices",{},function(data){  
            devices = eval('(' +data+ ')');
            var newArr = [];
            for(var i =0;i<devices.length;i++){
              if(newArr.indexOf(devices[i]['group_name']) == -1){
                  newArr.push(devices[i]['group_name']);
              }
            }
            $("#deviceCount").html(devices.length+"台");
            $("#groupTimes").html(newArr.length+"组"); 
            for(var o in devices){
              var status="";
              var color="";
              var isOnline=(devices[o]["online"]==1)?"在线":"离线";
              switch(devices[o]['status']){
                case '1':
                  status="正在播放";
                  color="#3470AB";
                  break;

                case '2':
                  status="正在播放";
                  color="#3470AB";
                  break;

                case '3':
                  status="待机";
                  color="#808080";
                  break;

                case '4':
                  status="正在下载";
                  color="#7AB900";
                  break;

                case '5':
                  status="正在下载";
                  color="#7AB900";
                  break;

                default:
                  status="离线";
                  color="#FF5500";

              }

              if(isOnline=="离线"){
                status="离线";
                color="#FF5500";
              }

              var curmovie="";

              if(devices[o]["deviceid"]!=""){
                if((isOnline=="离线")||(devices[o]["curmovie"]=="")){
                  curmovie="无影片";
                }else{
                  curmovie=devices[o]["curmovie"];
                }
                var deviceListContent="<tr>"                                       
                                        +"<td>"+'<div class="center-block">'+devices[o]["deviceid"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["alias"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["ip"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["version"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["type"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["group_name"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+"<span style='color:"+color+"';>"+status+"</span></div></td>"
                                        +"<td>"+'<div class="center-block">'+curmovie+"</div></td>"          
                                        +"<td>"+'<div class="center-block">'+'<a href="#submitedList" data-toggle="modal" class="btn btn-primary btn-large">'+'查看</a>'+"</div></td>";
               if(isOnline!="离线"){
                deviceListContent=deviceListContent+"<td>"+'<div class="center-block">'+'<a href="#submitList" data-toggle="modal" class="btn btn-success btn-large" style="background-color:#00EC00;">'+'选择电影列表</a>'+"</div></td>"
                                      +"</tr>";
               }else{
                deviceListContent=deviceListContent+"<td>"+'<div class="center-block">'+'<a href="#" onClick="'+"swal('设备离线 不能下发列表');"+'" data-toggle="modal" class="btn btn-success btn-large" style="background-color:#FF2D2D;">'+'设备离线</a>'+"</div></td>"
                                      +"</tr>";
               }
                
                $("#deviceTab tbody").append(deviceListContent);

                $("#deviceTab .btn.btn-primary.btn-large:eq("+o+")").click({index:o,deviceId:devices[o]["deviceid"]},function(evt){//查看当前列表按钮
                  $("#submitedList .modal-body").html("<iframe style='height:340px;box-shadow:0px 0px 1px 1px #888888;' frameborder='0' src='DeviceDetails.php?deviceid="+evt.data.deviceId+"'></iframe>");
                });

                $("#deviceTab .btn.btn-success.btn-large:eq("+o+")").click({deviceId:devices[o]["deviceid"],deviceIp:devices[o]["ip"],deviceName:devices[o]["alias"]},function(evt){//选择要下发的列表按钮 
                      $.get("../Controller/MovieController.php?method=getSavedMovieListNames",{},function(data){
                        var listsHtml="<div id='chooseList'><table> ";
                        lists= eval('(' +data+ ')');
                        function reverseOrder(lists){
                            for(var i=0;i<lists.length;i++){
                               for(var j=i;j<lists.length;j++){
                                  if(parseInt(lists[i]["create_time"])<parseInt(lists[j]["create_time"])){
                                     var temp = lists[i];
                                     lists[i] = lists[j];
                                     lists[j] = temp;
                                  }
                               }           
                            }
                            return lists;
                        } 
                        for(var o in reverseOrder(lists)){//单选radio
                          var listName=lists[o]['list_name'];
                          if(o%4==0){
                           listsHtml+='<tr>';
                          }
                          listsHtml+='<td style="padding:15px;"><label class="radio-inline">'+'<input type="radio" name="listOptions" value="'+listName+'">'+listName+'</label></td>'; 
                          if(o%4==3){
                            listsHtml+='</tr>';
                          }
                        }
                        if(o%4!=3){
                          listsHtml+='</tr>';
                        }
                        listsHtml+='</table></div>';//end of listsHtml 
                        //alert(listsHtml);
                        $("#devid").val(evt.data.deviceId);//设置下发设备的id
                        $("#devip").val(evt.data.deviceIp);//设置下发设备的ip
                        $("#deviceName").val(evt.data.deviceName);//设置下发设备的别名

                        $("#submitList .modal-body").html(listsHtml);   
                      });

                });
              }  
            }
        });
      }

      function sortByDeviceId(){
        var subsortType = $.cookie("subsortType");
        if(subsortType != "idU" && subsortType != "idD"){
          $.cookie('subsortType', 'idU', { expires: 7 });   //第一次点击ID升序排列
        }else{
          if(subsortType == "idU"){
            $.cookie('subsortType', 'idD', { expires: 7 });   //从升序变为降序
          }else{
            $.cookie('subsortType', 'idU', { expires: 7 });   //从降序变为升序
          }
        }
        $("#deviceTab tbody tr").remove();
        var deviceCode = $("#deviceCode").val();
        $.post("../Controller/DeviceController.php?method=deviceSearch",{deviceCode:deviceCode},function(data){
            devices = eval('(' +data+ ')');
            function sortById(devices){
              var subsortType = $.cookie("subsortType");
              if(subsortType == "idU"){
                for(var i=0;i<devices.length;i++){
                  for(var j=i;j<devices.length;j++){
                    if(devices[i]["deviceid"]>devices[j]["deviceid"]){
                       var temp = devices[i];
                       devices[i] = devices[j];
                       devices[j] = temp;
                    }
                  }           
                }     
              }else{
                for(var i=0;i<devices.length;i++){
                  for(var j=i;j<devices.length;j++){
                    if(devices[i]["deviceid"]<devices[j]["deviceid"]){
                       var temp = devices[i];
                       devices[i] = devices[j];
                       devices[j] = temp;
                    }
                  }           
                }
              }
              return devices;
            }  
            for(var o in sortById(devices)){
              var status="";
              var color="";
              var isOnline=(devices[o]["online"]==1)?"在线":"离线";
              switch(devices[o]['status']){
                case '1':
                  status="正在播放";
                  color="#3470AB";
                  break;

                case '2':
                  status="正在播放";
                  color="#3470AB";
                  break;

                case '3':
                  status="待机";
                  color="#808080";
                  break;

                case '4':
                  status="正在下载";
                  color="#7AB900";
                  break;

                case '5':
                  status="正在下载";
                  color="#7AB900";
                  break;

                default:
                  status="离线";
                  color="#FF5500";

              }

              if(isOnline=="离线"){
                status="离线";
                color="#FF5500";
              }

              var curmovie="";

              if(devices[o]["deviceid"]!=""){
                if((isOnline=="离线")||(devices[o]["curmovie"]=="")){
                  curmovie="无影片";
                }else{
                  curmovie=devices[o]["curmovie"];
                }
                var deviceListContent="<tr>"                                       
                                        +"<td>"+'<div class="center-block">'+devices[o]["deviceid"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["alias"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["ip"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["version"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["type"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["group_name"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+"<span style='color:"+color+"';>"+status+"</span></div></td>"
                                        +"<td>"+'<div class="center-block">'+curmovie+"</div></td>"          
                                        +"<td>"+'<div class="center-block">'+'<a href="#submitedList" data-toggle="modal" class="btn btn-primary btn-large">'+'查看</a>'+"</div></td>";
               if(isOnline!="离线"){
                deviceListContent=deviceListContent+"<td>"+'<div class="center-block">'+'<a href="#submitList" data-toggle="modal" class="btn btn-success btn-large" style="background-color:#00EC00;">'+'选择电影列表</a>'+"</div></td>"
                                      +"</tr>";
               }else{
                deviceListContent=deviceListContent+"<td>"+'<div class="center-block">'+'<a href="#" onClick="'+"swal('设备离线 不能下发列表');"+'" data-toggle="modal" class="btn btn-success btn-large" style="background-color:#FF2D2D;">'+'设备离线</a>'+"</div></td>"
                                      +"</tr>";
               }
                
                $("#deviceTab tbody").append(deviceListContent);

                $("#deviceTab .btn.btn-primary.btn-large:eq("+o+")").click({index:o,deviceId:devices[o]["deviceid"]},function(evt){//查看当前列表按钮
                  $("#submitedList .modal-body").html("<iframe style='height:340px;box-shadow:0px 0px 1px 1px #888888;' frameborder='0' src='DeviceDetails.php?deviceid="+evt.data.deviceId+"'></iframe>");
                });

                $("#deviceTab .btn.btn-success.btn-large:eq("+o+")").click({deviceId:devices[o]["deviceid"],deviceIp:devices[o]["ip"]},function(evt){//选择要下发的列表按钮 
                      $.get("../Controller/MovieController.php?method=getSavedMovieListNames",{},function(data){
                        var listsHtml="<div id='chooseList'><table> ";
                        lists= eval('(' +data+ ')'); 
                        function reverseOrder(lists){
                            for(var i=0;i<lists.length;i++){
                               for(var j=i;j<lists.length;j++){
                                  if(parseInt(lists[i]["create_time"])<parseInt(lists[j]["create_time"])){
                                     var temp = lists[i];
                                     lists[i] = lists[j];
                                     lists[j] = temp;
                                  }
                               }           
                            }
                            return lists;
                        } 
                        for(var o in reverseOrder(lists)){//单选radio
                          var listName=lists[o]['list_name'];
                          if(o%4==0){
                           listsHtml+='<tr>';
                          }
                          listsHtml+='<td style="padding:15px;"><label class="radio-inline">'+'<input type="radio" name="listOptions" value="'+listName+'">'+listName+'</label></td>'; 
                          if(o%4==3){
                            listsHtml+='</tr>';
                          }
                        }
                        if(o%4!=3){
                          listsHtml+='</tr>';
                        }
                        listsHtml+='</table></div>';//end of listsHtml 
                        //alert(listsHtml);
                        $("#devid").val(evt.data.deviceId);//设置下发设备的id
                        $("#devip").val(evt.data.deviceIp);//设置下发设备的ip
                        $("#deviceName").val(evt.data.deviceName);//设置下发设备的别名

                        $("#submitList .modal-body").html(listsHtml);   
                      });

                });
              }  
            }
        });
      }

      function sortByDeviceIp(){
        var subsortType = $.cookie("subsortType");
        if(subsortType != "ipU" && subsortType != "ipD"){
          $.cookie('subsortType', 'ipU', { expires: 7 });   //第一次点击IP升序排列
        }else{
          if(subsortType == "ipU"){
            $.cookie('subsortType', 'ipD', { expires: 7 });   //从升序变为降序
          }else{
            $.cookie('subsortType', 'ipU', { expires: 7 });   //从降序变为升序
          }
        }
        $("#deviceTab tbody tr").remove();
        var deviceCode = $("#deviceCode").val();
        $.post("../Controller/DeviceController.php?method=deviceSearch",{deviceCode:deviceCode},function(data){
            devices = eval('(' +data+ ')');
            function sortByIp(devices){
              var subsortType = $.cookie("subsortType");
              if(subsortType == "ipU"){
                for(var i=0;i<devices.length;i++){
                  for(var j=i;j<devices.length;j++){
                    if(devices[i]["ip"]>devices[j]["ip"]){
                       var temp = devices[i];
                       devices[i] = devices[j];
                       devices[j] = temp;
                    }
                  }           
                }     
              }else{
                for(var i=0;i<devices.length;i++){
                  for(var j=i;j<devices.length;j++){
                    if(devices[i]["ip"]<devices[j]["ip"]){
                       var temp = devices[i];
                       devices[i] = devices[j];
                       devices[j] = temp;
                    }
                  }           
                }
              }
              return devices;
            }  
            for(var o in sortByIp(devices)){
              var status="";
              var color="";
              var isOnline=(devices[o]["online"]==1)?"在线":"离线";
              switch(devices[o]['status']){
                case '1':
                  status="正在播放";
                  color="#3470AB";
                  break;

                case '2':
                  status="正在播放";
                  color="#3470AB";
                  break;

                case '3':
                  status="待机";
                  color="#808080";
                  break;

                case '4':
                  status="正在下载";
                  color="#7AB900";
                  break;

                case '5':
                  status="正在下载";
                  color="#7AB900";
                  break;

                default:
                  status="离线";
                  color="#FF5500";

              }

              if(isOnline=="离线"){
                status="离线";
                color="#FF5500";
              }

              var curmovie="";

              if(devices[o]["deviceid"]!=""){
                if((isOnline=="离线")||(devices[o]["curmovie"]=="")){
                  curmovie="无影片";
                }else{
                  curmovie=devices[o]["curmovie"];
                }
                var deviceListContent="<tr>"                                       
                                        +"<td>"+'<div class="center-block">'+devices[o]["deviceid"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["alias"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["ip"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["version"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["type"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["group_name"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+"<span style='color:"+color+"';>"+status+"</span></div></td>"
                                        +"<td>"+'<div class="center-block">'+curmovie+"</div></td>"          
                                        +"<td>"+'<div class="center-block">'+'<a href="#submitedList" data-toggle="modal" class="btn btn-primary btn-large">'+'查看</a>'+"</div></td>";
               if(isOnline!="离线"){
                deviceListContent=deviceListContent+"<td>"+'<div class="center-block">'+'<a href="#submitList" data-toggle="modal" class="btn btn-success btn-large" style="background-color:#00EC00;">'+'选择电影列表</a>'+"</div></td>"
                                      +"</tr>";
               }else{
                deviceListContent=deviceListContent+"<td>"+'<div class="center-block">'+'<a href="#" onClick="'+"swal('设备离线 不能下发列表');"+'" data-toggle="modal" class="btn btn-success btn-large" style="background-color:#FF2D2D;">'+'设备离线</a>'+"</div></td>"
                                      +"</tr>";
               }
                
                $("#deviceTab tbody").append(deviceListContent);

                $("#deviceTab .btn.btn-primary.btn-large:eq("+o+")").click({index:o,deviceId:devices[o]["deviceid"]},function(evt){//查看当前列表按钮
                  $("#submitedList .modal-body").html("<iframe style='height:340px;box-shadow:0px 0px 1px 1px #888888;' frameborder='0' src='DeviceDetails.php?deviceid="+evt.data.deviceId+"'></iframe>");
                });

                $("#deviceTab .btn.btn-success.btn-large:eq("+o+")").click({deviceId:devices[o]["deviceid"],deviceIp:devices[o]["ip"]},function(evt){//选择要下发的列表按钮 
                      $.get("../Controller/MovieController.php?method=getSavedMovieListNames",{},function(data){
                        var listsHtml="<div id='chooseList'><table> ";
                        lists= eval('(' +data+ ')'); 
                        function reverseOrder(lists){
                            for(var i=0;i<lists.length;i++){
                               for(var j=i;j<lists.length;j++){
                                  if(parseInt(lists[i]["create_time"])<parseInt(lists[j]["create_time"])){
                                     var temp = lists[i];
                                     lists[i] = lists[j];
                                     lists[j] = temp;
                                  }
                               }           
                            }
                            return lists;
                        } 
                        for(var o in reverseOrder(lists)){//单选radio
                          var listName=lists[o]['list_name'];
                          if(o%4==0){
                           listsHtml+='<tr>';
                          }
                          listsHtml+='<td style="padding:15px;"><label class="radio-inline">'+'<input type="radio" name="listOptions" value="'+listName+'">'+listName+'</label></td>'; 
                          if(o%4==3){
                            listsHtml+='</tr>';
                          }
                        }
                        if(o%4!=3){
                          listsHtml+='</tr>';
                        }
                        listsHtml+='</table></div>';//end of listsHtml 
                        //alert(listsHtml);
                        $("#devid").val(evt.data.deviceId);//设置下发设备的id
                        $("#devip").val(evt.data.deviceIp);//设置下发设备的ip
                        $("#deviceName").val(evt.data.deviceName);//设置下发设备的别名

                        $("#submitList .modal-body").html(listsHtml);   
                      });

                });
              }  
            }
        });
      }

      function sortByDeviceVersion(){
        var subsortType = $.cookie("subsortType");
        if(subsortType != "versionU" && subsortType != "versionD"){
          $.cookie('subsortType', 'versionU', { expires: 7 });   //第一次点击IP升序排列
        }else{
          if(subsortType == "versionU"){
            $.cookie('subsortType', 'versionD', { expires: 7 });   //从升序变为降序
          }else{
            $.cookie('subsortType', 'versionU', { expires: 7 });   //从降序变为升序
          }
        }
        $("#deviceTab tbody tr").remove();
        var deviceCode = $("#deviceCode").val();
        $.post("../Controller/DeviceController.php?method=deviceSearch",{deviceCode:deviceCode},function(data){
            devices = eval('(' +data+ ')');
            function sortByVersion(devices){
              var subsortType = $.cookie("subsortType");
              if(subsortType == "versionU"){
                for(var i=0;i<devices.length;i++){
                  for(var j=i;j<devices.length;j++){
                    if(devices[i]["version"]>devices[j]["version"]){
                       var temp = devices[i];
                       devices[i] = devices[j];
                       devices[j] = temp;
                    }
                  }           
                }     
              }else{
                for(var i=0;i<devices.length;i++){
                  for(var j=i;j<devices.length;j++){
                    if(devices[i]["version"]<devices[j]["version"]){
                       var temp = devices[i];
                       devices[i] = devices[j];
                       devices[j] = temp;
                    }
                  }           
                }
              }
              return devices;
            }  
            for(var o in sortByVersion(devices)){
              var status="";
              var color="";
              var isOnline=(devices[o]["online"]==1)?"在线":"离线";
              switch(devices[o]['status']){
                case '1':
                  status="正在播放";
                  color="#3470AB";
                  break;

                case '2':
                  status="正在播放";
                  color="#3470AB";
                  break;

                case '3':
                  status="待机";
                  color="#808080";
                  break;

                case '4':
                  status="正在下载";
                  color="#7AB900";
                  break;

                case '5':
                  status="正在下载";
                  color="#7AB900";
                  break;

                default:
                  status="离线";
                  color="#FF5500";

              }

              if(isOnline=="离线"){
                status="离线";
                color="#FF5500";
              }

              var curmovie="";

              if(devices[o]["deviceid"]!=""){
                if((isOnline=="离线")||(devices[o]["curmovie"]=="")){
                  curmovie="无影片";
                }else{
                  curmovie=devices[o]["curmovie"];
                }
                var deviceListContent="<tr>"                                       
                                        +"<td>"+'<div class="center-block">'+devices[o]["deviceid"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["alias"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["ip"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["version"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["type"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["group_name"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+"<span style='color:"+color+"';>"+status+"</span></div></td>"
                                        +"<td>"+'<div class="center-block">'+curmovie+"</div></td>"          
                                        +"<td>"+'<div class="center-block">'+'<a href="#submitedList" data-toggle="modal" class="btn btn-primary btn-large">'+'查看</a>'+"</div></td>";
               if(isOnline!="离线"){
                deviceListContent=deviceListContent+"<td>"+'<div class="center-block">'+'<a href="#submitList" data-toggle="modal" class="btn btn-success btn-large" style="background-color:#00EC00;">'+'选择电影列表</a>'+"</div></td>"
                                      +"</tr>";
               }else{
                deviceListContent=deviceListContent+"<td>"+'<div class="center-block">'+'<a href="#" onClick="'+"swal('设备离线 不能下发列表');"+'" data-toggle="modal" class="btn btn-success btn-large" style="background-color:#FF2D2D;">'+'设备离线</a>'+"</div></td>"
                                      +"</tr>";
               }
                
                $("#deviceTab tbody").append(deviceListContent);

                $("#deviceTab .btn.btn-primary.btn-large:eq("+o+")").click({index:o,deviceId:devices[o]["deviceid"]},function(evt){//查看当前列表按钮
                  $("#submitedList .modal-body").html("<iframe style='height:340px;box-shadow:0px 0px 1px 1px #888888;' frameborder='0' src='DeviceDetails.php?deviceid="+evt.data.deviceId+"'></iframe>");
                });

                $("#deviceTab .btn.btn-success.btn-large:eq("+o+")").click({deviceId:devices[o]["deviceid"],deviceIp:devices[o]["ip"]},function(evt){//选择要下发的列表按钮 
                      $.get("../Controller/MovieController.php?method=getSavedMovieListNames",{},function(data){
                        var listsHtml="<div id='chooseList'><table> ";
                        lists= eval('(' +data+ ')'); 
                        function reverseOrder(lists){
                            for(var i=0;i<lists.length;i++){
                               for(var j=i;j<lists.length;j++){
                                  if(parseInt(lists[i]["create_time"])<parseInt(lists[j]["create_time"])){
                                     var temp = lists[i];
                                     lists[i] = lists[j];
                                     lists[j] = temp;
                                  }
                               }           
                            }
                            return lists;
                        } 
                        for(var o in reverseOrder(lists)){//单选radio
                          var listName=lists[o]['list_name'];
                          if(o%4==0){
                           listsHtml+='<tr>';
                          }
                          listsHtml+='<td style="padding:15px;"><label class="radio-inline">'+'<input type="radio" name="listOptions" value="'+listName+'">'+listName+'</label></td>'; 
                          if(o%4==3){
                            listsHtml+='</tr>';
                          }
                        }
                        if(o%4!=3){
                          listsHtml+='</tr>';
                        }
                        listsHtml+='</table></div>';//end of listsHtml 
                        //alert(listsHtml);
                        $("#devid").val(evt.data.deviceId);//设置下发设备的id
                        $("#devip").val(evt.data.deviceIp);//设置下发设备的ip
                        $("#deviceName").val(evt.data.deviceName);//设置下发设备的别名
                        $("#submitList .modal-body").html(listsHtml);   
                      });

                });
              } 
            }
        });
      }

      function sortByDeviceType(){
        var subsortType = $.cookie("subsortType");
        if(subsortType != "typeU" && subsortType != "typeD"){
          $.cookie('subsortType', 'typeU', { expires: 7 });   //第一次点击IP升序排列
        }else{
          if(subsortType == "typeU"){
            $.cookie('subsortType', 'typeD', { expires: 7 });   //从升序变为降序
          }else{
            $.cookie('subsortType', 'typeU', { expires: 7 });   //从降序变为升序
          }
        }
        $("#deviceTab tbody tr").remove();
        var deviceCode = $("#deviceCode").val();
        $.post("../Controller/DeviceController.php?method=deviceSearch",{deviceCode:deviceCode},function(data){
            devices = eval('(' +data+ ')');
            function sortByType(devices){
              var subsortType = $.cookie("subsortType");
              if(subsortType == "typeU"){
                for(var i=0;i<devices.length;i++){
                  for(var j=i;j<devices.length;j++){
                    if(devices[i]["type"]>devices[j]["type"]){
                       var temp = devices[i];
                       devices[i] = devices[j];
                       devices[j] = temp;
                    }
                  }           
                }     
              }else{
                for(var i=0;i<devices.length;i++){
                  for(var j=i;j<devices.length;j++){
                    if(devices[i]["type"]<devices[j]["type"]){
                       var temp = devices[i];
                       devices[i] = devices[j];
                       devices[j] = temp;
                    }
                  }           
                }
              }
              return devices;
            }  
            for(var o in sortByType(devices)){
              var status="";
              var color="";
              var isOnline=(devices[o]["online"]==1)?"在线":"离线";
              switch(devices[o]['status']){
                case '1':
                  status="正在播放";
                  color="#3470AB";
                  break;

                case '2':
                  status="正在播放";
                  color="#3470AB";
                  break;

                case '3':
                  status="待机";
                  color="#808080";
                  break;

                case '4':
                  status="正在下载";
                  color="#7AB900";
                  break;

                case '5':
                  status="正在下载";
                  color="#7AB900";
                  break;

                default:
                  status="离线";
                  color="#FF5500";

              }

              if(isOnline=="离线"){
                status="离线";
                color="#FF5500";
              }

              var curmovie="";

              if(devices[o]["deviceid"]!=""){
                if((isOnline=="离线")||(devices[o]["curmovie"]=="")){
                  curmovie="无影片";
                }else{
                  curmovie=devices[o]["curmovie"];
                }
                var deviceListContent="<tr>"                                       
                                        +"<td>"+'<div class="center-block">'+devices[o]["deviceid"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["alias"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["ip"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["version"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["type"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["group_name"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+"<span style='color:"+color+"';>"+status+"</span></div></td>"
                                        +"<td>"+'<div class="center-block">'+curmovie+"</div></td>"          
                                        +"<td>"+'<div class="center-block">'+'<a href="#submitedList" data-toggle="modal" class="btn btn-primary btn-large">'+'查看</a>'+"</div></td>";
               if(isOnline!="离线"){
                deviceListContent=deviceListContent+"<td>"+'<div class="center-block">'+'<a href="#submitList" data-toggle="modal" class="btn btn-success btn-large" style="background-color:#00EC00;">'+'选择电影列表</a>'+"</div></td>"
                                      +"</tr>";
               }else{
                deviceListContent=deviceListContent+"<td>"+'<div class="center-block">'+'<a href="#" onClick="'+"swal('设备离线 不能下发列表');"+'" data-toggle="modal" class="btn btn-success btn-large" style="background-color:#FF2D2D;">'+'设备离线</a>'+"</div></td>"
                                      +"</tr>";
               }
                
                $("#deviceTab tbody").append(deviceListContent);

                $("#deviceTab .btn.btn-primary.btn-large:eq("+o+")").click({index:o,deviceId:devices[o]["deviceid"]},function(evt){//查看当前列表按钮
                  $("#submitedList .modal-body").html("<iframe style='height:340px;box-shadow:0px 0px 1px 1px #888888;' frameborder='0' src='DeviceDetails.php?deviceid="+evt.data.deviceId+"'></iframe>");
                });

                $("#deviceTab .btn.btn-success.btn-large:eq("+o+")").click({deviceId:devices[o]["deviceid"],deviceIp:devices[o]["ip"]},function(evt){//选择要下发的列表按钮 
                      $.get("../Controller/MovieController.php?method=getSavedMovieListNames",{},function(data){
                        var listsHtml="<div id='chooseList'><table> ";
                        lists= eval('(' +data+ ')'); 
                        function reverseOrder(lists){
                            for(var i=0;i<lists.length;i++){
                               for(var j=i;j<lists.length;j++){
                                  if(parseInt(lists[i]["create_time"])<parseInt(lists[j]["create_time"])){
                                     var temp = lists[i];
                                     lists[i] = lists[j];
                                     lists[j] = temp;
                                  }
                               }           
                            }
                            return lists;
                        } 
                        for(var o in reverseOrder(lists)){//单选radio
                          var listName=lists[o]['list_name'];
                          if(o%4==0){
                           listsHtml+='<tr>';
                          }
                          listsHtml+='<td style="padding:15px;"><label class="radio-inline">'+'<input type="radio" name="listOptions" value="'+listName+'">'+listName+'</label></td>'; 
                          if(o%4==3){
                            listsHtml+='</tr>';
                          }
                        }
                        if(o%4!=3){
                          listsHtml+='</tr>';
                        }
                        listsHtml+='</table></div>';//end of listsHtml 
                        //alert(listsHtml);
                        $("#devid").val(evt.data.deviceId);//设置下发设备的id
                        $("#devip").val(evt.data.deviceIp);//设置下发设备的ip
                        $("#deviceName").val(evt.data.deviceName);//设置下发设备的别名
                        $("#submitList .modal-body").html(listsHtml);   
                      });

                });
              }   
            }
        });
      }


      function sortByDeviceName(){
        var subsortType = $.cookie("subsortType");
        if(subsortType != "devicenameU" && subsortType != "devicenameD"){
          $.cookie('subsortType', 'devicenameU', { expires: 7 });   //第一次点击ID升序排列
        }else{
          if(subsortType == "devicenameU"){
            $.cookie('subsortType', 'devicenameD', { expires: 7 });   //从升序变为降序
          }else{
            $.cookie('subsortType', 'devicenameU', { expires: 7 });   //从降序变为升序
          }
        }
        $("#deviceTab tbody tr").remove();
        var deviceCode = $("#deviceCode").val();
        $.post("../Controller/DeviceController.php?method=deviceSearch",{deviceCode:deviceCode},function(data){
            device = eval('(' +data+ ')');
            function pySegSort(device,empty) {
                if(!String.prototype.localeCompare)
                  return null;

                var letters ="abcdefghjklmnopqrstwxyz".split('');
                var EN ="ABCDEFGHJKLMNOPQRSTWXYZ".split('');
                var zh ="啊把差大额发噶哈级卡啦吗那哦爬器然啥他哇西呀咋".split('');

                var curr = [];
                var subsortType = $.cookie("subsortType");
                if(subsortType == "devicenameU"){
                  for(i=0;i<letters.length;i++){
                    for(j=0;j<device.length;j++){
                      if(/.*[\u4e00-\u9fa5]+.*$/.test(device[j]["alias"].substring(0,1))){ 
                        if((!zh[i] || zh[i].localeCompare(device[j]["alias"]) <= 0) && device[j]["alias"].localeCompare(zh[i+1]) == -1){
                          curr.push(device[j]);
                        }  
                      }else{
                        if((!letters[i] || letters[i].localeCompare(device[j]["alias"]) <= 0) && device[j]["alias"].localeCompare(letters[i+1]) == -1){
                          curr.push(device[j]);
                        }
                      }
                    }
                  }
                }else{
                  for(i=letters.length;i>=0;i--){
                    for(j=0;j<device.length;j++){
                      if(/.*[\u4e00-\u9fa5]+.*$/.test(device[j]["alias"].substring(0,1))){ 
                        if((!zh[i] || zh[i].localeCompare(device[j]["alias"]) >= 0) && device[j]["alias"].localeCompare(zh[i-1]) >= 0){
                          curr.push(device[j]);
                        }  
                      }else{
                        if((!letters[i] || letters[i].localeCompare(device[j]["alias"]) >= 0) && device[j]["alias"].localeCompare(letters[i-1]) >= 0){
                          curr.push(device[j]);
                        }
                      }
                    }
                  }
                }
                return curr;
            }
            var devices = pySegSort(device);
            for(var o in devices){
              var status="";
              var color="";
              var isOnline=(devices[o]["online"]==1)?"在线":"离线";
              switch(devices[o]['status']){
                case '1':
                  status="正在播放";
                  color="#3470AB";
                  break;

                case '2':
                  status="正在播放";
                  color="#3470AB";
                  break;

                case '3':
                  status="待机";
                  color="#808080";
                  break;

                case '4':
                  status="正在下载";
                  color="#7AB900";
                  break;

                case '5':
                  status="正在下载";
                  color="#7AB900";
                  break;

                default:
                  status="离线";
                  color="#FF5500";

              }

              if(isOnline=="离线"){
                status="离线";
                color="#FF5500";
              }

              var curmovie="";

              if(devices[o]["deviceid"]!=""){
                if((isOnline=="离线")||(devices[o]["curmovie"]=="")){
                  curmovie="无影片";
                }else{
                  curmovie=devices[o]["curmovie"];
                }
                var deviceListContent="<tr>"                                       
                                        +"<td>"+'<div class="center-block">'+devices[o]["deviceid"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["alias"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["ip"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["version"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["type"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["group_name"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+"<span style='color:"+color+"';>"+status+"</span></div></td>"
                                        +"<td>"+'<div class="center-block">'+curmovie+"</div></td>"          
                                        +"<td>"+'<div class="center-block">'+'<a href="#submitedList" data-toggle="modal" class="btn btn-primary btn-large">'+'查看</a>'+"</div></td>";
               if(isOnline!="离线"){
                deviceListContent=deviceListContent+"<td>"+'<div class="center-block">'+'<a href="#submitList" data-toggle="modal" class="btn btn-success btn-large" style="background-color:#00EC00;" id="chooseDeviceSubmit">'+'选择电影列表</a>'+"</div></td>"
                                      +"</tr>";
               }else{
                deviceListContent=deviceListContent+"<td>"+'<div class="center-block">'+'<a href="#" onClick="'+"swal('设备离线 不能下发列表');"+'" data-toggle="modal" class="btn btn-success btn-large" style="background-color:#FF2D2D;">'+'设备离线</a>'+"</div></td>"
                                      +"</tr>";
               }
                
                $("#deviceTab tbody").append(deviceListContent);

                $("#deviceTab .btn.btn-primary.btn-large:eq("+o+")").click({index:o,deviceId:devices[o]["deviceid"]},function(evt){//查看当前列表按钮
                  $("#submitedList .modal-body").html("<iframe style='height:340px;box-shadow:0px 0px 1px 1px #888888;' frameborder='0' src='DeviceDetails.php?deviceid="+evt.data.deviceId+"'></iframe>");
                });

                $("#deviceTab .btn.btn-success.btn-large:eq("+o+")").click({deviceId:devices[o]["deviceid"],deviceIp:devices[o]["ip"]},function(evt){//选择要下发的列表按钮 
                      $.get("../Controller/MovieController.php?method=getSavedMovieListNames",{},function(data){
                        var listsHtml="<div id='chooseList'><table> ";
                        lists= eval('(' +data+ ')'); 
                        function reverseOrder(lists){
                            for(var i=0;i<lists.length;i++){
                               for(var j=i;j<lists.length;j++){
                                  if(parseInt(lists[i]["create_time"])<parseInt(lists[j]["create_time"])){
                                     var temp = lists[i];
                                     lists[i] = lists[j];
                                     lists[j] = temp;
                                  }
                               }           
                            }
                            return lists;
                        } 
                        for(var o in reverseOrder(lists)){//单选radio
                          var listName=lists[o]['list_name'];
                          if(o%4==0){
                           listsHtml+='<tr>';
                          }
                          listsHtml+='<td style="padding:15px;"><label class="radio-inline">'+'<input type="radio" name="listOptions" value="'+listName+'">'+listName+'</label></td>'; 
                          if(o%4==3){
                            listsHtml+='</tr>';
                          }
                        }
                        if(o%4!=3){
                          listsHtml+='</tr>';
                        }
                        listsHtml+='</table></div>';//end of listsHtml 
                        //alert(listsHtml);
                        $("#devid").val(evt.data.deviceId);//设置下发设备的id
                        $("#devip").val(evt.data.deviceIp);//设置下发设备的ip
                        $("#deviceName").val(evt.data.deviceName);//设置下发设备的别名
                        $("#submitList .modal-body").html(listsHtml);   
                      });

                });
              }  
            }
        });
      }

      function sortByDeviceGroup(){
        var subsortType = $.cookie("subsortType");
        if(subsortType != "groupnameU" && subsortType != "groupnameD"){
          $.cookie('subsortType', 'groupnameU', { expires: 7 });   //第一次点击ID升序排列
        }else{
          if(subsortType == "groupnameU"){
            $.cookie('subsortType', 'groupnameD', { expires: 7 });   //从升序变为降序
          }else{
            $.cookie('subsortType', 'groupnameU', { expires: 7 });   //从降序变为升序
          }
        }
        $("#deviceTab tbody tr").remove();
        var deviceCode = $("#deviceCode").val();
        $.post("../Controller/DeviceController.php?method=deviceSearch",{deviceCode:deviceCode},function(data){
            device = eval('(' +data+ ')');
            function pySegSort(device,empty) {
                if(!String.prototype.localeCompare)
                  return null;

                var letters ="abcdefghjklmnopqrstwxyz".split('');
                var EN ="ABCDEFGHJKLMNOPQRSTWXYZ".split('');
                var zh ="啊把差大额发噶哈级卡啦吗那哦爬器然啥他哇西呀咋".split('');

                var curr = [];
                var subsortType = $.cookie("subsortType");
                if(subsortType == "groupnameU"){
                  for(i=0;i<letters.length;i++){
                    for(j=0;j<device.length;j++){
                      if(/.*[\u4e00-\u9fa5]+.*$/.test(device[j]["group_name"].substring(0,1))){ 
                        if((!zh[i] || zh[i].localeCompare(device[j]["group_name"]) <= 0) && device[j]["group_name"].localeCompare(zh[i+1]) == -1){
                          curr.push(device[j]);
                        }  
                      }else{
                        if((!letters[i] || letters[i].localeCompare(device[j]["group_name"]) <= 0) && device[j]["group_name"].localeCompare(letters[i+1]) == -1){
                          curr.push(device[j]);
                        }
                      }
                    }
                  }
                }else{
                  for(i=letters.length;i>=0;i--){
                    for(j=0;j<device.length;j++){
                      if(/.*[\u4e00-\u9fa5]+.*$/.test(device[j]["group_name"].substring(0,1))){ 
                        if((!zh[i] || zh[i].localeCompare(device[j]["group_name"]) >= 0) && device[j]["group_name"].localeCompare(zh[i-1]) >= 0){
                          curr.push(device[j]);
                        }  
                      }else{
                        if((!letters[i] || letters[i].localeCompare(device[j]["group_name"]) >= 0) && device[j]["group_name"].localeCompare(letters[i-1]) >= 0){
                          curr.push(device[j]);
                        }
                      }
                    }
                  }
                }
                return curr;
            }
            var devices = pySegSort(device);
            for(var o in devices){
              var status="";
              var color="";
              var isOnline=(devices[o]["online"]==1)?"在线":"离线";
              switch(devices[o]['status']){
                case '1':
                  status="正在播放";
                  color="#3470AB";
                  break;

                case '2':
                  status="正在播放";
                  color="#3470AB";
                  break;

                case '3':
                  status="待机";
                  color="#808080";
                  break;

                case '4':
                  status="正在下载";
                  color="#7AB900";
                  break;

                case '5':
                  status="正在下载";
                  color="#7AB900";
                  break;

                default:
                  status="离线";
                  color="#FF5500";

              }

              if(isOnline=="离线"){
                status="离线";
                color="#FF5500";
              }

              var curmovie="";

              if(devices[o]["deviceid"]!=""){
                if((isOnline=="离线")||(devices[o]["curmovie"]=="")){
                  curmovie="无影片";
                }else{
                  curmovie=devices[o]["curmovie"];
                }
                var deviceListContent="<tr>"                                       
                                        +"<td>"+'<div class="center-block">'+devices[o]["deviceid"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["alias"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["ip"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["version"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["type"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["group_name"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+"<span style='color:"+color+"';>"+status+"</span></div></td>"
                                        +"<td>"+'<div class="center-block">'+curmovie+"</div></td>"          
                                        +"<td>"+'<div class="center-block">'+'<a href="#submitedList" data-toggle="modal" class="btn btn-primary btn-large">'+'查看</a>'+"</div></td>";
               if(isOnline!="离线"){
                deviceListContent=deviceListContent+"<td>"+'<div class="center-block">'+'<a href="#submitList" data-toggle="modal" class="btn btn-success btn-large" style="background-color:#00EC00;" id="chooseDeviceSubmit">'+'选择电影列表</a>'+"</div></td>"
                                      +"</tr>";
               }else{
                deviceListContent=deviceListContent+"<td>"+'<div class="center-block">'+'<a href="#" onClick="'+"swal('设备离线 不能下发列表');"+'" data-toggle="modal" class="btn btn-success btn-large" style="background-color:#FF2D2D;">'+'设备离线</a>'+"</div></td>"
                                      +"</tr>";
               }
                
                $("#deviceTab tbody").append(deviceListContent);

                $("#deviceTab .btn.btn-primary.btn-large:eq("+o+")").click({index:o,deviceId:devices[o]["deviceid"]},function(evt){//查看当前列表按钮
                  $("#submitedList .modal-body").html("<iframe style='height:340px;box-shadow:0px 0px 1px 1px #888888;' frameborder='0' src='DeviceDetails.php?deviceid="+evt.data.deviceId+"'></iframe>");
                });

                $("#deviceTab .btn.btn-success.btn-large:eq("+o+")").click({deviceId:devices[o]["deviceid"],deviceIp:devices[o]["ip"]},function(evt){//选择要下发的列表按钮 
                      $.get("../Controller/MovieController.php?method=getSavedMovieListNames",{},function(data){
                        var listsHtml="<div id='chooseList'><table> ";
                        lists= eval('(' +data+ ')'); 
                        function reverseOrder(lists){
                            for(var i=0;i<lists.length;i++){
                               for(var j=i;j<lists.length;j++){
                                  if(parseInt(lists[i]["create_time"])<parseInt(lists[j]["create_time"])){
                                     var temp = lists[i];
                                     lists[i] = lists[j];
                                     lists[j] = temp;
                                  }
                               }           
                            }
                            return lists;
                        } 
                        for(var o in reverseOrder(lists)){//单选radio
                          var listName=lists[o]['list_name'];
                          if(o%4==0){
                           listsHtml+='<tr>';
                          }
                          listsHtml+='<td style="padding:15px;"><label class="radio-inline">'+'<input type="radio" name="listOptions" value="'+listName+'">'+listName+'</label></td>'; 
                          if(o%4==3){
                            listsHtml+='</tr>';
                          }
                        }
                        if(o%4!=3){
                          listsHtml+='</tr>';
                        }
                        listsHtml+='</table></div>';//end of listsHtml 
                        //alert(listsHtml);
                        $("#devid").val(evt.data.deviceId);//设置下发设备的id
                        $("#devip").val(evt.data.deviceIp);//设置下发设备的ip
                        $("#deviceName").val(evt.data.deviceName);//设置下发设备的别名
                        $("#submitList .modal-body").html(listsHtml);   
                      });

                });
              }  
            }
        });
      }

      function submitVideoList(listName){
            // show_loading();
            if($("#devid").val()==""){
              sweetAlert("请选择要下发到的设备");
              return;
            }
            var devid=$("#devid").val();
            var ip=$("#devip").val();
            var deviceName=$("#deviceName").val();
      
            $.ajax({ 
              type:'GET',
              url:'../Controller/MovieController.php', 
              data:"method=submitSavedListByListName&devid="+devid+"&ip="+ip+"&listName="+listName+"&deviceId="+devid+"&deviceName="+deviceName, 
              // dataType:'json',
              beforeSend:function(XMLHttpRequest){ 
                  //alert('远程调用开始...'); 
                // show_loading(); 
              }, 
              success:function(data,textStatus){
                // console.log(data);
                if(data=="下发列表不能超过20部"||data=="下发列表不能为空"){ 
                    swal(data);
                }else{
                  // show_loading();
                  $('#submitList').modal('hide');
                  swal("下发成功");
                  var movies = eval('(' +data+ ')'); 
                  devid=devid.toLowerCase();
                  postOrder("submitList",devid,movies.length,data);
                }               
              }, 
              complete:function(XMLHttpRequest,textStatus){ 
                  // alert('远程调用成功，状态文本值：'+textStatus); 
                 // close_loading();
              }, 
              error:function(XMLHttpRequest,textStatus,errorThrown){ 
                swal("连接出错"); 
                close_loading(); 
              } 
            }); 
      }

      function deviceSearch(){
        var deviceCode = $("#deviceCode").val();
        $.post("../Controller/DeviceController.php?method=deviceSearch",{deviceCode:deviceCode},function(data){  
            devices = eval('(' +data+ ')');
            var newArr = [];
            for(var i =0;i<devices.length;i++){
              if(newArr.indexOf(devices[i]['group_name']) == -1){
                  newArr.push(devices[i]['group_name']);
              }
            }
            $("#deviceCount").html(devices.length+"台");
            $("#groupTimes").html(newArr.length+"组");
            $("#deviceTab tbody tr").remove(); 
            for(var o in devices){
              var status="";
              var color="";
              var isOnline=(devices[o]["online"]==1)?"在线":"离线";
              switch(devices[o]['status']){
                case '1':
                  status="正在播放";
                  color="#3470AB";
                  break;

                case '2':
                  status="正在播放";
                  color="#3470AB";
                  break;

                case '3':
                  status="待机";
                  color="#808080";
                  break;

                case '4':
                  status="正在下载";
                  color="#7AB900";
                  break;

                case '5':
                  status="正在下载";
                  color="#7AB900";
                  break;

                default:
                  status="离线";
                  color="#FF5500";

              }

              if(isOnline=="离线"){
                status="离线";
                color="#FF5500";
              }

              var curmovie="";

              if(devices[o]["deviceid"]!=""){
                if((isOnline=="离线")||(devices[o]["curmovie"]=="")){
                  curmovie="无影片";
                }else{
                  curmovie=devices[o]["curmovie"];
                }
                var deviceListContent="<tr>"                                       
                                        +"<td>"+'<div class="center-block">'+devices[o]["deviceid"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["alias"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["ip"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["version"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["type"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["group_name"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+"<span style='color:"+color+"';>"+status+"</span></div></td>"
                                        +"<td>"+'<div class="center-block">'+curmovie+"</div></td>"          
                                        +"<td>"+'<div class="center-block">'+'<a href="#submitedList" data-toggle="modal" class="btn btn-primary btn-large">'+'查看</a>'+"</div></td>";
               if(isOnline!="离线"){
                deviceListContent=deviceListContent+"<td>"+'<div class="center-block">'+'<a href="#submitList" data-toggle="modal" class="btn btn-success btn-large" style="background-color:#00EC00;">'+'选择电影列表</a>'+"</div></td>"
                                      +"</tr>";
               }else{
                deviceListContent=deviceListContent+"<td>"+'<div class="center-block">'+'<a href="#" onClick="'+"swal('设备离线 不能下发列表');"+'" data-toggle="modal" class="btn btn-success btn-large" style="background-color:#FF2D2D;">'+'设备离线</a>'+"</div></td>"
                                      +"</tr>";
               }
                
                $("#deviceTab tbody").append(deviceListContent);

                $("#deviceTab .btn.btn-primary.btn-large:eq("+o+")").click({index:o,deviceId:devices[o]["deviceid"]},function(evt){//查看当前列表按钮
                  $("#submitedList .modal-body").html("<iframe style='height:340px;box-shadow:0px 0px 1px 1px #888888;' frameborder='0' src='DeviceDetails.php?deviceid="+evt.data.deviceId+"'></iframe>");
                });

                $("#deviceTab .btn.btn-success.btn-large:eq("+o+")").click({deviceId:devices[o]["deviceid"],deviceIp:devices[o]["ip"],deviceName:devices[o]["alias"]},function(evt){//选择要下发的列表按钮 
                      $.get("../Controller/MovieController.php?method=getSavedMovieListNames",{},function(data){
                        var listsHtml="<div id='chooseList'><table> ";
                        lists= eval('(' +data+ ')');
                        function reverseOrder(lists){
                            for(var i=0;i<lists.length;i++){
                               for(var j=i;j<lists.length;j++){
                                  if(parseInt(lists[i]["create_time"])<parseInt(lists[j]["create_time"])){
                                     var temp = lists[i];
                                     lists[i] = lists[j];
                                     lists[j] = temp;
                                  }
                               }           
                            }
                            return lists;
                        } 
                        for(var o in reverseOrder(lists)){//单选radio
                          var listName=lists[o]['list_name'];
                          if(o%4==0){
                           listsHtml+='<tr>';
                          }
                          listsHtml+='<td style="padding:15px;"><label class="radio-inline">'+'<input type="radio" name="listOptions" value="'+listName+'">'+listName+'</label></td>'; 
                          if(o%4==3){
                            listsHtml+='</tr>';
                          }
                        }
                        if(o%4!=3){
                          listsHtml+='</tr>';
                        }
                        listsHtml+='</table></div>';//end of listsHtml 
                        //alert(listsHtml);
                        $("#devid").val(evt.data.deviceId);//设置下发设备的id
                        $("#devip").val(evt.data.deviceIp);//设置下发设备的ip
                        $("#deviceName").val(evt.data.deviceName);//设置下发设备的别名

                        $("#submitList .modal-body").html(listsHtml);   
                      });

                });
              }  
            }
        });
      }


      function clearSearch(){
        $("#deviceCode").val("");
        deviceSearch();
      }

      function initInfo(){
        //初始化列表和设备信息
        querySavedList();
        queryDeviceList();
      }
    </script>
		<script type="text/javascript">
      $("#submitButton").click(function(){//提交按钮
        listName=($("#chooseList :checked").val());
        if(listName==undefined){
          swal("请选择列表");
          return;
        }
        submitVideoList(listName);
      });
    	$(window).load(initInfo());
  	</script>
	</body>
</html>