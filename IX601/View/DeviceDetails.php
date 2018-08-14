<html>
   <head>
      <meta http-equiv="content-type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <link href="../css/style.css" rel="stylesheet" type="text/css" media="all"/>
      <style type="text/css">
            p{margin:0}
            #page{
                height:40px;
                padding:20px 0px;
            }
            #page a{
                display:block;
                float:left;
                margin-right:10px;
                padding:2px 12px;
                height:24px;
                border:1px #cccccc solid;
                background:#fff;
                text-decoration:none;
                color:#808080;
                font-size:12px;
                line-height:24px;
            }
            #page a:hover{
                color:#077ee3;
                border:1px #077ee3 solid;
            }
            #page a.cur{
                border:none;
                background:#077ee3;
                color:#fff;
            }
            #page p{
                float:left;
                padding:2px 12px;
                font-size:12px;
                height:24px;
                line-height:24px;
                color:#bbb;
                border:1px #ccc solid;
                background:#fcfcfc;
                margin-right:8px;

            }
            #page p.pageRemark{
                border-style:none;
                background:none;
                margin-right:0px;
                padding:4px 0px;
                color:#666;
            }
            #page p.pageRemark b{
                color:red;
            }
            #page p.pageEllipsis{
                border-style:none;
                background:none;
                padding:4px 0px;
                color:#808080;
            }
            .dates li {font-size: 14px;margin:20px 0}
            .dates li span{float:right}
      </style>
      <link href="../css/bootstrap.min.css" rel="stylesheet">
      <script src="../js/jquery.min.js"></script>
      <script src="../js/echarts.min.js"></script>
      <link rel="stylesheet" href="../css/myFont.css" />
      <script type="text/javascript">
      
        function GetQueryString(name) {//使用正则表达式获取当前页面的参数
          var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)","i");
          var r = window.location.search.substr(1).match(reg);
          if (r!=null) return (r[2]); 
          return null;
        }

        function queryPlayList(){ 

          $("#mobileTab tbody tr").remove();
          //动态生成电影列表
          var devid=GetQueryString("deviceid");
          $.get("../Controller/MovieController.php?method=getMovieList&&devid="+devid,{},function(data){
            // alert(data);  
            devices = eval('(' +data+ ')');
            var i=1;
            var j=0;  

            for(var o in devices){ 
                var fileHtml;
                if(devices[o]['down_status'] == "0"){
                  fileHtml = "<tr>"
                            +"<td>"+i+"</td>"
                            +"<td>"+devices[o]['id']+"</td>"
                            +"<td>"+devices[o]['file_name']+"</td>"
                            +"</tr>";
                }else{
                  fileHtml = "<tr>"
                            +"<td>"+i+"</td>"
                            +"<td>"+devices[o]['id']+"</td>"
                            +"<td>"+'<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>'+devices[o]['file_name']+"</td>"
                            +"</tr>";
                }
                $("#moviesTab tbody").append(fileHtml);
                if(devices[o]['down_status'] == "0"){         //判断该设备是否下发了列表
                  j = o;
                }
              i++; 
            }
            i--;
            $("#moviesTotal thead").append("<tr>"
                                        +"<td>共"+i+"部电影</td>"
                                        +"<td>列表名:  "+devices[j]['list_name']+"</td>"                        
                                        +"</tr>");
          });
        }
      

        function GetQueryString(name)
        {
             var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
             var r = window.location.search.substr(1).match(reg);
             if(r!=null)return  unescape(r[2]); return null;
        }
      </script>

  </head>

  <body>

    <div class="container main-container">

      <br>
      <div class="row" >
        <div  class="col-lg-10" align="right" class="logo" ><h4><a href="#" id="loginButton"><span></span></a></h4></div> 
      </div> 
      <div class="row">
        <div class="col-lg-4">
        </div>

        <div class="col-lg-4" style='margin-top:-30px;'>

          <table id="moviesTotal" class="table table-hover"> 
            <thead>
            </thead>
          </table>  

          <table id="moviesTab" class="table table-hover table-striped table-bordered">       
            <thead>
              <tr>
              <!--   <th>是否勾选</th> -->
                <th>序号</th>
                <th>id</th>
                <th>电影名称</th>
                      
              </tr>
            </thead>

            <tbody>
            <!--   动态添加表格项   -->
            </tbody>
          </table>
        </div>

         <div class="col-lg-4">
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
    $(window).load(queryPlayList());
  </script>

</html>