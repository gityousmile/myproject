<html>
   <head>
      <meta http-equiv="content-type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!--    <link href="../css/style.css" rel="stylesheet" type="text/css" media="all"/> -->
      <script src="../js/jquery.min.js"></script>
      <script src="../js/bootstrap.min.js"></script>
      <script src="../js/sweetalert.min.js"></script>  
      <script src="../js/jquery.cookie.js"></script>
      <link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
      <link href="../css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="../css/myFont.css" /><!-- 此处设置页面字体为微软雅黑，在css最后覆盖前面的字体样式 -->
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

        function get_unix_time(dateStr){
            var newstr = dateStr.replace(/-/g,'/'); 
            var date =  new Date(newstr); 
            var time_str = date.getTime().toString();
            return time_str.substr(0, 10);
        }

        function unix_to_date(unix) {
          var now = new Date(parseInt(unix) * 1000);
          Y = now.getFullYear() + '-';
          M = (now.getMonth()+1 < 10 ? '0'+(now.getMonth()+1) : now.getMonth()+1) + '-';
          D = now.getDate();
          date = Y+M+D;
          return date;
        }

        function queryDeviceList(){    
          $("#mobileTab tbody tr").remove();
          //动态生成电影列表
          $.get("../Controller/DeviceController.php?method=getRegisteredDevices",{},function(data){  
            // alert(data);
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
              $("#deviceTab tbody").append("<tr>"
                                      
                                      +"<td>"+devices[o]["deviceid"]+"</td>"
                                      +"<td>"+devices[o]["alias"]+"</td>"
                                      +"<td>"+devices[o]["group_name"]+"</td>"
                                      +"<td>"+devices[o]["register_time"]+"</td>"
                                      +"<td><button class='btn btn-primary  btn-md' onclick='deleteDevice(this);'>删除</button></td>"
                                      +"<td><button class='btn btn-primary  btn-md' onclick='editDevice(this);'>修改</button></td>"
                                      +"</tr>");  
            }
          });
        }

      function sortByDeviceId(){
        var devicesortType = $.cookie("devicesortType");
        if(devicesortType != "idU" && devicesortType != "idD"){
          $.cookie('devicesortType', 'idU', { expires: 7 });   //第一次点击ID升序排列
        }else{
          if(devicesortType == "idU"){
            $.cookie('devicesortType', 'idD', { expires: 7 });   //从升序变为降序
          }else{
            $.cookie('devicesortType', 'idU', { expires: 7 });   //从降序变为升序
          }
        }
        $("#deviceTab tbody tr").remove();
        $.get("../Controller/DeviceController.php?method=getRegisteredDevices",{},function(data){  
            // alert(data);
            devices = eval('(' +data+ ')');
            function sortById(devices){
              var devicesortType = $.cookie("devicesortType");
              if(devicesortType == "idU"){
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
              $("#deviceTab tbody").append("<tr>"
                                      
                                      +"<td>"+devices[o]["deviceid"]+"</td>"
                                      +"<td>"+devices[o]["alias"]+"</td>"
                                      +"<td>"+devices[o]["group_name"]+"</td>"
                                      +"<td>"+devices[o]["register_time"]+"</td>"
                                      +"<td><button class='btn btn-primary  btn-md' onclick='deleteDevice(this);'>删除</button></td>"
                                      +"<td><button class='btn btn-primary  btn-md' onclick='editDevice(this);'>修改</button></td>"
                                      +"</tr>");  
            }
          });
      }

      function sortByDeviceName(){
        var devicesortType = $.cookie("devicesortType");
        if(devicesortType != "devicenameU" && devicesortType != "devicenameD"){
          $.cookie('devicesortType', 'devicenameU', { expires: 7 });   //第一次点击ID升序排列
        }else{
          if(devicesortType == "devicenameU"){
            $.cookie('devicesortType', 'devicenameD', { expires: 7 });   //从升序变为降序
          }else{
            $.cookie('devicesortType', 'devicenameU', { expires: 7 });   //从降序变为升序
          }
        }
        $("#deviceTab tbody tr").remove();
        $.get("../Controller/DeviceController.php?method=getRegisteredDevices",{},function(data){  
            // alert(data);
            device = eval('(' +data+ ')');
            function pySegSort(devices,empty) {
                if(!String.prototype.localeCompare)
                  return null;

                var letters ="abcdefghjklmnopqrstwxyz".split('');
                var EN ="ABCDEFGHJKLMNOPQRSTWXYZ".split('');
                var zh ="啊把差大额发噶哈级卡啦吗那哦爬器然啥他哇西呀咋".split('');

                var curr = [];
                var devicesortType = $.cookie("devicesortType");
                if(devicesortType == "devicenameU"){
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
            var devicesList = pySegSort(device);
            for(var o in devicesList){
              $("#deviceTab tbody").append("<tr>"
                                      
                                      +"<td>"+devicesList[o]["deviceid"]+"</td>"
                                      +"<td>"+devicesList[o]["alias"]+"</td>"
                                      +"<td>"+devices[o]["group_name"]+"</td>"
                                      +"<td>"+devicesList[o]["register_time"]+"</td>"
                                      +"<td><button class='btn btn-primary  btn-md' onclick='deleteDevice(this);'>删除</button></td>"
                                      +"<td><button class='btn btn-primary  btn-md' onclick='editDevice(this);'>修改</button></td>"
                                      +"</tr>");  
            }
          });
      }

      function sortByGroupName(){
        var devicesortType = $.cookie("devicesortType");
        if(devicesortType != "groupnameU" && devicesortType != "groupnameD"){
          $.cookie('devicesortType', 'groupnameU', { expires: 7 });   //第一次点击ID升序排列
        }else{
          if(devicesortType == "groupnameU"){
            $.cookie('devicesortType', 'groupnameD', { expires: 7 });   //从升序变为降序
          }else{
            $.cookie('devicesortType', 'groupnameU', { expires: 7 });   //从降序变为升序
          }
        }
        $("#deviceTab tbody tr").remove();
        $.get("../Controller/DeviceController.php?method=getRegisteredDevices",{},function(data){  
            // alert(data);
            devices = eval('(' +data+ ')');
            function pySegSort(devices,empty) {
                if(!String.prototype.localeCompare)
                  return null;

                var letters ="abcdefghjklmnopqrstwxyz".split('');
                var EN ="ABCDEFGHJKLMNOPQRSTWXYZ".split('');
                var zh ="啊把差大额发噶哈级卡啦吗那哦爬器然啥他哇西呀咋".split('');

                var curr = [];
                var devicesortType = $.cookie("devicesortType");
                if(devicesortType == "groupnameU"){
                  for(i=0;i<letters.length;i++){
                    for(j=0;j<devices.length;j++){
                      if(((!zh[i] || zh[i].localeCompare(devices[j]["group_name"]) <= 0) && devices[j]["group_name"].localeCompare(zh[i+1]) == -1) || ((!EN[i] || EN[i].localeCompare(devices[j]["group_name"]) <= 0) && devices[j]["group_name"].localeCompare(EN[i+1]) == -1)) {
                        curr.push(devices[j]);
                      }
                    }
                  }
                }else{
                  for(i=letters.length;i>=0;i--){
                    for(j=0;j<devices.length;j++){
                      if(((!zh[i] || zh[i].localeCompare(devices[j]["group_name"]) >= 0) && devices[j]["group_name"].localeCompare(zh[i-1]) >= 0) || ((!EN[i] || EN[i].localeCompare(devices[j]["group_name"]) >= 0) && devices[j]["group_name"].localeCompare(EN[i-1]) >= 0)) {
                        curr.push(devices[j]);
                      }
                    }
                  }
                }
                return curr;
            }
            var devicesList = pySegSort(devices);
            for(var o in devicesList){
              $("#deviceTab tbody").append("<tr>"
                                      
                                      +"<td>"+devicesList[o]["deviceid"]+"</td>"
                                      +"<td>"+devicesList[o]["alias"]+"</td>"
                                      +"<td>"+devicesList[o]["group_name"]+"</td>"
                                      +"<td>"+devicesList[o]["register_time"]+"</td>"
                                      +"<td><button class='btn btn-primary  btn-md' onclick='deleteDevice(this);'>删除</button></td>"
                                      +"<td><button class='btn btn-primary  btn-md' onclick='editDevice(this);'>修改</button></td>"
                                      +"</tr>");  
            }
          });
      }

      function sortByRegisterTime(){
          var devicesortType = $.cookie("devicesortType");
          if(devicesortType != "registertimeU" && devicesortType != "registertimeD"){
            $.cookie('devicesortType', 'registertimeU', { expires: 7 });   //第一次点击ID升序排列
          }else{
            if(devicesortType == "registertimeU"){
              $.cookie('devicesortType', 'registertimeD', { expires: 7 });   //从升序变为降序
            }else{
              $.cookie('devicesortType', 'registertimeU', { expires: 7 });   //从降序变为升序
            }
          }
          $("#deviceTab tbody tr").remove();
          $.get("../Controller/DeviceController.php?method=getRegisteredDevices",{},function(data){  
              // alert(data);
              devices = eval('(' +data+ ')');
              for(var o in devices){
                devices[o]["register_time"] = get_unix_time(devices[o]["register_time"]);
              }
              function sortByTime(devices){
                var devicesortType = $.cookie("devicesortType");
                if(devicesortType == "registertimeU"){
                  for(var i=0;i<devices.length;i++){
                    for(var j=i;j<devices.length;j++){
                      if(devices[i]["register_time"]>devices[j]["register_time"]){
                         var temp = devices[i];
                         devices[i] = devices[j];
                         devices[j] = temp;
                      }
                    }           
                  }     
                }else{
                  for(var i=0;i<devices.length;i++){
                    for(var j=i;j<devices.length;j++){
                      if(devices[i]["register_time"]<devices[j]["register_time"]){
                         var temp = devices[i];
                         devices[i] = devices[j];
                         devices[j] = temp;
                      }
                    }           
                  }
                }
                return devices;
              } 
              for(var o in sortByTime(devices)){
                $("#deviceTab tbody").append("<tr>"
                                        
                                        +"<td>"+devices[o]["deviceid"]+"</td>"
                                        +"<td>"+devices[o]["alias"]+"</td>"
                                        +"<td>"+devices[o]["group_name"]+"</td>"
                                        +"<td>"+unix_to_date(devices[o]["register_time"])+"</td>"
                                        +"<td><button class='btn btn-primary  btn-md' onclick='deleteDevice(this);'>删除</button></td>"
                                        +"<td><button class='btn btn-primary  btn-md' onclick='editDevice(this);'>修改</button></td>"
                                        +"</tr>");  
              }
            });
      }

      function deleteDevice(curLine){
        var deviceId=$(curLine).parent().prev().prev().prev().prev().html();
        var deviceName=$(curLine).parent().prev().prev().prev().html();
        swal({  
              title:"",  
              text:"确定要停止删除该设备吗？",  
              type:"warning",  
              showCancelButton:"true",  
              showConfirmButton:"true",  
              confirmButtonText:"确定",  
              cancelButtonText:"取消",  
              animation:"slide-from-top"  
          }, function() { 
            $.get("../Controller/DeviceController.php?method=deleteRegisteredDevice",{deviceId:deviceId,deviceName:deviceName},function(data){
              swal(data);
              setTimeout('window.location.href = "RegisteredDevice.php"',1000);
            });
        });
      }

      var deviceOldName; 
      function editDevice(curLine){
        var td=$(curLine).parent();//编辑按钮所在列
        deviceOldName=$(curLine).parent().prev().prev().prev().prev().html();
        td.prev().prev().prev().prev().html("<input type='text'  class='form-control input-md' size='3' placeholder='"+$(curLine).parent().prev().prev().prev().prev().html()+"'>");
        $(curLine).remove();
        td.append("<button class='btn btn-warning  btn-md' onclick='saveDevice(this);'>保存</button>");
      }

      function saveDevice(curLine){
        var deviceId=$(curLine).parent().prev().prev().prev().prev().prev().html();
        var aliasTd=$(curLine).parent().prev().prev().prev().prev();//编辑框所在列
        var alias=aliasTd.find("input").val();
        var placeholder=aliasTd.find("input").attr("placeholder");
        var td=$(curLine).parent();//保存按钮所在列
        if(deviceId==""||alias==""){//当没有改动时还原原始别名
          $(curLine).remove();
          td.append("<button class='btn btn-primary  btn-md' onclick='editDevice(this);'>修改</button>");
          aliasTd.find("input").remove();
          aliasTd.append(placeholder);
          return;
        }
        $.get("../Controller/DeviceController.php?method=updateRegisteredDevice",{deviceId:deviceId,deviceOldName:deviceOldName,alias:alias},function(data){
          swal(data);
        });
        $(curLine).remove();
        td.append("<button class='btn btn-primary  btn-md' onclick='editDevice(this);'>修改</button>");
        aliasTd.find("input").remove();
        aliasTd.append(alias);
      }

      </script>

  </head>

  <body>

    <div class="container main-container">
      <div class="row">
        <div class="col-lg-2">
        </div> 

        <div class="col-lg-8">
          <p style="font-size: 21px;margin-bottom:-15px;">已注册设备</p>
          <p style="float:right;margin-right:10px;margin-bottom:5px;">组别数:<b id="groupTimes" style="color:red;margin-left:5px"></b></p>
          <p style="float:right;margin-right:10px;margin-bottom:5px;">设备数:<b id="deviceCount" style="color:red;margin-left:5px"></b></p>
          <legend></legend>

          <table id="deviceTab" class="table table-hover table-striped table-bordered">       
            <thead>
              <tr>
              <!--   <th>是否勾选</th> -->
                <th><a href="javascript:;" style="text-decoration: none;" onclick="sortByDeviceId()">设备ID&#8593&#8595</a></th>
                <th><a href="javascript:;" style="text-decoration: none;" onclick="sortByDeviceName()">设备别名&#8593&#8595</a></th>
                <th><a href="javascript:;" style="text-decoration: none;" onclick="sortByGroupName()">组别&#8593&#8595</a></th>
                <th><a href="javascript:;" style="text-decoration: none;" onclick="sortByRegisterTime()">注册时间&#8593&#8595</a></th>                 <th>删除</th>
                <th>修改</th>               
              </tr>
            </thead>

            <tbody>
            <!--   动态添加表格项   -->
            </tbody>
          </table>
        </div>

        <div class="col-lg-2">
        </div> 

      </div>
      <br>
      <div class="row" align="center">
          <br>
          <br>
      </div>
    </div>

  </body>

  <script type="text/javascript">
    $(window).load(queryDeviceList());
  </script>

</html>