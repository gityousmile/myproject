<html>
   <head>
      <meta http-equiv="content-type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <link href="../css/bootstrap.min.css" rel="stylesheet">
      <script src="../js/jquery.min.js"></script>
      <script src="../js/jquery.cookie.js"></script>
      <link rel="stylesheet" href="../css/myFont.css" />
      <script src="../js/bootstrap.min.js"></script>
      <script src="../js/sweetalert.min.js"></script> 
      <link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
      <script type="text/javascript" src="../js/zepto.js?2"></script>
      <link href="../css/font-awesome.min.css" rel="stylesheet" />
      <style type="text/css">/*表格中内容居中*/
        .table th, .table td { 
          text-align: center; 
          height:38px;
        }
      </style>
 
      <script type="text/javascript">
        function unix_to_datetime(unix) {
          var now = new Date(parseInt(unix) * 1000);
          return now.toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ");
        }

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

        function GetQueryString(name) {//使用正则表达式获取当前页面的参数
          var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)","i");
          var r = window.location.search.substr(1).match(reg);
          if (r!=null) return (r[2]); 
          return null;
        }

        function queryDeviceList(){    
          $("#mobileTab tbody tr").remove();
          //动态生成电影列表
          $.get("../Controller/DeviceController.php?method=getDevices",{},function(data){  
            // alert(data);
            devices = eval('(' +data+ ')');
            console.log(devices);
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

                $("#deviceTab tbody").append("<tr>"
                                        
                                        +"<td>"+'<div class="center-block">'+devices[o]["deviceid"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["alias"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["ip"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["version"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["type"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["group_name"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+"<span style='color:"+color+"';>"+status+"</span></div></td>"
                                        +"<td>"+'<div class="center-block">'+curmovie+"</div></td>"
                                        // +"<td>"+"<a  href='DeviceDetails.php?deviceid="+devices[o]["deviceid"]+"'>查看</a>"+"</td>"
                                        +"<td>"+'<div class="center-block">'+'<button href="#submitedList" data-toggle="modal" class="btn btn-primary btn-large">'+'查看</button>'+"</div></td>"
                                        // +"<td>"+'<button class="btn btn-radius btn-default">'+"<a  href='DeviceDetails.php?deviceid="+devices[o]["deviceid"]+"'>查看</a>"+' </button>'+"</td>"
                                        +"</tr>");
                $("#deviceTab .btn.btn-primary.btn-large:eq("+o+")").click({index:o,deviceId:devices[o]["deviceid"]},function(evt){      
                     $("#submitedList .modal-body").html("<iframe style='height:340px;box-shadow:0px 0px 1px 1px #888888;' frameborder='0' src='DeviceDetails.php?deviceid="+evt.data.deviceId+"'></iframe>");
                });
              }  
            }
        });
      }

      function sortByDeviceId(){
        var dmsortType = $.cookie("dmsortType");
        if(dmsortType != "idU" && dmsortType != "idD"){
          $.cookie('dmsortType', 'idU', { expires: 7 });   //第一次点击ID升序排列
        }else{
          if(dmsortType == "idU"){
            $.cookie('dmsortType', 'idD', { expires: 7 });   //从升序变为降序
          }else{
            $.cookie('dmsortType', 'idU', { expires: 7 });   //从降序变为升序
          }
        }
        $("#deviceTab tbody tr").remove();
        var deviceCode = $("#deviceCode").val();
        $.post("../Controller/DeviceController.php?method=deviceSearch",{deviceCode:deviceCode},function(data){  
            devices = eval('(' +data+ ')');
            function sortById(devices){
              var dmsortType = $.cookie("dmsortType");
              if(dmsortType == "idU"){
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

                $("#deviceTab tbody").append("<tr>"
                                        
                                        +"<td>"+'<div class="center-block">'+devices[o]["deviceid"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["alias"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["ip"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["version"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["type"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["group_name"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+"<span style='color:"+color+"';>"+status+"</span></div></td>"
                                        +"<td>"+'<div class="center-block">'+curmovie+"</div></td>"
                                        // +"<td>"+"<a  href='DeviceDetails.php?deviceid="+devices[o]["deviceid"]+"'>查看</a>"+"</td>"
                                        +"<td>"+'<div class="center-block">'+'<button href="#submitedList" data-toggle="modal" class="btn btn-primary btn-large">'+'查看</button>'+"</div></td>"
                                        // +"<td>"+'<button class="btn btn-radius btn-default">'+"<a  href='DeviceDetails.php?deviceid="+devices[o]["deviceid"]+"'>查看</a>"+' </button>'+"</td>"
                                        +"</tr>");
                $("#deviceTab .btn.btn-primary.btn-large:eq("+o+")").click({index:o,deviceId:devices[o]["deviceid"]},function(evt){      
                     $("#submitedList .modal-body").html("<iframe style='height:340px;box-shadow:0px 0px 1px 1px #888888;' frameborder='0' src='DeviceDetails.php?deviceid="+evt.data.deviceId+"'></iframe>");
                });
              }  
            }
        });
      }

      function sortByDeviceName(){
        var dmsortType = $.cookie("dmsortType");
        if(dmsortType != "devicenameU" && dmsortType != "devicenameD"){
          $.cookie('dmsortType', 'devicenameU', { expires: 7 });   //第一次点击ID升序排列
        }else{
          if(dmsortType == "devicenameU"){
            $.cookie('dmsortType', 'devicenameD', { expires: 7 });   //从升序变为降序
          }else{
            $.cookie('dmsortType', 'devicenameU', { expires: 7 });   //从降序变为升序
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
                var zh ="啊把差大额发噶哈级卡啦吗那哦爬器然啥他哇西呀咋".split('');

                var curr = [];
                var dmsortType = $.cookie("dmsortType");
                if(dmsortType == "devicenameU"){
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

                $("#deviceTab tbody").append("<tr>"
                                        
                                        +"<td>"+'<div class="center-block">'+devices[o]["deviceid"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["alias"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["ip"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["version"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["type"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["group_name"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+"<span style='color:"+color+"';>"+status+"</span></div></td>"
                                        +"<td>"+'<div class="center-block">'+curmovie+"</div></td>"
                                        // +"<td>"+"<a  href='DeviceDetails.php?deviceid="+devices[o]["deviceid"]+"'>查看</a>"+"</td>"
                                        +"<td>"+'<div class="center-block">'+'<button href="#submitedList" data-toggle="modal" class="btn btn-primary btn-large">'+'查看</button>'+"</div></td>"
                                        // +"<td>"+'<button class="btn btn-radius btn-default">'+"<a  href='DeviceDetails.php?deviceid="+devices[o]["deviceid"]+"'>查看</a>"+' </button>'+"</td>"
                                        +"</tr>");
                $("#deviceTab .btn.btn-primary.btn-large:eq("+o+")").click({index:o,deviceId:devices[o]["deviceid"]},function(evt){      
                     $("#submitedList .modal-body").html("<iframe style='height:340px;box-shadow:0px 0px 1px 1px #888888;' frameborder='0' src='DeviceDetails.php?deviceid="+evt.data.deviceId+"'></iframe>");
                });
              }  
            }
        });
      }

      function sortByDeviceIp(){
        var dmsortType = $.cookie("dmsortType");
        if(dmsortType != "ipU" && dmsortType != "ipD"){
          $.cookie('dmsortType', 'ipU', { expires: 7 });   //第一次点击ID升序排列
        }else{
          if(dmsortType == "ipU"){
            $.cookie('dmsortType', 'ipD', { expires: 7 });   //从升序变为降序
          }else{
            $.cookie('dmsortType', 'ipU', { expires: 7 });   //从降序变为升序
          }
        }
        $("#deviceTab tbody tr").remove();
        var deviceCode = $("#deviceCode").val();
        $.post("../Controller/DeviceController.php?method=deviceSearch",{deviceCode:deviceCode},function(data){  
            devices = eval('(' +data+ ')');
            function sortByIp(devices){
              var dmsortType = $.cookie("dmsortType");
              if(dmsortType == "ipU"){
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

                $("#deviceTab tbody").append("<tr>"
                                        
                                        +"<td>"+'<div class="center-block">'+devices[o]["deviceid"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["alias"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["ip"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["version"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["type"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["group_name"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+"<span style='color:"+color+"';>"+status+"</span></div></td>"
                                        +"<td>"+'<div class="center-block">'+curmovie+"</div></td>"
                                        // +"<td>"+"<a  href='DeviceDetails.php?deviceid="+devices[o]["deviceid"]+"'>查看</a>"+"</td>"
                                        +"<td>"+'<div class="center-block">'+'<button href="#submitedList" data-toggle="modal" class="btn btn-primary btn-large">'+'查看</button>'+"</div></td>"
                                        // +"<td>"+'<button class="btn btn-radius btn-default">'+"<a  href='DeviceDetails.php?deviceid="+devices[o]["deviceid"]+"'>查看</a>"+' </button>'+"</td>"
                                        +"</tr>");
                $("#deviceTab .btn.btn-primary.btn-large:eq("+o+")").click({index:o,deviceId:devices[o]["deviceid"]},function(evt){      
                     $("#submitedList .modal-body").html("<iframe style='height:340px;box-shadow:0px 0px 1px 1px #888888;' frameborder='0' src='DeviceDetails.php?deviceid="+evt.data.deviceId+"'></iframe>");
                });
              }  
            }
        });
      }

      function sortByDeviceVersion(){
        var dmsortType = $.cookie("dmsortType");
        if(dmsortType != "versionU" && dmsortType != "versionD"){
          $.cookie('dmsortType', 'versionU', { expires: 7 });   //第一次点击ID升序排列
        }else{
          if(dmsortType == "versionU"){
            $.cookie('dmsortType', 'versionD', { expires: 7 });   //从升序变为降序
          }else{
            $.cookie('dmsortType', 'versionU', { expires: 7 });   //从降序变为升序
          }
        }
        $("#deviceTab tbody tr").remove();
        var deviceCode = $("#deviceCode").val();
        $.post("../Controller/DeviceController.php?method=deviceSearch",{deviceCode:deviceCode},function(data){  
            devices = eval('(' +data+ ')');
            function sortByVersion(devices){
              var dmsortType = $.cookie("dmsortType");
              if(dmsortType == "versionU"){
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
                    if(parseInt(devices[i]["version"].substring(5))<parseInt(devices[j]["version"].substring(5))){
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

                $("#deviceTab tbody").append("<tr>"
                                        
                                        +"<td>"+'<div class="center-block">'+devices[o]["deviceid"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["alias"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["ip"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["version"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["type"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["group_name"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+"<span style='color:"+color+"';>"+status+"</span></div></td>"
                                        +"<td>"+'<div class="center-block">'+curmovie+"</div></td>"
                                        // +"<td>"+"<a  href='DeviceDetails.php?deviceid="+devices[o]["deviceid"]+"'>查看</a>"+"</td>"
                                        +"<td>"+'<div class="center-block">'+'<button href="#submitedList" data-toggle="modal" class="btn btn-primary btn-large">'+'查看</button>'+"</div></td>"
                                        // +"<td>"+'<button class="btn btn-radius btn-default">'+"<a  href='DeviceDetails.php?deviceid="+devices[o]["deviceid"]+"'>查看</a>"+' </button>'+"</td>"
                                        +"</tr>");
                $("#deviceTab .btn.btn-primary.btn-large:eq("+o+")").click({index:o,deviceId:devices[o]["deviceid"]},function(evt){      
                     $("#submitedList .modal-body").html("<iframe style='height:340px;box-shadow:0px 0px 1px 1px #888888;' frameborder='0' src='DeviceDetails.php?deviceid="+evt.data.deviceId+"'></iframe>");
                });
              }  
            }
        });
      }

      function sortByDeviceType(){
        var dmsortType = $.cookie("dmsortType");
        if(dmsortType != "typeU" && dmsortType != "typeD"){
          $.cookie('dmsortType', 'typeU', { expires: 7 });   //第一次点击ID升序排列
        }else{
          if(dmsortType == "typeU"){
            $.cookie('dmsortType', 'typeD', { expires: 7 });   //从升序变为降序
          }else{
            $.cookie('dmsortType', 'typeU', { expires: 7 });   //从降序变为升序
          }
        }
        $("#deviceTab tbody tr").remove();
        var deviceCode = $("#deviceCode").val();
        $.post("../Controller/DeviceController.php?method=deviceSearch",{deviceCode:deviceCode},function(data){  
            devices = eval('(' +data+ ')');
            function sortByType(devices){
              var dmsortType = $.cookie("dmsortType");
              if(dmsortType == "typeU"){
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

                $("#deviceTab tbody").append("<tr>"
                                        
                                        +"<td>"+'<div class="center-block">'+devices[o]["deviceid"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["alias"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["ip"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["version"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["type"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["group_name"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+"<span style='color:"+color+"';>"+status+"</span></div></td>"
                                        +"<td>"+'<div class="center-block">'+curmovie+"</div></td>"
                                        // +"<td>"+"<a  href='DeviceDetails.php?deviceid="+devices[o]["deviceid"]+"'>查看</a>"+"</td>"
                                        +"<td>"+'<div class="center-block">'+'<button href="#submitedList" data-toggle="modal" class="btn btn-primary btn-large">'+'查看</button>'+"</div></td>"
                                        // +"<td>"+'<button class="btn btn-radius btn-default">'+"<a  href='DeviceDetails.php?deviceid="+devices[o]["deviceid"]+"'>查看</a>"+' </button>'+"</td>"
                                        +"</tr>");
                $("#deviceTab .btn.btn-primary.btn-large:eq("+o+")").click({index:o,deviceId:devices[o]["deviceid"]},function(evt){      
                     $("#submitedList .modal-body").html("<iframe style='height:340px;box-shadow:0px 0px 1px 1px #888888;' frameborder='0' src='DeviceDetails.php?deviceid="+evt.data.deviceId+"'></iframe>");
                });
              }  
            }
        });
      }


      function sortByGroupName(){
        var dmsortType = $.cookie("dmsortType");
        if(dmsortType != "groupnameU" && dmsortType != "groupnameD"){
          $.cookie('dmsortType', 'groupnameU', { expires: 7 });   //第一次点击ID升序排列
        }else{
          if(dmsortType == "groupnameU"){
            $.cookie('dmsortType', 'groupnameD', { expires: 7 });   //从升序变为降序
          }else{
            $.cookie('dmsortType', 'groupnameU', { expires: 7 });   //从降序变为升序
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
                var zh ="啊把差大额发噶哈级卡啦吗那哦爬器然啥他哇西呀咋".split('');

                var curr = [];
                var dmsortType = $.cookie("dmsortType");
                if(dmsortType == "groupnameU"){
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

                $("#deviceTab tbody").append("<tr>"
                                        
                                        +"<td>"+'<div class="center-block">'+devices[o]["deviceid"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["alias"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["ip"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["version"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["type"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["group_name"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+"<span style='color:"+color+"';>"+status+"</span></div></td>"
                                        +"<td>"+'<div class="center-block">'+curmovie+"</div></td>"
                                        // +"<td>"+"<a  href='DeviceDetails.php?deviceid="+devices[o]["deviceid"]+"'>查看</a>"+"</td>"
                                        +"<td>"+'<div class="center-block">'+'<button href="#submitedList" data-toggle="modal" class="btn btn-primary btn-large">'+'查看</button>'+"</div></td>"
                                        // +"<td>"+'<button class="btn btn-radius btn-default">'+"<a  href='DeviceDetails.php?deviceid="+devices[o]["deviceid"]+"'>查看</a>"+' </button>'+"</td>"
                                        +"</tr>");
                $("#deviceTab .btn.btn-primary.btn-large:eq("+o+")").click({index:o,deviceId:devices[o]["deviceid"]},function(evt){      
                     $("#submitedList .modal-body").html("<iframe style='height:340px;box-shadow:0px 0px 1px 1px #888888;' frameborder='0' src='DeviceDetails.php?deviceid="+evt.data.deviceId+"'></iframe>");
                });
              }  
            }
        });
      }


      function deviceSearch(){
        var deviceCode = $("#deviceCode").val();
        $.post("../Controller/DeviceController.php?method=deviceSearch",{deviceCode:deviceCode},function(data){  
            // alert(data);
            devices = eval('(' +data+ ')');
            console.log(devices);
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
                $("#deviceTab tbody").append("<tr>"
                                        
                                        +"<td>"+'<div class="center-block">'+devices[o]["deviceid"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["alias"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["ip"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["version"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["type"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+devices[o]["group_name"]+"</div></td>"
                                        +"<td>"+'<div class="center-block">'+"<span style='color:"+color+"';>"+status+"</span></div></td>"
                                        +"<td>"+'<div class="center-block">'+curmovie+"</div></td>"
                                        // +"<td>"+"<a  href='DeviceDetails.php?deviceid="+devices[o]["deviceid"]+"'>查看</a>"+"</td>"
                                        +"<td>"+'<div class="center-block">'+'<button href="#submitedList" data-toggle="modal" class="btn btn-primary btn-large">'+'查看</button>'+"</div></td>"
                                        // +"<td>"+'<button class="btn btn-radius btn-default">'+"<a  href='DeviceDetails.php?deviceid="+devices[o]["deviceid"]+"'>查看</a>"+' </button>'+"</td>"
                                        +"</tr>");
                $("#deviceTab .btn.btn-primary.btn-large:eq("+o+")").click({index:o,deviceId:devices[o]["deviceid"]},function(evt){      
                     $("#submitedList .modal-body").html("<iframe style='height:340px;box-shadow:0px 0px 1px 1px #888888;' frameborder='0' src='DeviceDetails.php?deviceid="+evt.data.deviceId+"'></iframe>");
                });
              }  
            }
        });
      }


      function clearSearch(){
        $("#deviceCode").val("");
        queryDeviceList();
      }

     

      function submitDeviceList(){
        // saveChecked();//提交时保存当前页已选择的内容

        window.location.href="MovieListManage.php";  
      }
      
      </script>

  </head>

  <body style="min-width:1018px;">

    <div class="container main-container">

      <br>
      <div class="row" >
        <div  class="col-lg-10" align="right" class="logo" ><h4><a href="#" id="loginButton"><span></span></a></h4></div> 
      </div> 
      <div class="row">
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
                <th><a href="javascript:;" style="text-decoration: none;" onclick="sortByGroupName()">组别名&#8593&#8595</a></th>
                <th>状态</th> 
                <th>影片名称</th>   
                <th>播放列表</th>           
              </tr>
            </thead>

            <tbody>
            <!--   动态添加表格项   -->
            </tbody>
          </table>
        </div>

      </div>
      <br>
      <div class="row" align="center">
          <br>
          <br>
      </div>
    </div>

    <!-- model模态框，显示选中查看的播放列表 -->
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

  </body>

  <script type="text/javascript">
    $(window).load(queryDeviceList());
  </script>

</html>