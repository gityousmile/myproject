<html>
   <head>
      <meta http-equiv="content-type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <link href="../css/style.css" rel="stylesheet" type="text/css" media="all"/>
      <link href="../css/bootstrap.min.css" rel="stylesheet">
      <script src="../js/jquery.min.js"></script>
      <script src="../js/jquery.cookie.js"></script>
      <script src="../js/sweetalert.min.js"></script> 
      <link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
      <script type="text/javascript" src="../js/zepto.js?2"></script>
      <link rel="stylesheet" href="../css/guanlicenter_zcsy.css" />
      <script type="text/javascript" src="../My97DatePicker/WdatePicker.js"></script>
      <link rel="stylesheet" href="../css/myFont.css" />
      <link rel="stylesheet" href="../css/paging.css" />
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

        function queryMovieList(){
          var localsortType = $.cookie("localsortType");
          var video;    
	        document.getElementById('showPage').style.display='block';
          $("#mobileTab thead tr").remove();
          $("#mobileTab thead").append("<tr>"                                         
                                                +'<th><a href="javascript:;" style="text-decoration: none;" onclick="localsortById()">影片ID&#8593&#8595</a></th>'
                                                +'<th><a href="javascript:;" style="text-decoration: none;" onclick="localsortByFileName()">影片名&#8593&#8595</a></th>'
                                                +'<th><a href="javascript:;" style="text-decoration: none;" onclick="localsortByDownTime()">下载日期&#8593&#8595</a> </th>'
                                                +'<th><a href="javascript:;" style="text-decoration: none;" onclick="localsortByReleaseDate()">上映年份&#8593&#8595</a></th>'                           
                                                +"<th>影片类型</th>"                                                                                    
                                                +"<th>影片时长</th>"
                                                +"<th>状态</th>"
                                                +"</tr>");
          $("#mobileTab tbody tr").remove();
          //动态生成电影列表
          $.get("../Controller/MovieController.php?method=getVideoList",{},function(data){ 
            videos = eval('(' +data+ ')'); 
            // console.log(data);
            var curpage = <?php echo $curpage = empty($_GET['page']) ? 1 : $_GET['page'];?>;

            if(localsortType == "idU"){
              function sortById(videos){
                for(var i=0;i<videos.length;i++){
                   for(var j=i;j<videos.length;j++){
                      if(videos[i]["id"]-videos[j]["id"]>=0){
                         var temp = videos[i];
                         videos[i] = videos[j];
                         videos[j] = temp;
                      }
                   }           
                }
                return videos;
              }
              video = sortById(videos);
            }else if(localsortType == "idD"){
              function sortById(videos){
                for(var i=0;i<videos.length;i++){
                   for(var j=i;j<videos.length;j++){
                      if(videos[i]["id"]-videos[j]["id"]<=0){
                         var temp = videos[i];
                         videos[i] = videos[j];
                         videos[j] = temp;
                      }
                   }           
                }
                return videos;
              }
              video = sortById(videos);
            }else if(localsortType == "filenameU"){
              function pySegSort(videos,empty) {
                if(!String.prototype.localeCompare)
                  return null;

                var letters ="abcdefghjklmnopqrstwxyz".split('');
                var EN ="ABCDEFGHJKLMNOPQRSTWXYZ".split('');
                var zh ="啊把差大额发噶哈级卡啦吗那哦爬器然啥他哇西呀咋".split('');

                var curr = [];
                for(i=0;i<letters.length;i++){
                  for(j=0;j<videos.length;j++){
                    if(((!zh[i] || zh[i].localeCompare(videos[j]["file_name"]) <= 0) && videos[j]["file_name"].localeCompare(zh[i+1]) == -1) || ((!EN[i] || EN[i].localeCompare(videos[j]["file_name"]) <= 0) && videos[j]["file_name"].localeCompare(EN[i+1]) == -1)) {
                      curr.push(videos[j]);
                    }
                  }
                }
                return curr;
              }
              video = pySegSort(videos);
            }else if(localsortType == "filenameD"){
              function pySegSort(videos,empty) {
                if(!String.prototype.localeCompare)
                  return null;

                var letters ="abcdefghjklmnopqrstwxyz".split('');
                var EN ="ABCDEFGHJKLMNOPQRSTWXYZ".split('');
                var zh ="啊把差大额发噶哈级卡啦吗那哦爬器然啥他哇西呀咋".split('');

                var curr = [];
                for(i=letters.length;i>=0;i--){
                  for(j=0;j<videos.length;j++){
                    if(((!zh[i] || zh[i].localeCompare(videos[j]["file_name"]) >= 0) && videos[j]["file_name"].localeCompare(zh[i-1]) >= 0) || ((!EN[i] || EN[i].localeCompare(videos[j]["file_name"]) >= 0) && videos[j]["file_name"].localeCompare(EN[i-1]) >= 0)) {
                      curr.push(videos[j]);
                    }
                  }
                }
                return curr;
              }
              video = pySegSort(videos);

            }else if(localsortType == "downtimeU"){
              function sortByDownTime(videos){
                for(var i=0;i<videos.length;i++){
                   for(var j=i;j<videos.length;j++){
                      if(videos[i]["down_time"]-videos[j]["down_time"]>=0){
                         var temp = videos[i];
                         videos[i] = videos[j];
                         videos[j] = temp;
                      }
                   }           
                }
                return videos;
              }
              video = sortByDownTime(videos);
            }else if(localsortType == "downtimeD"){
              function sortByDownTime(videos){
                for(var i=0;i<videos.length;i++){
                   for(var j=i;j<videos.length;j++){
                      if(videos[i]["down_time"]-videos[j]["down_time"]<=0){
                         var temp = videos[i];
                         videos[i] = videos[j];
                         videos[j] = temp;
                      }
                   }           
                }
                return videos;
              }
              video = sortByDownTime(videos);
            }else if(localsortType == "releasedateU"){
              function sortByReleaseDate(videos){
                for(var i=0;i<videos.length;i++){
                   for(var j=i;j<videos.length;j++){
                      if(videos[i]["release_date"]-videos[j]["release_date"]>=0){
                         var temp = videos[i];
                         videos[i] = videos[j];
                         videos[j] = temp;
                      }
                   }           
                }
                return videos;
              }
              video = sortByReleaseDate(videos);
            }else if(localsortType == "releasedateD"){
              function sortByReleaseDate(videos){
                for(var i=0;i<videos.length;i++){
                   for(var j=i;j<videos.length;j++){
                      if(videos[i]["release_date"]-videos[j]["release_date"]<=0){
                         var temp = videos[i];
                         videos[i] = videos[j];
                         videos[j] = temp;
                      }
                   }           
                }
                return videos;
              }
              video = sortByReleaseDate(videos);
            }else{
              video = videos;
            }
            for(var o in video){
               if(o>=(curpage-1)*10&&o<curpage*10){
                  var play_type= (video[o]["play_type"]==1) ? "2D":"3D";                 
                  var down_status= (video[o]["down_status"]==1) ? "正在下载":"已下载";
                  $("#mobileTab tbody").append("<tr>"
                                    
                                    +"<td>"+video[o]["id"]+"</td>"
                                    +"<td>"+'<a href="#" style="color:#000000;text-decoration:none" onclick="javascript:LookDetails(this)">'+video[o]["file_name"]+"</a></td>"
                                    +"<td>"+unix_to_datetime(video[o]["down_time"])+"</td>"
                                    +"<td>"+video[o]["release_date"]+"</td>"                           
                                    +"<td>"+play_type+"</td>"
                                   
                                    // +"<td>"+videos[o]["play_times"]+"</td>"
                                    +"<td>"+formatSeconds(video[o]["time"])+"</td>"
                                    +"<td>"+down_status+"</td>"
                                    +"</tr>");  
              }
            }  
          });
        }

        function LookDetails(obj){
          var LookDetails = $(obj).html();
          window.location.href="../View/MovieDetails.php?mv="+LookDetails;
        }

        function localsortById(){
          var localsortType = $.cookie("localsortType");
          if(localsortType != "idU" && localsortType != "idD"){
            $.cookie('localsortType', 'idU', { expires: 7 });   //第一次点击ID升序排列
          }else{
            if(localsortType == "idU"){
              $.cookie('localsortType', 'idD', { expires: 7 });   //从升序变为降序
            }else{
              $.cookie('localsortType', 'idU', { expires: 7 });   //从降序变为升序
            }
          }
          $("#mobileTab tbody tr").remove();
          //动态生成电影列表
          $.get("../Controller/MovieController.php?method=getVideoList",{},function(data){ 
            videos = eval('(' +data+ ')');
            function sortById(videos){
              var localsortType = $.cookie("localsortType");
              if(localsortType == "idU"){
                for(var i=0;i<videos.length;i++){
                  for(var j=i;j<videos.length;j++){
                    if(videos[i]["id"]-videos[j]["id"]>=0){
                       var temp = videos[i];
                       videos[i] = videos[j];
                       videos[j] = temp;
                    }
                  }           
                }     
              }else{
                for(var i=0;i<videos.length;i++){
                  for(var j=i;j<videos.length;j++){
                    if(videos[i]["id"]-videos[j]["id"]<=0){
                       var temp = videos[i];
                       videos[i] = videos[j];
                       videos[j] = temp;
                    }
                  }           
                }
              }
              return videos;
            }
            var curpage = <?php echo $curpage = empty($_GET['page']) ? 1 : $_GET['page'];?>;
            for(var o in sortById(videos)){
               if(o>=(curpage-1)*10&&o<curpage*10){
                  var play_type= (videos[o]["play_type"]==1) ? "2D":"3D";                 
                  var down_status= (videos[o]["down_status"]==1) ? "正在下载":"已下载";
                  $("#mobileTab tbody").append("<tr>"
                                    
                                    +"<td>"+videos[o]["id"]+"</td>"
                                    +"<td>"+'<a href="#" style="color:#000000;text-decoration:none" onclick="javascript:LookDetails(this)">'+videos[o]["file_name"]+"</a></td>"
                                    +"<td>"+unix_to_datetime(videos[o]["down_time"])+"</td>"
                                    +"<td>"+videos[o]["release_date"]+"</td>"                           
                                    +"<td>"+play_type+"</td>"
                                   
                                    // +"<td>"+videos[o]["play_times"]+"</td>"
                                    +"<td>"+formatSeconds(videos[o]["time"])+"</td>"
                                    +"<td>"+down_status+"</td>"
                                    +"</tr>");  
              }
            }  
          });
        }

        function localsortByFileName(){
          var localsortType = $.cookie("localsortType");
          if(localsortType != "filenameU" && localsortType != "filenameD"){
            $.cookie('localsortType', 'filenameU', { expires: 7 });   //第一次点击ID升序排列
          }else{
            if(localsortType == "filenameU"){
              $.cookie('localsortType', 'filenameD', { expires: 7 });   //从升序变为降序
            }else{
              $.cookie('localsortType', 'filenameU', { expires: 7 });   //从降序变为升序
            }
          }
          $("#mobileTab tbody tr").remove();
          //动态生成电影列表
          $.get("../Controller/MovieController.php?method=getVideoList",{},function(data){ 
            videos = eval('(' +data+ ')');
            function pySegSort(videos,empty) {
                if(!String.prototype.localeCompare)
                  return null;

                var letters ="abcdefghjklmnopqrstwxyz".split('');
                var EN ="ABCDEFGHJKLMNOPQRSTWXYZ".split('');
                var zh ="啊把差大额发噶哈级卡啦吗那哦爬器然啥他哇西呀咋".split('');

                var curr = [];
                var localsortType = $.cookie("localsortType");
                if(localsortType == "filenameU"){
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
            var curpage = <?php echo $curpage = empty($_GET['page']) ? 1 : $_GET['page'];?>;
            for(var o in VideoList){
               if(o>=(curpage-1)*10&&o<curpage*10){
                  var play_type= (VideoList[o]["play_type"]==1) ? "2D":"3D";                 
                  var down_status= (VideoList[o]["down_status"]==1) ? "正在下载":"已下载";
                  $("#mobileTab tbody").append("<tr>"
                                    
                                    +"<td>"+VideoList[o]["id"]+"</td>"
                                    +"<td>"+'<a href="#" style="color:#000000;text-decoration:none" onclick="javascript:LookDetails(this)">'+VideoList[o]["file_name"]+"</a></td>"
                                    +"<td>"+unix_to_datetime(VideoList[o]["down_time"])+"</td>"
                                    +"<td>"+VideoList[o]["release_date"]+"</td>"                           
                                    +"<td>"+play_type+"</td>"
                                   
                                    // +"<td>"+videos[o]["play_times"]+"</td>"
                                    +"<td>"+formatSeconds(VideoList[o]["time"])+"</td>"
                                    +"<td>"+down_status+"</td>"
                                    +"</tr>");  
              }
            }  
          });
        }

        function localsortByDownTime(){
          var localsortType = $.cookie("localsortType");
          if(localsortType != "downtimeU" && localsortType != "downtimeD"){
            $.cookie('localsortType', 'downtimeU', { expires: 7 });   //第一次点击ID升序排列
          }else{
            if(localsortType == "downtimeU"){
              $.cookie('localsortType', 'downtimeD', { expires: 7 });   //从升序变为降序
            }else{
              $.cookie('localsortType', 'downtimeU', { expires: 7 });   //从降序变为升序
            }
          }
          $("#mobileTab tbody tr").remove();
          //动态生成电影列表
          $.get("../Controller/MovieController.php?method=getVideoList",{},function(data){ 
            videos = eval('(' +data+ ')');
            function sortByDownTime(videos){
              var localsortType = $.cookie("localsortType");
              if(localsortType == "downtimeU"){
                 for(var i=0;i<videos.length;i++){
                   for(var j=i;j<videos.length;j++){
                      if(videos[i]["down_time"]-videos[j]["down_time"]>=0){
                         var temp = videos[i];
                         videos[i] = videos[j];
                         videos[j] = temp;
                      }
                   }           
                 }
              }else{
                 for(var i=0;i<videos.length;i++){
                   for(var j=i;j<videos.length;j++){
                      if(videos[i]["down_time"]-videos[j]["down_time"]<=0){
                         var temp = videos[i];
                         videos[i] = videos[j];
                         videos[j] = temp;
                      }
                   }           
                 }
              }
              return videos;
            }
            var curpage = <?php echo $curpage = empty($_GET['page']) ? 1 : $_GET['page'];?>;
            for(var o in sortByDownTime(videos)){
               if(o>=(curpage-1)*10&&o<curpage*10){
                  var play_type= (videos[o]["play_type"]==1) ? "2D":"3D";                 
                  var down_status= (videos[o]["down_status"]==1) ? "正在下载":"已下载";
                  $("#mobileTab tbody").append("<tr>"
                                    
                                    +"<td>"+videos[o]["id"]+"</td>"
                                    +"<td>"+'<a href="#" style="color:#000000;text-decoration:none" onclick="javascript:LookDetails(this)">'+videos[o]["file_name"]+"</a></td>"
                                    +"<td>"+unix_to_datetime(videos[o]["down_time"])+"</td>"
                                    +"<td>"+videos[o]["release_date"]+"</td>"                           
                                    +"<td>"+play_type+"</td>"
                                   
                                    // +"<td>"+videos[o]["play_times"]+"</td>"
                                    +"<td>"+formatSeconds(videos[o]["time"])+"</td>"
                                    +"<td>"+down_status+"</td>"
                                    +"</tr>");  
              }
            }  
          });
        }

        function localsortByReleaseDate(){
          var localsortType = $.cookie("localsortType");
          if(localsortType != "releasedateU" && localsortType != "releasedateD"){
            $.cookie('localsortType', 'releasedateU', { expires: 7 });   //第一次点击ID升序排列
          }else{
            if(localsortType == "releasedateU"){
              $.cookie('localsortType', 'releasedateD', { expires: 7 });   //从升序变为降序
            }else{
              $.cookie('localsortType', 'releasedateU', { expires: 7 });   //从降序变为升序
            }
          }
          $("#mobileTab tbody tr").remove();
          //动态生成电影列表
          $.get("../Controller/MovieController.php?method=getVideoList",{},function(data){ 
            videos = eval('(' +data+ ')');
            function sortByReleaseDate(videos){
              var localsortType = $.cookie("localsortType");
              if(localsortType == "releasedateU"){
                for(var i=0;i<videos.length;i++){
                  for(var j=i;j<videos.length;j++){
                    if(videos[i]["release_date"] >= videos[j]["release_date"]){
                       var temp = videos[i];
                       videos[i] = videos[j];
                       videos[j] = temp;
                    }
                  }           
                }
              }else{
                for(var i=0;i<videos.length;i++){
                  for(var j=i;j<videos.length;j++){
                    if(videos[i]["release_date"] <= videos[j]["release_date"]){
                       var temp = videos[i];
                       videos[i] = videos[j];
                       videos[j] = temp;
                    }
                  }           
                }
              }
              return videos;
            }
            var curpage = <?php echo $curpage = empty($_GET['page']) ? 1 : $_GET['page'];?>;
            for(var o in sortByReleaseDate(videos)){
               if(o>=(curpage-1)*10&&o<curpage*10){
                  var play_type= (videos[o]["play_type"]==1) ? "2D":"3D";                 
                  var down_status= (videos[o]["down_status"]==1) ? "正在下载":"已下载";
                  $("#mobileTab tbody").append("<tr>"
                                    
                                    +"<td>"+videos[o]["id"]+"</td>"
                                    +"<td>"+'<a href="#" style="color:#000000;text-decoration:none" onclick="javascript:LookDetails(this)">'+videos[o]["file_name"]+"</a></td>"
                                    +"<td>"+unix_to_datetime(videos[o]["down_time"])+"</td>"
                                    +"<td>"+videos[o]["release_date"]+"</td>"                           
                                    +"<td>"+play_type+"</td>"
                                   
                                    // +"<td>"+videos[o]["play_times"]+"</td>"
                                    +"<td>"+formatSeconds(videos[o]["time"])+"</td>"
                                    +"<td>"+down_status+"</td>"
                                    +"</tr>");  
              }
            }  
          });
        }


        function changeTimeToUnix(ctime){  

          var new_str = ctime.replace(/:/g,'-');
          new_str = new_str.replace(/ /g,'-');

          var arr = new_str.split("-");

          var datum = new Date(Date.UTC(arr[0],arr[1]-1,arr[2],arr[3]-8,arr[4],arr[5]));
          //alert("转换后的UNIX时间戳为 "+(datum.getTime()/1000));
          return (datum.getTime()/1000);
        }

        function search(){    
             document.getElementById('showPage').style.display='none';

            var video_year=document.getElementById("pub_year").value;
            if(video_year=="")
            {
              video_year="NULL";
            }
            var down_date_start=document.getElementById("down_date_start").value;
            var down_date_end=document.getElementById("down_date_end").value;
            var down_start="NULL";
            var down_end="NULL";
            if(down_date_start!="")
            {
            var down_start=changeTimeToUnix(down_date_start+" 00:00:00");
            }


            if(down_date_end!="")
            {
            var down_end=changeTimeToUnix(down_date_end+" 23:59:59");
            }


            var keywords=document.getElementById("searchVideo").value;
            if(keywords=="")
            {
                 keywords="NULL";
            }

            var video_type = +$(".diy_select_input").val();

            if(video_type=="")
            {
                 video_type="NULL";
            }
            
            $("#mobileTab thead tr").remove();
            $("#mobileTab thead").append("<tr>"                                         
                                                  +"<th>影片ID</th>"
                                                  +"<th>影片名</th>"
                                                  +"<th>下载日期</th>"
                                                  +"<th>上映年份</th>"                           
                                                  +"<th>影片类型</th>"                                                                                    
                                                  +"<th>影片时长</th>"
                                                  +"<th>状态</th>"
                                                  +"</tr>");
            $("#mobileTab tbody tr").remove();
            //动态生成电影列表
            $.get("../Controller/MovieController.php?method=getDownloadAndLoadingMovieByConditions&video_year="+video_year+"&video_type="+video_type+"&keywords="+keywords+"",{},function(data){  
                videos = eval('(' +data+ ')'); 

                num=0;
                for(var o in videos){
                  num++;
                }
                for(var o in videos){
                    // if(o>=(curpage-1)*10&&o<curpage*10){
              		  var downtime=videos[o]["down_time"];
                    var film_type_text=videos[o]["film_type_text"];

                    if((down_start!="NULL"&&downtime<down_start)||(down_end!="NULL"&&downtime>down_end))
                      continue;
                      var play_type = (videos[o]["play_type"]==1) ? "2D":"3D";
                      var down_status= (videos[o]["down_status"]==1) ? "正在下载":"已下载";
                      $("#mobileTab tbody").append("<tr>"                                         
                                                  +"<td>"+videos[o]["id"]+"</td>"
                                                  +"<td>"+'<a href="#" style="color:#000000;text-decoration:none" onclick="javascript:LookDetails(this)">'+videos[o]["file_name"]+"</a></td>"
                                                  +"<td>"+unix_to_datetime(videos[o]["down_time"])+"</td>"
                                                  +"<td>"+videos[o]["release_date"]+"</td>"                           
                                                  +"<td>"+play_type+"</td>"         				                                                                   
                                                  +"<td>"+formatSeconds(videos[o]["time"])+"</td>"
              				    +"<td>"+down_status+"</td>"
                                                  +"</tr>");  
                    //}
                }  
          });
        }

      function updateVideoList(){
        swal({  
                  title:"",  
                  text:"确定要更新本地数据库吗？",  
                  type:"warning",  
                  showCancelButton:"true",  
                  showConfirmButton:"true",  
                  confirmButtonText:"确定",  
                  cancelButtonText:"取消",  
                  animation:"slide-from-top"  
              }, function() {
                show_loading();
                $.get("../Utils/updateVideoList.php",{},function(data){
                  if(data == "本地数据库更新成功"){
                    close_loading();
                    swal("成功", "本地数据库更新成功", "success"); 
                  }else{
                    window.setTimeout("close_loading();swal('本地数据库为最新库');",1000);
                  }
                });  
        });
      }

      function importVideo(){
        swal({  
                  title:"",  
                  text:"确定要导入影片吗？",  
                  type:"warning",  
                  showCancelButton: true, 
                  closeOnConfirm: false,  
                  confirmButtonText:"确定",  
                  cancelButtonText:"取消",  
                  animation:"slide-from-top"  
              }, function() {  
                $.get("../Controller/MovieController.php?method=importVideo",{},function(data){
                  swal(data);
                });  
        });
      }

      function initInfo(){
        queryMovieList();
      }

      
    </script>

  </head>

  <body>

    <div class="container main-container">
      <legend>筛选条件</legend>
      <div class="clearfix searchspin">
            <dl>
                       
                <dd>
                    <form>
                      <div style="float:left" >
                        下载日期
                        <input type="text" id="down_date_start" name="down_date_start" size="10" value="" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'down_date_end\')||\'%y-%M-%d\'}'})" placeholder="开始日期"  /> 至
                        <input type="text" id="down_date_end" name="down_date_end" size="10" value=""  onfocus="WdatePicker({minDate:'#F{$dp.$D(\'down_date_start\')}',maxDate:'%y-%M-%d'})" placeholder="结束日期" /> 上映年份
                        <input type="text" id="pub_year" name="pub_year" size="10" value=""  onfocus="WdatePicker({dateFmt:'yyyy'})" placeholder="上映年份" /> &nbsp;&nbsp;
                      </div>

                      <div style="float:left"> 
                        &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                        &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;  
                      </div>

                        <div class="diy_select mr5" style="float:left"> 

                            <input type="hidden" name="film_type" value="" class="diy_select_input" id="payee">
                            <input type="text" value="" placeholder="请选择影片类型" class="diy_select_txt" readonly="readonly"> 
                            <div class="diy_select_btn">
                                <span></span>
                            </div> &nbsp;&nbsp; 
                            <ul class="diy_select_list" style="display: none;">
                                <li>全部</li>
                                <li data-value="5">动作</li><li data-value="16">科幻</li><li data-value="13">家庭</li><li data-value="15">剧情</li><li data-value="19">冒险</li><li data-value="20">奇幻</li><li data-value="25">喜剧</li><li data-value="27">悬疑</li><li data-value="14">惊悚</li><li data-value="22">武侠</li><li data-value="4">动画</li><li data-value="7">儿童</li><li data-value="10">古装</li><li data-value="17">恐怖</li><li data-value="1">爱情</li><li data-value="30">战争</li><li data-value="8">犯罪</li>                            </ul>
                       </div>
                        <div style="float:left;margin-left:3px;" >
                            
                              
                                <input id="searchVideo" name="video_name" size="10"  type="text" placeholder="请输入关键词"  value="" > &nbsp;&nbsp;
                              
                            
                        </div>
                        
                        <div style="float:left"> 
                          &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                          &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;  
                        </div>

                        <div style="float:left"><input type="button" class="sblue-btn" onclick="search()" value="搜索" />
                        &nbsp;&nbsp;<input type="button" class="sblue-btn" onclick="queryMovieList()" value="清空" /></div>
                    </form>
                </dd>
            </dl>
        </div>
