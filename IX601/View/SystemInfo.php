<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no, -ms-touch-action: none">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="format-detection" content="telephone=no">
        <meta name="description" content="" />
        <title>系统信息</title>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/sweetalert.min.js"></script>
        <link rel="stylesheet" href="../css/myFont.css" />
        <link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
  
        <style> 
        * {  
            box-sizing: border-box; 
        }
        body{
            min-width: 988px;
            overflow-x:hidden; 
        }
        .panel {
            border: none;
        }
        .nav-tabs {
            margin: 0 auto;
            border-bottom: none;
        }
        .nav-tabs>li>a{
            height: 45px;
            margin-bottom: -10px;
        }
        .nav-tabs>li{
            width: 10%;
        }
        #updateVersion span{
            color:red;
        }
        </style>
    </head>
    <body>
        
        <div class="row">
        </div>
      <div class="row">  
      
            <div class="col-lg-12 panel panel-success">
                <div class="panel-heading" align="center">
                    <ul id="myTab" class="nav nav-tabs">
                        <li class="active"><a href="#systemMessage" data-toggle="tab">系统信息</a></li>
                        <li><a href="#systemSet" data-toggle="tab">系统配置</a></li>
                        <li><a href="#systemUpdate" data-toggle="tab">网络升级</a></li>
                    </ul>
                </div>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active"  id="systemMessage">
                        <div class="row" align="center">
                            <h3>系统信息</h3>
                            <!--  填充空白 -->
                        </div>
                        <div class="row" align="center" style="border-bottom:2px dashed rgba(0, 0, 0, 0.27);width:80%;margin:0 auto;margin-top:15px;">
                            <!--  填充空白 -->
                        </div>
                        <div class="row">
                            <br><br><br><br><br>
                            <!--  填充空白 -->
                        </div>
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-5 form-group center-block">
                               <!--  填充空白 -->
                            </div>
                            <div class="col-lg-3 col-md-5 col-sm-5 form-group center-block">
                                <h4><font>影院名称:</font>
                                    <font class="text-muted">
                                        &nbsp;&nbsp;<span id="cinemaNameSpan">中科影院</span>
                                    </font>
                                </h4>
                            </div>
                            <div class="col-lg-4 col-md-5 col-sm-5 form-group center-block">
                               <!--  填充空白 -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-5 form-group center-block">
                               <!--  填充空白 -->
                            </div>
                            <div class="col-lg-3 col-md-5 col-sm-5 form-group center-block">
                                <h4><font>系统名称:</font>
                                    <font class="text-muted">
                                        &nbsp;&nbsp;文化娱乐管理系统
                                    </font>
                                </h4>
                            </div>
                            <div class="col-lg-4 col-md-5 col-sm-5 form-group center-block">
                               <!--  填充空白 -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-5 form-group center-block">
                               <!--  填充空白 -->
                            </div>
                            <div class="col-lg-3 col-md-5 col-sm-5 form-group center-block">
                                <h4><font>系统版本:</font>
                                    <font class="text-muted">
                                        &nbsp;&nbsp;<span id="version_id"><!-- V0.0.0.2 --></span>
                                    </font>
                                </h4>
                            </div>
                            <div class="col-lg-4 col-md-5 col-sm-5 form-group center-block">
                               <!--  填充空白 -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-5 form-group center-block">
                               <!--  填充空白 -->
                            </div>
                            <div class="col-lg-3 col-md-5 col-sm-5 form-group center-block">
                                <h4><font>MAC地址:</font>
                                    <font class="text-muted">
                                        &nbsp;&nbsp;
                                        <?php
                                           $MacReturn = shell_exec("/sbin/ifconfig eth0");
                                           $index = strpos($MacReturn,"HWaddr ");
                                           $mac = str_replace(":", "", substr($MacReturn,$index+7,17));
                                           echo $mac;
                                        ?>
                                    </font>
                                </h4>
                            </div>
                            <div class="col-lg-4 col-md-5 col-sm-5 form-group center-block">
                               <!--  填充空白 -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-5 form-group center-block">
                               <!--  填充空白 -->
                            </div>
                            <div class="col-lg-3 col-md-5 col-sm-5 form-group center-block">
                                <h4><font>ip地址:</font>
                                    <font id="sysip" class="text-muted">
                                        &nbsp;&nbsp;
                                    </font>
                                </h4>
                            </div>
                            <div class="col-lg-4 col-md-5 col-sm-5 form-group center-block">
                               <!--  填充空白 -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-5 form-group center-block">
                               <!--  填充空白 -->
                            </div>
                            <div class="col-lg-3 col-md-5 col-sm-5 form-group center-block">
                                <h4><font>联系电话:</font>
                                    <font class="text-muted">
                                        &nbsp;&nbsp;400-000-2131
                                    </font>
                                </h4>
                            </div>
                            <div class="col-lg-4 col-md-5 col-sm-5 form-group center-block">
                               <!--  填充空白 -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-5 form-group center-block">
                               <!--  填充空白 -->
                            </div>
                            <div class="col-lg-3 col-md-5 col-sm-5 form-group center-block">
                                <h4><font>24小时服务热线:</font>
                                <font class="text-muted">
                                    &nbsp;&nbsp;13911750024</h4>
                                </font>
                            </div>
                            <div class="col-lg-4 col-md-5 col-sm-5 form-group center-block">
                               <!--  填充空白 -->
                            </div>
                        </div>
                        <div class="row">
                            <br><br><br><br><br>
                            <!--  填充空白 -->
                        </div>
                    </div>

                    <div class="tab-pane fade in"  id="systemSet">
                        <div class="row" align="center">
                            <h3>系统配置</h3>
                            <!--  填充空白 -->
                        </div>
                        <div class="row" align="center" style="border-bottom:2px dashed rgba(0, 0, 0, 0.27);width:80%;margin:0 auto;margin-top:15px;">
                            <!--  填充空白 -->
                        </div>
                        <div class="row" align="center"  style="width:80%;margin:0 auto;margin-top:40px;">
                            <h4 style="float:left;margin-left:50px">影院名称：</h4>
                            <h4 style="float:left" id="cinemaName">中科影院</h4>
                            <input id="cinemaNameInput" type="text" style="display:none;float:left;margin-left:10px;height:36px;width:200px;"/>
                            <button id="updateCinemaName" class="btn btn-info" style="float:left;margin-left:10px">修改</button>
                            <!--  填充空白 -->
                        </div>
                        <div class="row" align="center"  style="width:80%;margin:0 auto;margin-top:40px;">
                            <h4 style="float:left;margin-left:50px">云平台配置：</h4>
                            <h4 style="float:left" id="yunIp">192.168.1.222</h4>
                            <input type="text" id="yunIpInput" placeholder="请输入云平台IP地址" style="float:left;margin-left:50px;height:36px;width:200px;"/>
                            <button id="yunIpButton" class="btn btn-info" style="float:left;margin-left:10px">修改</button>
                            <!--  填充空白 -->
                        </div>
                        <div class="row" align="center" style="border-bottom:2px dashed rgba(0, 0, 0, 0.27);width:60%;margin-left:10%;margin-top:35px;">
                            <!--  填充空白 -->
                        </div>
                        <div class="row" align="center"  style="width:80%;margin:0 auto;margin-top:40px;">
                            <h4 style="float:left;margin-left:50px">影片下载设置：</h4>
                            <table class="table table-bordered" style="float:left;margin-left:50px;margin-top:15px;width:90%;">
                                <thead>
                                    <tr class="success">
                                        <th>当前生效</th>
                                        <th>目录：c盘/desk/</th>
                                        <th>IP:192.168.1.1</th>
                                        <th>已下载影片：60部</th>
                                        <th>共200T/剩余20T</th>
                                    </tr>
                                </thead>
                            </table>

                            <table class="table table-bordered" style="float:left;margin-left:50px;margin-top:25px;width:90%;">
                                <thead>
                                    <tr class="info">
                                        <th>使用日期</th>
                                        <th>目录</th>
                                        <th>IP</th>
                                        <th>存在影片数量</th>
                                        <th>容量</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2017.11.12</td>
                                        <td>目录：d盘/desk/</td>
                                        <td>192.168.2.2</td>
                                        <td>60部</td>
                                        <td>共100T/剩余20T</td>
                                        <td><button style="border-radius:4px;background:rgb(118, 117, 60);color:#FFF;">使用</button></td>
                                    </tr>
                                    <tr>
                                        <td>2017.11.12</td>
                                        <td>目录：d盘/desk/</td>
                                        <td>192.168.2.2</td>
                                        <td>60部</td>
                                        <td>共100T/剩余20T</td>
                                        <td><button style="border-radius:4px;background:rgb(118, 117, 60);color:#FFF;">使用</button></td>
                                    </tr>
                                    <tr>
                                        <td>2017.11.12</td>
                                        <td>目录：d盘/desk/</td>
                                        <td>192.168.2.2</td>
                                        <td>60部</td>
                                        <td>共100T/剩余20T</td>
                                        <td><button style="border-radius:4px;background:rgb(118, 117, 60);color:#FFF;">使用</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade in"  id="systemUpdate">
                        <div class="row" align="center">
                            <h3>网络升级</h3>
                            <!--  填充空白 -->
                        </div>
                        <div class="row" align="center" style="border-bottom:2px dashed rgba(0, 0, 0, 0.27);width:80%;margin:0 auto;margin-top:15px;">
                            <!--  填充空白 -->
                        </div>
                        <div class="row" align="center"  style="width:80%;margin:0 auto;margin-top:40px;">
                            <h4 style="float:left;margin-left:35%">当前系统版本：</h4>
                            <h4 style="float:left" id="oldVersionId">V0.0.0.1</h4>
                            <button id="checkVersion" style="float:left;margin-top:6px;width:98px;margin-left:20px;border:none;border-radius:4px;background:#004c68;color:#FFF;">检查版本</button>
                            <!--  填充空白 -->
                        </div>
                        <div class="row" align="center" style="border-bottom:2px dashed rgba(0, 0, 0, 0.27);width:50%;margin:0 auto;margin-top:55px;">
                            <!--  填充空白 -->
                        </div>
                        <div class="row" id="updateVersion" align="center" style="display:none;width:50%;margin:0 auto;margin-top:10px;border:2px solid rgba(0, 0, 0, 0.12);height:400px;background:#cc9966;">
                            <h4 style="margin:0 auto;font-weight:bold;margin-top:35px;">更新版本</h4>
                            <h5 style="margin:0 auto;margin-top:20px;color:#FFFFFF" id="updateMessage"></h5>
                            <div style="width:211px;height:40px;margin-top:20px;">
                                <button id="ignoreVersion" class="btn btn-default" style="float:left;">忽略本次更新</button>
                                <button class="btn btn-success" style="float:left;margin-left:15px;" id="StartUpdateVersion">升级版本</button>
                            </div>
                            <div class="progress" style="width:50%;height:80px;margin-top:40px;background:rgba(0, 0, 0, 0.37)">
                              <div style="width:100%;height:30px;float:left;background:rgb(165, 128, 72)">
                                <h5 style="float:left;margin-left:10px;font-size:12px;margin-top:6px;"><i>更新版本</i></h5>
                                <h5 style="float:right;margin-right:10px;font-size:12px;margin-top:6px;"><i  id="progressPercent">已下载:0%</i></h5>
                              </div>
                              <div style="width:90%;box-shadow:inset 0 0 5px 5px #ccc;border:2px solid rgba(57, 59, 101, 0.2);margin-top:40px;height:20px;border-radius:4px;">
                                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                    
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="row" align="center" style="border-bottom:2px dashed rgba(0, 0, 0, 0.27);width:50%;margin:0 auto;margin-top:10px;">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>   
    <script type="text/javascript">
        var interval;
        $(function(){
           $("#checkVersion").click(function(){
              $("#updateVersion").slideDown();
              $.post("../Utils/updateVersion.php?method=varlidVersion",{},function(data){
                 $("#updateMessage").html(data);
                 if(data == "当前版本为最新版本"){
                    $("#StartUpdateVersion").attr("disabled","disabled");
                 }else{
                    if(data == "正在更新系统"){
                        $("#StartUpdateVersion").attr("disabled","disabled");
                        interval = setInterval('onloadProgress()',100);
                    }else{
                        $("#StartUpdateVersion").removeAttr("disabled");//将按钮可用
                    }
                 }
              });
              $.get("../Controller/DeviceController.php?method=getServerInfo",{},function(data){
                  var serverInfo = eval("("+data+")"); 
                  $("#version_id").html(serverInfo['version_id']);
                  $("#oldVersionId").html(serverInfo['version_id']);
                  $("#cinemaName").html(serverInfo['cinema_name']);
                  $("#cinemaNameSpan").html(serverInfo['cinema_name']);
                  $("#yunIp").html(serverInfo['yun_ip']);
              });
           })
           $("#StartUpdateVersion").click(function(){
                $.post("../Utils/updateVersion.php?method=validUpdatePower",{},function(data){
                    if(data == 0){
                        swal("本机器不具备升级权限");
                    }else{
                        $("#StartUpdateVersion").attr("disabled","disabled");
                        interval = setInterval('onloadProgress()',100);
                        $.post("../Utils/updateVersion.php?method=startUpdateVersion",{},function(data){});
                    }
                });
           })
           $("#ignoreVersion").click(function(){
              $("#updateVersion").slideUp();
           })
           $("#updateCinemaName").click(function(){
              var buttonName = $(this).html();
              if(buttonName == "修改"){
                  var cinemaName = $("#cinemaName").html();
                  $("#cinemaName").hide();
                  $("#cinemaNameInput").show();
                  $("#cinemaNameInput").val(cinemaName);
                  $(this).html("保存");
              }else{
                  var cinemaNameInput = $("#cinemaNameInput").val();
                  if(cinemaNameInput != ""){
                      $(this).html("修改");
                      $("#cinemaName").html(cinemaNameInput);
                      $("#cinemaNameSpan").html(cinemaNameInput);
                      $("#cinemaName").show();
                      $("#cinemaNameInput").hide();
                      $.post("../Controller/DeviceController.php?method=updateCinemaName",{cinema_name:cinemaNameInput},function(data){
                         if(data == '1'){
                            swal("保存成功");
                        }else{
                            swal("保存失败");
                        }
                      }) 
                  }else{
                      swal("影院名称不能为空");
                  }
              }
           })
           $("#yunIpButton").click(function(){
              var yunIp = $("#yunIpInput").val();
              if(yunIp != ""){
                var pattern=/^(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9])\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[0-9])$/;
                if(!pattern.exec(yunIp)){
                    swal("请输入正确的IP格式");
                }else{
                    $.post("../Controller/DeviceController.php?method=updateYunIp",{yun_ip:yunIp},function(data){
                         if(data == '1'){
                            $("#yunIp").html(yunIp);
                            $("#yunIpInput").val("");
                        }else{
                            swal("修改失败");
                        }
                    })
                }
              }else{
                swal("云平台IP不能为空");
              }
           })
        })
        $(window).load(initInfo());
        function initInfo(){    
        
          //动态生成设备表
           $.get("../Utils/GetServerInfo.php?method=GetServerIP",{},function(resp){ 
              $("#sysip").html(resp);
            });

           $.get("../Controller/DeviceController.php?method=getServerInfo",{},function(data){
              var serverInfo = eval("("+data+")"); 
              console.log(serverInfo);
              $("#version_id").html(serverInfo['version_id']);
              $("#oldVersionId").html(serverInfo['version_id']);
              $("#cinemaName").html(serverInfo['cinema_name']);
              $("#cinemaNameSpan").html(serverInfo['cinema_name']);
              $("#yunIp").html(serverInfo['yun_ip']);
            });
        }

        function onloadProgress(){
            $.post("../Utils/updateVersion.php?method=getUpdatePercent",{},function(data){
                $("div[role='progressbar']").css("width",data+"%");
                var html = '已下载:'+data+'%';
                $("#progressPercent").html(html);
                if(data == 100){
                    var html = "已下载完成正在安装请稍后...";
                    $("#progressPercent").html(html);
                    $("div[role='progressbar']").html("正在安装");
                    clearInterval(interval);
                    $.post("../Utils/updateVersion.php?method=updateVersionData",{},function(data){
                        if(data == 1){
                            swal("升级完成,刷新界面即可生效");
                        }else{
                            $("#StartUpdateVersion").removeAttr("disabled");//将按钮可用
                            swal("升级数据更新失败");
                        }
                    });
                }
            })
        }
    </script>
    </body>

</html>