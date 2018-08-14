<html>
   <head>
      <meta http-equiv="content-type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--   <link href="../css/style.css" rel="stylesheet" type="text/css" media="all"/> -->
      <link href="../css/bootstrap.min.css" rel="stylesheet">
      <script src="../js/jquery.min.js"></script>
      <script src="../js/jquery.cookie.js"></script>
      <script src="../js/jquerysession.js"></script>
      <script src="../js/bootstrap.min.js"></script>
      <script src="../js/sweetalert.min.js"></script> 
      <script src="../js/swooleClient.js"></script> <!-- websocket客户端 -->
      <link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
      <script type="text/javascript" src="../js/zepto.js?2"></script>
      <script src="../js/redefinedAlert.js"></script><!-- 重定义alert样式  -->
      <link rel="stylesheet" href="../css/guanlicenter_zcsy.css" />
      <link rel="stylesheet" href="../css/myFont.css" />
      <script type="text/javascript" src="../My97DatePicker/WdatePicker.js"></script>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- bootstrap中的屏幕自适应，能够使不同屏幕大小布局相同 -->
      <link rel="stylesheet" href="../css/paging.css" />
      <script type="text/javascript">
        jQuery.extend({
              evalJSON: function (strJson) {
                          return eval_r("(" + strJson + ")");
                        }
        });

        jQuery.extend({
                toJSON: function (object) {
                          var type = typeof object;
                          if ('object' == type) {
                            if (Array == object.constructor) type = 'array';
                              else if (RegExp == object.constructor) type = 'regexp';
                                 else type = 'object';
                        }
                switch (type) {
                  case 'undefined':

                  case 'unknown':
                    return;
                    break;

                  case 'function':

                  case 'boolean':

                  case 'regexp':
                    return object.toString();
                    break;

                  case 'number':
                    return isFinite(object) ? object.toString() : 'null';
                    break;

                  case 'string':
                    return '"' + object.replace(/(\\|\")/g, "\\$1").replace(/\n|\r|\t/g, function () {
                    var a = arguments[0];
                    return (a == '\n') ? '\\n' : (a == '\r') ? '\\r' : (a == '\t') ? '\\t' : ""
                            }) + '"';
                    break;

                  case 'object':
                    if (object === null) return 'null';
                      var results = [];
                    for (var property in object) {
                      var value = jQuery.toJSON(object[property]);
                      if (value !== undefined) results.push(jQuery.toJSON(property) + ':' + value);
                    }
                    return '{' + results.join(',') + '}';
                    break;

                  case 'array':
                    var results = [];
                    for (var i = 0; i < object.length; i++) {
                      var value = jQuery.toJSON(object[i]);
                      if (value !== undefined) results.push(value);
                    }
                    return '[' + results.join(',') + ']';
                    break;
                }
            }
        });

        function unix_to_datetime(unix) {
          var now = new Date(parseInt(unix) * 1000);
          return now.toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ");
        }

        function unix_to_date(unix) {
          var now = new Date(parseInt(unix) * 1000);
          Y = now.getFullYear() + '-';
          M = (now.getMonth()+1 < 10 ? '0'+(now.getMonth()+1) : now.getMonth()+1) + '-';
          D = now.getDate();
          date = Y+M+D;
          return date;
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

        function changeTimeToUnix(ctime){  
          var new_str = ctime.replace(/:/g,'-');
          new_str = new_str.replace(/ /g,'-');
          var arr = new_str.split("-");
          var datum = new Date(Date.UTC(arr[0],arr[1]-1,arr[2],arr[3]-8,arr[4],arr[5]));
          //alert("转换后的UNIX时间戳为 "+(datum.getTime()/1000));
          return (datum.getTime()/1000);
        }

        function get_unix_time(dateStr){
            var newstr = dateStr.replace(/-/g,'/'); 
            var date =  new Date(newstr); 
            var time_str = date.getTime().toString();
            return time_str.substr(0, 10);
        }

        function queryMovieList(){
          var sortType = $.cookie("sortType");
          var video; 
          document.getElementById('showPage').style.display='block';
          //从session中取到查询条件
          var video_year = $.session.get('video_year');
          var down_start = $.session.get('down_start');
          var down_end = $.session.get('down_end');
          var keywords = $.session.get('keywords');
          var video_type = $.session.get('video_type');
          var video_type_value = $.session.get('video_type_vale');
          var listname = $.session.get("listname");

          //在浏览器关闭后，第一次进入界面时先进行判断session是否存在
          if(video_year == undefined){
            video_year = "";
          }
          if(down_start == undefined){
            down_start = "";
          }
          if(down_end == undefined){
            down_end = "";
          }
          if(keywords == undefined){
            keywords = "";
          }
          if(video_type == undefined){
            video_type = "";
          }
          //刷新界面时，将查询条件填入到对应的搜索框中
          if(video_type_value != ""){
            $(".diy_select_txt").val($.session.get('video_type_value'));
          }
          if(keywords != ""){
            $("#searchVideo").val($.session.get('keywords'));
          }
          if(video_year != ""){
            $("#pub_year").val($.session.get('video_year'));
          }
          if(down_start != ""){
            $("#down_date_start").val(down_start);
          }
          if(down_end != ""){
            $("#down_date_end").val(down_end);
          }

          if(listname!=undefined){
            $("#listName").val(listname);
          }
          var url = "../Utils/GetVideoListByConditions.php?video_year="+video_year+"&video_type="+video_type+"&keywords="+keywords+"&down_start="+down_start+"&down_end="+down_end+"";
          
          $("#mobileTab tbody tr").remove();
          $.get(url,{},function(data){
            //将json数据转化为数组
            var movies = eval('(' +data+ ')');
            var videos = movies;
            var totalNum = videos.length+"部";
            $("#totalNum").html(totalNum);
            var sizeTotal = 0;
            for(var o in videos){
               sizeTotal = Number(sizeTotal)+parseInt(videos[o]['size']);
            }
            var movieSize = parseInt(sizeTotal/1024/1024/1024);
            var totalSize;
            if(movieSize < 1024){
              totalSize = movieSize+"GB";
            }else{
              totalSize = parseInt(movieSize/1024)+"TB";
            }
            $("#totalSize").html(totalSize);

            if(videos.length<=8){
              $("#goPage").remove();
            }
            //将数据总数存储到session当中
            $.post("../Utils/GetSearchTotal.php",{total:videos.length},function(data){});
            if(sortType == "idU"){
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
            }else if(sortType == "idD"){
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
            }else if(sortType == "filenameU"){
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
            }else if(sortType == "filenameD"){
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

            }else if(sortType == "downtimeU"){
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
            }else if(sortType == "downtimeD"){
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
            }else if(sortType == "releasedateU"){
              function sortByReleaseDate(videos){
                for(var i=0;i<videos.length;i++){
                   for(var j=i;j<videos.length;j++){
                      if(videos[i]["release_date"] >= videos[j]["release_date"]){
                         var temp = videos[i];
                         videos[i] = videos[j];
                         videos[j] = temp;
                      }
                   }           
                }
                return videos;
              }
              video = sortByReleaseDate(videos);
            }else if(sortType == "releasedateD"){
              function sortByReleaseDate(videos){
                for(var i=0;i<videos.length;i++){
                   for(var j=i;j<videos.length;j++){
                      if(videos[i]["release_date"] <= videos[j]["release_date"]){
                         var temp = videos[i];
                         videos[i] = videos[j];
                         videos[j] = temp;
                      }
                   }           
                }
                return videos;
              }
              video = sortByReleaseDate(videos);
            }else if(sortType == "typeU"){
              function sortByType(videos){
                for(var i=0;i<videos.length;i++){
                  for(var j=i;j<videos.length;j++){
                    if(videos[i]["play_type"]-videos[j]["play_type"]>=0){
                       var temp = videos[i];
                       videos[i] = videos[j];
                       videos[j] = temp;
                    }
                  }           
                }
                return videos;
              }
              video = sortByType(videos);    
            }else if(sortType == "typeD"){
              function sortByType(videos){
                for(var i=0;i<videos.length;i++){
                  for(var j=i;j<videos.length;j++){
                    if(videos[i]["play_type"]-videos[j]["play_type"]<=0){
                       var temp = videos[i];
                       videos[i] = videos[j];
                       videos[j] = temp;
                    }
                  }           
                }
                return videos;
              }
              video = sortByType(videos);
            }if(sortType == "timeU"){
              function sortByTime(videos){
                for(var i=0;i<videos.length;i++){
                  for(var j=i;j<videos.length;j++){
                    if(videos[i]["time"]-videos[j]["time"]>=0){
                       var temp = videos[i];
                       videos[i] = videos[j];
                       videos[j] = temp;
                    }
                  }           
                }
                return videos;
              }
              video = sortByTime(videos);      
            }else if(sortType == "timeD"){
              function sortByTime(videos){
                for(var i=0;i<videos.length;i++){
                  for(var j=i;j<videos.length;j++){
                    if(videos[i]["time"]-videos[j]["time"]<=0){
                       var temp = videos[i];
                       videos[i] = videos[j];
                       videos[j] = temp;
                    }
                  }           
                }
                return videos;
              }
              video = sortByTime(videos);  
            }else{
              video = videos;
            }
            video = videos;
            for(var o in video){
              var curpage = <?php echo $curpage = empty($_GET['page']) ? 1 : $_GET['page'];?>;
              if(o>=(curpage-1)*8&&o<curpage*8){
                  var play_type = (video[o]["play_type"]==1) ? "2D":"3D";
                  $("#mobileTab tbody").append("<tr>"
                                    +"<td>"+'<input onclick="getChecked()" type="checkbox" name="subBox"'+'value='+o+' />'+'</td>'
                                    +"<td>"+video[o]["id"]+"</td>"
                                    +"<td>"+'<a href="#" style="color:#000000;text-decoration:none" onclick="javascript:LookDetails(this)">'+video[o]["file_name"]+"</a></td>"
                                    +"<td>"+unix_to_datetime(video[o]["down_time"])+"</td>"
                                    +"<td>"+video[o]["release_date"]+"</td>"                           
                                    +"<td>"+play_type+"</td>"
                                   
                                    // +"<td>"+videos[o]["play_times"]+"</td>"
                                    +"<td>"+formatSeconds(video[o]["time"])+"</td>"
                                    +"</tr>");  
              }
            }  

            //重新加载页面判断显示已选中的列表
            $.get("../Controller/MovieController.php?method=getChecked",{},function(data){
                var array= data.split(" ");
                var curpage = <?php echo $curpage = empty($_GET['page']) ? 1 : $_GET['page'];?>;
                var length = video.length;
                var checkedSize = 0;
                //循环比较，将原本已勾选的影片总量输出
                for(var i=0;i<length;i++){
                  for(var j=0;j<array.length-1;j++){
                    if(array[j] == video[i]['id']){
                      //alert(videos[i]['size']);
                      checkedSize = Number(checkedSize)+parseInt(video[i]['size']);
                      //alert(checkedSize);
                    }
                  }
                }
                var totalSize = parseInt(checkedSize/1024/1024/1024)+"GB";
                $("#checkedSize").html(totalSize);
                var checkedNum = array.length-1+"部";
                $('#checkedNum').html(checkedNum);


                //界面重新加载时循环比较将原来已勾选的内容重新勾选
                for(var i=0;i<array.length-1;i++){
                  for(var j=0;j<length-(curpage-1)*8;j++){
                    var listId = $("#mobileTab tbody tr:eq("+j+") td:eq(1)").html();
                    if(array[i] == listId){
                      $("#mobileTab tbody tr:eq("+j+") td:eq(0) :input").prop("checked","true");
                    }
                  } 
                }
            });
          });
        }

        function LookDetails(obj){
          var LookDetails = $(obj).html();
          window.location.href="../View/MovieDetails.php?mv="+LookDetails;
        }

        function search(){

            var video_year=document.getElementById("pub_year").value;
            var down_start=document.getElementById("down_date_start").value;
            var down_end=document.getElementById("down_date_end").value;
            var keywords=document.getElementById("searchVideo").value;
            var video_type = +$(".diy_select_input").val();

            if(video_type == 0){
              video_type = "";
            }
            var video_type_value = $(".diy_select_txt").val();
            
            
            //将查询条件存储到session当中
            $.session.set('video_year',video_year);
            $.session.set('down_start',down_start);
            $.session.set('down_end',down_end);
            $.session.set('keywords',keywords);
            $.session.set('video_type',video_type);
            $.session.set('video_type_value',video_type_value);

            var url = "../Utils/GetVideoListByConditions.php?video_year="+video_year+"&video_type="+video_type+"&keywords="+keywords+"&down_start="+down_start+"&down_end="+down_end+"";
            var total; 
            //首先得到此次查询的数据总数
            $.ajax({
              url: url,
              async: false,                 //改变ajax的执行顺序，使它先执行
              success: function(data){
                movies = eval('(' +data+ ')');
                var videos = movies;
                total = videos.length;
              }
            });
            var reurl = "../View/MovieListDistribute.php?total="+total;   //重新请求当前界面，并附加total参数
            window.location.href = reurl;

        }

      function clearSearch(){
        $.session.remove('video_year');
        $.session.remove('down_start');
        $.session.remove('down_end');
        $.session.remove('keywords');
        $.session.remove('video_type');
        $.session.remove('video_type_value');

        var url = "../Utils/GetVideoList.php";
        var total; 

        $.ajax({
          url: url,
          async: false,                 //改变ajax的执行顺序，使它先执行
          success: function(data){
            videos = eval('(' +data+ ')');
            total = videos.length;
          }
        });

        var reurl = "../View/MovieListDistribute.php?total="+total;
        window.location.href = reurl;

      }

      function saveMovieList(){
          $.session.set("listname","");
          var listname =  $("#listName").val();
          var patt1 = new RegExp(/\s+/g); 
          if(listname==""){
            sweetAlert("请填写播放列表名称");
            return;
          }else if(listname.replace(/\s+/g, "").length == 0){
            sweetAlert("列表名不可全为空格");
            return;
          }else if(listname.length>6){
            sweetAlert("列表名称最多为6个字");
            return;
          }else{
            saveChecked();//提交时保存当前页已选择的内容
            $.get("../Controller/MovieController.php?method=saveMovieList",{listName:$("#listName").val()},function(data){
              swal(data);
              // var videos = ("("+data+")");
              // console.log(videos);
            });
          }
      }

      //翻页时保存当前页已勾选的电影
      function saveChecked(){
        var checkedlist = new Array();
        var uncheckedlist = new Array();
        $("#mobileTab input:checked").filter("[name!='checkAll']").each( function(index,ele,submitList){                       
          var id = $(this).parent().next().html();
          checkedlist[index]={ id:id};
          // console.log($(ele).prop("value"));
        });
        $("#mobileTab input:not(:checked)").filter("[name!='checkAll']").each( function(index,ele,submitList){                        
          var id = $(this).parent().next().html();
          uncheckedlist[index]={ id:id};
           // console.log($(ele).prop("value"));
        });
        // console.log(checkedlist);
        var checkedpostData = $.toJSON(checkedlist);  //把数组转换成json字符串
        var uncheckedpostData = $.toJSON(uncheckedlist);
        $.post("../Utils/SaveMovieList.php",{'checked[]':checkedpostData,'unchecked[]':uncheckedpostData},function(response){});
      
      }
      
      //获取已选择的影片总数
      function getChecked(){
        saveChecked();

        var url = "../Utils/GetVideoList.php";
        var checkedSize = 0; 
        
        //通过比较来获取已选中影片的内存
        $.ajax({
          url: url,
          //async: false,                 //改变ajax的执行顺序，使它先执行
          success: function(data){
            videos = eval('(' +data+ ')');
            $.get("../Controller/MovieController.php?method=getChecked",{},function(data){
                var array= data.split(" ");
                var length = videos.length;
                for(var i=0;i<length;i++){
                  for(var j=0;j<array.length-1;j++){
                    if(array[j] == videos[i]['id']){
                      //alert(videos[i]['size']);
                      checkedSize = Number(checkedSize)+parseInt(videos[i]['size']);
                      //alert(checkedSize);
                    }
                  }
                }
                var movieSize = parseInt(checkedSize/1024/1024/1024);
                var totalSize;
                if(movieSize < 1024){
                  totalSize = movieSize+"GB";
                }else{
                  totalSize = parseInt(movieSize/1024)+"TB";
                }
                $("#checkedSize").html(totalSize);
            });
          }
        });
        $.get("../Controller/MovieController.php?method=getChecked",{},function(data){
            var array= data.split(" ");
            var checkedNum = array.length-1+"部";
            $('#checkedNum').html(checkedNum);
        });
      }

       //按文件的Id值进行排序
       function sortMovieListById(){
          var sortType = $.cookie("sortType");
          if(sortType != "idU" && sortType != "idD"){
            $.cookie('sortType', 'idU', { expires: 7 });   //第一次点击ID升序排列
          }else{
            if(sortType == "idU"){
              $.cookie('sortType', 'idD', { expires: 7 });   //从升序变为降序
            }else{
              $.cookie('sortType', 'idU', { expires: 7 });   //从降序变为升序
            }
          }
          saveChecked();   //排序前，先将已选中的行Id记录session
          document.getElementById('showPage').style.display='block';

          var video_year = $.session.get('video_year');
          var down_start = $.session.get('down_start');
          var down_end = $.session.get('down_end');
          var keywords = $.session.get('keywords');
          var video_type = $.session.get('video_type');

          //在浏览器关闭后，第一次进入界面时先进行判断session是否存在
          if(video_year == undefined){
            video_year = "";
          }
          if(down_start == undefined){
            down_start = "";
          }
          if(down_end == undefined){
            down_end = "";
          }
          if(keywords == undefined){
            keywords = "";
          }
          if(video_type == undefined){
            video_type = "";
          }

          
          var url = "../Utils/GetVideoListByConditions.php?video_year="+video_year+"&video_type="+video_type+"&keywords="+keywords+"&down_start="+down_start+"&down_end="+down_end+"";

          $("#mobileTab tbody tr").remove();
          var videos;
          //动态生成电影列表
          $.get(url,{},function(data){
            var movies = eval('(' +data+ ')');
            var videos = movies;
            var sortType = $.cookie("sortType");
            function sortById(videos){
              if(sortType == "idU"){
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
            for(var o in sortById(videos)){
              console.log(o);
              var curpage = <?php echo $curpage = empty($_GET['page']) ? 1 : $_GET['page'];?>;
              if(o>=(curpage-1)*8&&o<curpage*8){
                  var play_type = (videos[o]["play_type"]==1) ? "2D":"3D";
                  $("#mobileTab tbody").append("<tr>"
                                    +"<td>"+'<input onclick="getChecked()" type="checkbox" name="subBox"'+' value='+o+' />'+'</td>'
                                    +"<td>"+videos[o]["id"]+"</td>"
                                    +"<td>"+'<a href="#" style="color:#000000;text-decoration:none" onclick="javascript:LookDetails(this)">'+videos[o]["file_name"]+"</a></td>"
                                    +"<td>"+unix_to_datetime(videos[o]["down_time"])+"</td>"
                                    +"<td>"+videos[o]["release_date"]+"</td>"                           
                                    +"<td>"+play_type+"</td>"
                                   
                                    // +"<td>"+videos[o]["play_times"]+"</td>"
                                    +"<td>"+formatSeconds(videos[o]["time"])+"</td>"
                                    +"</tr>");  
              }
            }  

            //重新加载页面判断显示已选中的列表
            $.get("../Controller/MovieController.php?method=getChecked",{},function(data){
                var array= data.split(" ");
                var curpage = <?php echo $curpage = empty($_GET['page']) ? 1 : $_GET['page'];?>;
                var length = videos.length;
                for(var i=0;i<array.length-1;i++){
                  for(var j=0;j<length-(curpage-1)*8;j++){
                    var listId = $("#mobileTab tbody tr:eq("+j+") td:eq(1)").html();
                    if(array[i] == listId){
                      $("#mobileTab tbody tr:eq("+j+") td:eq(0) :input").prop("checked","true");
                    }
                  }
                }
            });

          });
       }

       //按文件下载时间进行排序
       function sortMovieListByDownTime(){
          var sortType = $.cookie("sortType");
          if(sortType != "downtimeU" && sortType != "downtimeD"){
            $.cookie('sortType', 'downtimeU', { expires: 7 });   //第一次点击ID升序排列
          }else{
            if(sortType == "downtimeU"){
              $.cookie('sortType', 'downtimeD', { expires: 7 });   //从升序变为降序
            }else{
              $.cookie('sortType', 'downtimeU', { expires: 7 });   //从降序变为升序
            }
          }
          saveChecked();   //排序前，先将已选中的行Id记录session
          document.getElementById('showPage').style.display='block';

          var video_year = $.session.get('video_year');
          var down_start = $.session.get('down_start');
          var down_end = $.session.get('down_end');
          var keywords = $.session.get('keywords');
          var video_type = $.session.get('video_type');

          //在浏览器关闭后，第一次进入界面时先进行判断session是否存在
          if(video_year == undefined){
            video_year = "";
          }
          if(down_start == undefined){
            down_start = "";
          }
          if(down_end == undefined){
            down_end = "";
          }
          if(keywords == undefined){
            keywords = "";
          }
          if(video_type == undefined){
            video_type = "";
          }

          var url = "../Utils/GetVideoListByConditions.php?video_year="+video_year+"&video_type="+video_type+"&keywords="+keywords+"&down_start="+down_start+"&down_end="+down_end+"";
          $("#mobileTab tbody tr").remove(); 
          //动态生成电影列表
          $.get(url,{},function(data){
            var movies = eval('(' +data+ ')');
            var videos = movies;
            var sortType = $.cookie("sortType");
            function sortByDownTime(videos){
              if(sortType == "downtimeU"){
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
            for(var o in sortByDownTime(videos)){
              var curpage = <?php echo $curpage = empty($_GET['page']) ? 1 : $_GET['page'];?>;
              if(o>=(curpage-1)*8&&o<curpage*8){
                  var play_type = (videos[o]["play_type"]==1) ? "2D":"3D";
                  $("#mobileTab tbody").append("<tr>"
                                    +"<td>"+'<input onclick="getChecked()" type="checkbox" name="subBox"'+' value='+o+' />'+'</td>'
                                    +"<td>"+videos[o]["id"]+"</td>"
                                    +"<td>"+'<a href="#" style="color:#000000;text-decoration:none" onclick="javascript:LookDetails(this)">'+videos[o]["file_name"]+"</a></td>"
                                    +"<td>"+unix_to_datetime(videos[o]["down_time"])+"</td>"
                                    +"<td>"+videos[o]["release_date"]+"</td>"                           
                                    +"<td>"+play_type+"</td>"
                                   
                                    // +"<td>"+videos[o]["play_times"]+"</td>"
                                    +"<td>"+formatSeconds(videos[o]["time"])+"</td>"
                                    +"</tr>");  
              }
            }  

            //重新加载页面判断显示已选中的列表
            $.get("../Controller/MovieController.php?method=getChecked",{},function(data){
                var array= data.split(" ");
                var curpage = <?php echo $curpage = empty($_GET['page']) ? 1 : $_GET['page'];?>;
                var length = videos.length;
                for(var i=0;i<array.length-1;i++){
                  for(var j=0;j<length-(curpage-1)*8;j++){
                    var listId = $("#mobileTab tbody tr:eq("+j+") td:eq(1)").html();
                    if(array[i] == listId){
                      $("#mobileTab tbody tr:eq("+j+") td:eq(0) :input").prop("checked","true");
                    }
                  }
                }
            });

          });
       }

       //按文件名上映年份进行排序
       function sortMovieListByReleaseDate(){
          var sortType = $.cookie("sortType");
          if(sortType != "releasedateU" && sortType != "releasedateD"){
            $.cookie('sortType', 'releasedateU', { expires: 7 });   //第一次点击ID升序排列
          }else{
            if(sortType == "releasedateU"){
              $.cookie('sortType', 'releasedateD', { expires: 7 });   //从升序变为降序
            }else{
              $.cookie('sortType', 'releasedateU', { expires: 7 });   //从降序变为升序
            }
          }
          saveChecked();   //排序前，先将已选中的行Id记录session
          document.getElementById('showPage').style.display='block';
          
          var video_year = $.session.get('video_year');
          var down_start = $.session.get('down_start');
          var down_end = $.session.get('down_end');
          var keywords = $.session.get('keywords');
          var video_type = $.session.get('video_type');

          //在浏览器关闭后，第一次进入界面时先进行判断session是否存在
          if(video_year == undefined){
            video_year = "";
          }
          if(down_start == undefined){
            down_start = "";
          }
          if(down_end == undefined){
            down_end = "";
          }
          if(keywords == undefined){
            keywords = "";
          }
          if(video_type == undefined){
            video_type = "";
          }

          var url = "../Utils/GetVideoListByConditions.php?video_year="+video_year+"&video_type="+video_type+"&keywords="+keywords+"&down_start="+down_start+"&down_end="+down_end+"";

          $("#mobileTab tbody tr").remove();
          //动态生成电影列表
          $.get(url,{},function(data){
            var movies = eval('(' +data+ ')');
            var videos = movies;
            var sortType = $.cookie("sortType");
            function sortByReleaseDate(videos){
              if(sortType == "releasedateU"){
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
            for(var o in sortByReleaseDate(videos)){
              var curpage = <?php echo $curpage = empty($_GET['page']) ? 1 : $_GET['page'];?>;
              if(o>=(curpage-1)*8&&o<curpage*8){
                  var play_type = (videos[o]["play_type"]==1) ? "2D":"3D";
                  $("#mobileTab tbody").append("<tr>"
                                    +"<td>"+'<input onclick="getChecked()" type="checkbox" name="subBox"'+' value='+o+' />'+'</td>'
                                    +"<td>"+videos[o]["id"]+"</td>"
                                    +"<td>"+'<a href="#" style="color:#000000;text-decoration:none" onclick="javascript:LookDetails(this)">'+videos[o]["file_name"]+"</a></td>"
                                    +"<td>"+unix_to_datetime(videos[o]["down_time"])+"</td>"
                                    +"<td>"+videos[o]["release_date"]+"</td>"                           
                                    +"<td>"+play_type+"</td>"
                                   
                                    // +"<td>"+videos[o]["play_times"]+"</td>"
                                    +"<td>"+formatSeconds(videos[o]["time"])+"</td>"
                                    +"</tr>");  
              }
            }  

            //重新加载页面判断显示已选中的列表
            $.get("../Controller/MovieController.php?method=getChecked",{},function(data){
                var array= data.split(" ");
                var curpage = <?php echo $curpage = empty($_GET['page']) ? 1 : $_GET['page'];?>;
                var length = videos.length;
                for(var i=0;i<array.length-1;i++){
                  for(var j=0;j<length-(curpage-1)*8;j++){
                    var listId = $("#mobileTab tbody tr:eq("+j+") td:eq(1)").html();
                    if(array[i] == listId){
                      $("#mobileTab tbody tr:eq("+j+") td:eq(0) :input").prop("checked","true");
                    }
                  }
                }
            });

          });
       }

       //按照文件名首字母排序
       function sortMovieListByFileName(){
          var sortType = $.cookie("sortType");
          if(sortType != "filenameU" && sortType != "filenameD"){
            $.cookie('sortType', 'filenameU', { expires: 7 });   //第一次点击ID升序排列
          }else{
            if(sortType == "filenameU"){
              $.cookie('sortType', 'filenameD', { expires: 7 });   //从升序变为降序
            }else{
              $.cookie('sortType', 'filenameU', { expires: 7 });   //从降序变为升序
            }
          }
          saveChecked();   //排序前，先将已选中的行Id记录session
          document.getElementById('showPage').style.display='block';

          
          var video_year = $.session.get('video_year');
          var down_start = $.session.get('down_start');
          var down_end = $.session.get('down_end');
          var keywords = $.session.get('keywords');
          var video_type = $.session.get('video_type');

          //在浏览器关闭后，第一次进入界面时先进行判断session是否存在
          if(video_year == undefined){
            video_year = "";
          }
          if(down_start == undefined){
            down_start = "";
          }
          if(down_end == undefined){
            down_end = "";
          }
          if(keywords == undefined){
            keywords = "";
          }
          if(video_type == undefined){
            video_type = "";
          }

          var url = "../Utils/GetVideoListByConditions.php?video_year="+video_year+"&video_type="+video_type+"&keywords="+keywords+"&down_start="+down_start+"&down_end="+down_end+"";

          $("#mobileTab tbody tr").remove();
          //动态生成电影列表
          $.get(url,{},function(data){
            var movies = eval('(' +data+ ')');
            var videos = movies;
            
            //将中文按照首字母进行排序的方法
            function pySegSort(videos,empty) {
                if(!String.prototype.localeCompare)
                  return null;

                var letters ="abcdefghjklmnopqrstwxyz".split('');
                var EN ="ABCDEFGHJKLMNOPQRSTWXYZ".split('');
                var zh ="啊把差大额发噶哈级卡啦吗那哦爬器然啥他哇西呀咋".split('');

                var curr = [];
                var sortType = $.cookie("sortType");
                if(sortType == "filenameU"){
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
            //console.log(VideoList);
            for(var o in VideoList){
              var curpage = <?php echo $curpage = empty($_GET['page']) ? 1 : $_GET['page'];?>;
              if(o>=(curpage-1)*8&&o<curpage*8){
                  var play_type = (VideoList[o]["play_type"]==1) ? "2D":"3D";
                  $("#mobileTab tbody").append("<tr>"
                                    +"<td>"+'<input onclick="getChecked()" type="checkbox" name="subBox"'+' value='+o+' />'+'</td>'
                                    +"<td>"+VideoList[o]["id"]+"</td>"
                                    +"<td>"+'<a href="#" style="color:#000000;text-decoration:none" onclick="javascript:LookDetails(this)">'+VideoList[o]["file_name"]+"</a></td>"
                                    +"<td>"+unix_to_datetime(VideoList[o]["down_time"])+"</td>"
                                    +"<td>"+VideoList[o]["release_date"]+"</td>"                           
                                    +"<td>"+play_type+"</td>"
                                   
                                    // +"<td>"+videos[o]["play_times"]+"</td>"
                                    +"<td>"+formatSeconds(VideoList[o]["time"])+"</td>"
                                    +"</tr>");  
              }
            }  

            //重新加载页面判断显示已选中的列表
            $.get("../Controller/MovieController.php?method=getChecked",{},function(data){
                var array= data.split(" ");
                var curpage = <?php echo $curpage = empty($_GET['page']) ? 1 : $_GET['page'];?>;
                var length = videos.length;
                for(var i=0;i<array.length-1;i++){
                  for(var j=0;j<length-(curpage-1)*8;j++){
                    var listId = $("#mobileTab tbody tr:eq("+j+") td:eq(1)").html();
                    if(array[i] == listId){
                      $("#mobileTab tbody tr:eq("+j+") td:eq(0) :input").prop("checked","true");
                    }
                  }
                }
            });

          });
       }

       //按文件的影片类型进行排序
       function sortMovieListByType(){
          var sortType = $.cookie("sortType");
          if(sortType != "typeU" && sortType != "typeD"){
            $.cookie('sortType', 'typeU', { expires: 7 });   //第一次点击ID升序排列
          }else{
            if(sortType == "typeU"){
              $.cookie('sortType', 'typeD', { expires: 7 });   //从升序变为降序
            }else{
              $.cookie('sortType', 'typeU', { expires: 7 });   //从降序变为升序
            }
          }
          saveChecked();   //排序前，先将已选中的行Id记录session
          document.getElementById('showPage').style.display='block';

          
          var video_year = $.session.get('video_year');
          var down_start = $.session.get('down_start');
          var down_end = $.session.get('down_end');
          var keywords = $.session.get('keywords');
          var video_type = $.session.get('video_type');

          //在浏览器关闭后，第一次进入界面时先进行判断session是否存在
          if(video_year == undefined){
            video_year = "";
          }
          if(down_start == undefined){
            down_start = "";
          }
          if(down_end == undefined){
            down_end = "";
          }
          if(keywords == undefined){
            keywords = "";
          }
          if(video_type == undefined){
            video_type = "";
          }

          var url = "../Utils/GetVideoListByConditions.php?video_year="+video_year+"&video_type="+video_type+"&keywords="+keywords+"&down_start="+down_start+"&down_end="+down_end+"";

          $("#mobileTab tbody tr").remove();
          var videos;
          //动态生成电影列表
          $.get(url,{},function(data){
            var movies = eval('(' +data+ ')');
            var videos = movies;
            var sortType = $.cookie("sortType");
            function sortByType(videos){
              if(sortType == "typeU"){
                for(var i=0;i<videos.length;i++){
                  for(var j=i;j<videos.length;j++){
                    if(videos[i]["play_type"]-videos[j]["play_type"]>=0){
                       var temp = videos[i];
                       videos[i] = videos[j];
                       videos[j] = temp;
                    }
                  }           
                }     
              }else{
                for(var i=0;i<videos.length;i++){
                  for(var j=i;j<videos.length;j++){
                    if(videos[i]["play_type"]-videos[j]["play_type"]<=0){
                       var temp = videos[i];
                       videos[i] = videos[j];
                       videos[j] = temp;
                    }
                  }           
                }
              }
              return videos;
            }
            for(var o in sortByType(videos)){
              console.log(o);
              var curpage = <?php echo $curpage = empty($_GET['page']) ? 1 : $_GET['page'];?>;
              if(o>=(curpage-1)*8&&o<curpage*8){
                  var play_type = (videos[o]["play_type"]==1) ? "2D":"3D";
                  $("#mobileTab tbody").append("<tr>"
                                    +"<td>"+'<input onclick="getChecked()" type="checkbox" name="subBox"'+' value='+o+' />'+'</td>'
                                    +"<td>"+videos[o]["id"]+"</td>"
                                    +"<td>"+'<a href="#" style="color:#000000;text-decoration:none" onclick="javascript:LookDetails(this)">'+videos[o]["file_name"]+"</a></td>"
                                    +"<td>"+unix_to_datetime(videos[o]["down_time"])+"</td>"
                                    +"<td>"+videos[o]["release_date"]+"</td>"                           
                                    +"<td>"+play_type+"</td>"
                                   
                                    // +"<td>"+videos[o]["play_times"]+"</td>"
                                    +"<td>"+formatSeconds(videos[o]["time"])+"</td>"
                                    +"</tr>");  
              }
            }  

            //重新加载页面判断显示已选中的列表
            $.get("../Controller/MovieController.php?method=getChecked",{},function(data){
                var array= data.split(" ");
                var curpage = <?php echo $curpage = empty($_GET['page']) ? 1 : $_GET['page'];?>;
                var length = videos.length;
                for(var i=0;i<array.length-1;i++){
                  for(var j=0;j<length-(curpage-1)*8;j++){
                    var listId = $("#mobileTab tbody tr:eq("+j+") td:eq(1)").html();
                    if(array[i] == listId){
                      $("#mobileTab tbody tr:eq("+j+") td:eq(0) :input").prop("checked","true");
                    }
                  }
                }
            });

          });
       }

       //按文件的Id值进行排序
       function sortMovieListByTime(){
          var sortType = $.cookie("sortType");
          if(sortType != "timeU" && sortType != "timeD"){
            $.cookie('sortType', 'timeU', { expires: 7 });   //第一次点击ID升序排列
          }else{
            if(sortType == "timeU"){
              $.cookie('sortType', 'timeD', { expires: 7 });   //从升序变为降序
            }else{
              $.cookie('sortType', 'timeU', { expires: 7 });   //从降序变为升序
            }
          }
          saveChecked();   //排序前，先将已选中的行Id记录session
          document.getElementById('showPage').style.display='block';

          var video_year = $.session.get('video_year');
          var down_start = $.session.get('down_start');
          var down_end = $.session.get('down_end');
          var keywords = $.session.get('keywords');
          var video_type = $.session.get('video_type');

          //在浏览器关闭后，第一次进入界面时先进行判断session是否存在
          if(video_year == undefined){
            video_year = "";
          }
          if(down_start == undefined){
            down_start = "";
          }
          if(down_end == undefined){
            down_end = "";
          }
          if(keywords == undefined){
            keywords = "";
          }
          if(video_type == undefined){
            video_type = "";
          }

          var url = "../Utils/GetVideoListByConditions.php?video_year="+video_year+"&video_type="+video_type+"&keywords="+keywords+"&down_start="+down_start+"&down_end="+down_end+"";

          $("#mobileTab tbody tr").remove();
          var videos;
          //动态生成电影列表
          $.get(url,{},function(data){
            var movies = eval('(' +data+ ')');
            var videos = movies;
            var sortType = $.cookie("sortType");
            function sortByTime(videos){
              if(sortType == "timeU"){
                for(var i=0;i<videos.length;i++){
                  for(var j=i;j<videos.length;j++){
                    if(videos[i]["time"]-videos[j]["time"]>=0){
                       var temp = videos[i];
                       videos[i] = videos[j];
                       videos[j] = temp;
                    }
                  }           
                }     
              }else{
                for(var i=0;i<videos.length;i++){
                  for(var j=i;j<videos.length;j++){
                    if(videos[i]["time"]-videos[j]["time"]<=0){
                       var temp = videos[i];
                       videos[i] = videos[j];
                       videos[j] = temp;
                    }
                  }           
                }
              }
              return videos;
            }
            for(var o in sortByTime(videos)){
              console.log(o);
              var curpage = <?php echo $curpage = empty($_GET['page']) ? 1 : $_GET['page'];?>;
              if(o>=(curpage-1)*8&&o<curpage*8){
                  var play_type = (videos[o]["play_type"]==1) ? "2D":"3D";
                  $("#mobileTab tbody").append("<tr>"
                                    +"<td>"+'<input onclick="getChecked()" type="checkbox" name="subBox"'+' value='+o+' />'+'</td>'
                                    +"<td>"+videos[o]["id"]+"</td>"
                                    +"<td>"+'<a href="#" style="color:#000000;text-decoration:none" onclick="javascript:LookDetails(this)">'+videos[o]["file_name"]+"</a></td>"
                                    +"<td>"+unix_to_datetime(videos[o]["down_time"])+"</td>"
                                    +"<td>"+videos[o]["release_date"]+"</td>"                           
                                    +"<td>"+play_type+"</td>"
                                   
                                    // +"<td>"+videos[o]["play_times"]+"</td>"
                                    +"<td>"+formatSeconds(videos[o]["time"])+"</td>"
                                    +"</tr>");  
              }
            }  

            //重新加载页面判断显示已选中的列表
            $.get("../Controller/MovieController.php?method=getChecked",{},function(data){
                var array= data.split(" ");
                var curpage = <?php echo $curpage = empty($_GET['page']) ? 1 : $_GET['page'];?>;
                var length = videos.length;
                for(var i=0;i<array.length-1;i++){
                  for(var j=0;j<length-(curpage-1)*8;j++){
                    var listId = $("#mobileTab tbody tr:eq("+j+") td:eq(1)").html();
                    if(array[i] == listId){
                      $("#mobileTab tbody tr:eq("+j+") td:eq(0) :input").prop("checked","true");
                    }
                  }
                }
            });

          });
       }

       function skipPage(){
          var page = $("#pageCode").val();

          var video_year = $.session.get('video_year');
          var down_start = $.session.get('down_start');
          var down_end = $.session.get('down_end');
          var keywords = $.session.get('keywords');
          var video_type = $.session.get('video_type');

          //在浏览器关闭后，第一次进入界面时先进行判断session是否存在
          if(video_year == undefined){
            video_year = "";
          }
          if(down_start == undefined){
            down_start = "";
          }
          if(down_end == undefined){
            down_end = "";
          }
          if(keywords == undefined){
            keywords = "";
          }
          if(video_type == undefined){
            video_type = "";
          }

          var url = "../Utils/GetVideoListByConditions.php?video_year="+video_year+"&video_type="+video_type+"&keywords="+keywords+"&down_start="+down_start+"&down_end="+down_end+"";
          var total; 
            
          //首先得到此次查询的数据总数
          $.ajax({
            url: url,
            async: false,                 //改变ajax的执行顺序，使它先执行
            success: function(data){
              videos = eval('(' +data+ ')');
              total = videos.length;
            }
          });

          var reurl = "../View/MovieListDistribute.php?total="+total+"&page="+page;   //重新请求当前界面，并附加total参数
          window.location.href = reurl;
       }

       function setlistname(){
          var listname = $("#listName").val();
          if(listname!=""){
            $.session.set("listname",listname);
          }
       }

       function initInfo(){
        queryMovieList();
        // queryDeviceList();
        // registClient();//在redis中注册websocket的通道号
       }
      
      </script>

  </head>

  <body>
    <div class="container main-container">
       <h3 style="float:left;margin-left:-19px;">播放列表创建</h3>
        <div class="row">
          <br>
        </div> 
        <legend style="margin-left:-19px;"></legend>
            <div class="clearfix searchspin" align="center">
              <dl>
                <dd>
                    <form>
                      <div style="float:left;margin-left:-36px;" >
                        下载日期
                        <input type="text" id="down_date_start" name="down_date_start" size="10" value="" onfocus="WdatePicker()" placeholder="开始日期"  /> 至
                        <input type="text" id="down_date_end" name="down_date_end" size="10" value=""  onfocus="WdatePicker()" placeholder="结束日期" />&nbsp;&nbsp; 上映年份
                        <input type="text" id="pub_year" name="pub_year" size="10" value=""  onfocus="WdatePicker({dateFmt:'yyyy'})" placeholder="上映年份" />&nbsp;&nbsp; 
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
                            <ul class="diy_select_list" style="display: none;margin-top:6px;">
                                <li data-value="" style="width:115px;margin-left:-40px;">全部</li>
                                <li data-value="5" style="width:115px;margin-left:-40px;">动作</li>
                                <li data-value="16" style="width:115px;margin-left:-40px;">科幻</li>
                                <li data-value="13" style="width:115px;margin-left:-40px;">家庭</li>
                                <li data-value="15" style="width:115px;margin-left:-40px;">剧情</li>
                                <li data-value="19" style="width:115px;margin-left:-40px;">冒险</li>
                                <li data-value="20" style="width:115px;margin-left:-40px;">奇幻</li>
                                <li data-value="25" style="width:115px;margin-left:-40px;">喜剧</li>
                                <li data-value="27" style="width:115px;margin-left:-40px;">悬疑</li>
                                <li data-value="14" style="width:115px;margin-left:-40px;">惊悚</li>
                                <li data-value="22" style="width:115px;margin-left:-40px;">武侠</li>
                                <li data-value="4" style="width:115px;margin-left:-40px;">动画</li>
                                <li data-value="7" style="width:115px;margin-left:-40px;">儿童</li>
                                <li data-value="10" style="width:115px;margin-left:-40px;">古装</li>
                                <li data-value="17" style="width:115px;margin-left:-40px;">恐怖</li>
                                <li data-value="1" style="width:115px;margin-left:-40px;">爱情</li>
                                <li data-value="30" style="width:115px;margin-left:-40px;">战争</li>
                                <li data-value="8" style="width:115px;margin-left:-40px;">犯罪</li> 
                              </ul>
                       </div>
                        <div style="float:left;margin-left:3px;" >                                              
                          <input id="searchVideo" name="video_name" size="12" type="text" placeholder="请输入关键词"  value="" > &nbsp;&nbsp;                          
                        </div>
                        
                        <div style="float:left"> 
                          &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                          &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;  
                        </div>

                        <div style="float:left"><input type="button" class="sblue-btn" onclick="search()" value="搜索" />
                        &nbsp;&nbsp;<input type="button" class="sblue-btn" onclick="clearSearch()" value="清空" /></div>
                    </form>
                </dd>
            </dl>
        </div>
    
      <div class="row" >
        <div  class="col-lg-10" align="right" class="logo" ><h4><a href="#" id="loginButton"><span></span></a></h4></div> 
      </div> 

      <div class="row">
        <br>
      </div> 
      
      <div class="row" >
        <div class="form-group ">
          <div class="input-group">
            <span class="input-group-addon input-md">列表名称</span>
            <input type='text' id='listName' onblur="setlistname()"  class='form-control input-lg' style="width:300px" placeholder="" value="">
            <span class="col-lg-1"> </span><button onclick="saveMovieList()" class="btn btn-primary  btn-lg col-lg-3">保存播放列表</button>
          </div>
        </div>
        <br>
      </div> 

      <div class="row">
        <h4 style="float:left;margin-left:-1px;">影片列表</h4>
        <div class="row">
          <br>
        </div>
        <div class="col-md-2" style="padding:0px;">
        <p>影片总大小：<b id="totalSize" style="color:red;"></b></p>   <!-- 动态加载 -->
        </div>
        <div class="col-md-2" style="padding:0px;">
        <p>影片数量：<b id="totalNum" style="color:red;"></b></p>   <!-- 动态加载 -->
        </div>
        <div class="col-md-2" style="padding:0px;margin-left:313px;width:154px;">
        <p>已选影片大小：<b id="checkedSize" style="color:red;">0GB</b></p>   <!-- 动态加载 -->
        </div>
        <div class="col-md-2" style="padding:0px;width:154px;">
        <p>已选影片数量：<b id="checkedNum" style="color:red;"></b></p>   <!-- 动态加载 -->
        </div>
        <legend style="margin-left:-3px;margin-top:26px;"></legend>

        <table id="mobileTab" class="table table-hover table-striped table-bordered">       
          <thead>
            <tr>
              <th><input type="checkbox" id="checkAll" name="checkAll" ></th>
              <th><a href="javascript:;" style="text-decoration: none;" onclick="sortMovieListById()">影片ID&#8593&#8595</a></th>
              <th><a href="javascript:;" style="text-decoration: none;" onclick="sortMovieListByFileName()">影片名&#8593&#8595</a></th>
              <th><a href="javascript:;" style="text-decoration: none;" onclick="sortMovieListByDownTime()">下载日期&#8593&#8595</a></th>
              <th><a href="javascript:;" style="text-decoration: none;" onclick="sortMovieListByReleaseDate()">上映年份&#8593&#8595</a></th>
              <th><a href="javascript:;" style="text-decoration: none;" onclick="sortMovieListByType()">影片类型&#8593&#8595</a></th>
          <!--     <th>播放次数 </th> -->
              <th><a href="javascript:;" style="text-decoration: none;" onclick="sortMovieListByTime()">影片时长&#8593&#8595</a></th>
            </tr>
          </thead>

          <tbody>
          <!--   动态添加表格项   -->
          </tbody>
        </table>

        <!-- paging分页 -->
            <div class="showPage"  align="center"  id="showPage" style="width:866px;display:block;margin-top:-20px;">
              <?php
                require_once('../Class/page.class.php'); //分页类
                require('../Utils/GetTotal.php');   //获取数据总数
                $showrow = 8; //一页显示的行数 
                $curpage = empty($_GET['page']) ? 1 : $_GET['page']; //当前的页,还应该处理非数字的情况 
                $url = "?page={page}"; //分页地址，如果有检索条件 ="?page={page}&q=".$_GET['q']
                $uri = $_SERVER['REQUEST_URI'];
                if(strstr($uri, 'total')){                   //第一次点击搜索时得到数据总数
                  $total = $_GET['total'];
                  $url = "?page={page}&total=".$total;       //翻页时将数据总数做为参数传递
                }else{
                  if(isset($_SESSION["total"])){             //刷新界面时从session中取到最近一次查询的结果总数
                    $total = $_SESSION['total'];
                    $url = "?page={page}&total=".$total;     //刷新界面后翻页时将数据总数做为参数传递
                  }else{
                    $get = new getTotal();                   //浏览器关闭，首次进入界面，得到所有数据的总数
                    $total= $get->getVideoTotal();
                  }
                }
                if ($total > $showrow){//总记录数大于每页显示数，显示分页 
                    $page = new page($total, $showrow, $curpage, $url, 2); 
                    echo $page->myde_write("movie_list");
                }
              ?>
              <div id="goPage" style="margin-top:-19px;padding-left:0px;">
                <input type="text" id="pageCode" style="width:28px;">
                <button type="button" onclick="skipPage()" class="btn btn-default" style="margin-top:-3px;margin-left:-3px;width:32px;padding-top:4px;padding-left:7px;font-size:10px;height:25px;">GO</button>
              </div> 
            </div> 
         <!-- paging-->
      </div>
      <br>
      <br>
      <div class="row" align="center">
          <br>
          <br>
      </div>
      <div class="row" align="center">
        <div class="col-lg-4 col-sm-4 col-md-4"></div>
        <!-- <button onclick="submitVideoList()" class="btn btn-success  btn-lg  col-lg-3 col-md-2 col-sm-2" >下发播放列表</button>   
        <div class="col-lg-2 col-sm-2 col-md-2"></div>    --> 
       
        <div class="col-lg-4 col-sm-4 col-md-4"></div>
      </div>

    </div>

  </body>

  <script type="text/javascript" src="../js/select.js"></script>
  <script>
    $(window).load(initInfo());
    // $(function(){
    // // $('.demo').on('click','._alert',function(){
    // //  //alert demo
    //   $.alert('弹出了一个alert对话框',function(){
    //     $.alert('你点击了确定').ok('可修改按钮文本');
    //   })
    // })

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
    $("#checkAll").click(function(){//全选
      var isChecked = $(this).prop("checked");

      $("input[name='subBox']").each(function(){
        $(this).prop("checked", isChecked);
      });
      getChecked();
    });
    // var $subBox = $("input[name='subBox']");
    // $subBox.click(function(){
    //     $("#checkAll").attr("checked",$subBox.length == $("input[name='subBox']:checked").length ? true : false);
    // });
  
  </script>
</html>