<!--       <div class="row"  align="center">
        <button onclick="queryMovieList()" class="btn btn-success  btn-lg  col-lg-5">查看影片列表</button>
      </div> -->
      <br>
      <div class="row" >
        <div  class="col-lg-10" align="right" class="logo" ><h4><a href="#" id="loginButton"><span></span></a></h4></div> 
      </div> 
      <div class="row">
        <span class="col-lg-1"> </span><button onclick="importVideo()" class="btn btn-primary  btn-lg col-lg-3">USB导入影片</button>
        <span class="col-lg-1"> </span><button onclick="updateVideoList()" class="btn btn-primary  btn-lg col-lg-3">更新本地数据库</button>
      </div>  
      <div class="row" style="margin-top:20px;">
        <legend>影片列表</legend>

        <table id="mobileTab" class="table table-hover table-striped table-bordered">       
          <thead>
            <tr>
          
              <th><a href="javascript:;" style="text-decoration: none;" onclick="localsortById()">影片ID&#8593&#8595</a></th>
              <th><a href="javascript:;" style="text-decoration: none;" onclick="localsortByFileName()">影片名&#8593&#8595</a></th>
              <th><a href="javascript:;" style="text-decoration: none;" onclick="localsortByDownTime()">下载日期&#8593&#8595</a> </th>
              <th><a href="javascript:;" style="text-decoration: none;" onclick="localsortByReleaseDate()">上映年份&#8593&#8595</a></th>
              <th>影片类型 </th>
            <!--   <th>播放次数 </th> -->
              <th>影片时长 </th>
              <th>状态</th>
            </tr>
          </thead>

          <tbody>
          <!--   动态添加表格项   -->
          </tbody>
        </table>
      </div>
      <br>

      <div class="showPage"  align="center"  id="showPage" style="display:block;margin-top:-42px;margin-left:-15px;"> 
        <?php 
            require_once('../Class/page.class.php'); //分页类
            require('../Model/MovieModel.php'); //引入视频模型类 
            $showrow = 10; //一页显示的行数 
            $curpage = empty($_GET['page']) ? 1 : $_GET['page']; //当前的页,还应该处理非数字的情况 
            $url = "?page={page}"; //分页地址，如果有检索条件 ="?page={page}&q=".$_GET['q']
            $dao = new MovieModel();
            $data = $dao->getVideoList();
            $total= count($data);
            if ($total > $showrow){//总记录数大于每页显示数，显示分页 
              $page = new page($total, $showrow, $curpage, $url, 2); 
              echo $page->myde_write("movie_list"); 
            } 
        ?> 
      </div> 
      <br>
      <div class="row" align="center">
          <br>
          <br>
      </div>

    </div>

  </body>

  <script type="text/javascript">
   $(window).load(initInfo());
  </script>

 <!-- 右边内容区 end -->
</body>
<script type="text/javascript" src="../js/select.js"></script>
<script>
    //自定义下拉框 
    $(".diy_select_list").click(function (event) {
        var val = +$(".diy_select_input").val();

        changefType(val);
    });
    function changefType(val)
    {
        if (val == 1) {
            $("#hidden_1").css("display", "block");
            $("#hidden_2").css("display", "none");
        }
        else {
            $("#hidden_1").css("display", "none");
            $("#hidden_2").css("display", "block");
        }
    }
</script>

</html>