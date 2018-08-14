<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="/remote/tp/Public/Home/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/remote/tp/Public/Home/css/guanlicenter_zcsy.css" />
    <link rel="stylesheet" href="/remote/tp/Public/Home/css/myFont.css" />
    <link rel="stylesheet" type="text/css" href="/remote/tp/Public/Home/css/sweetalert.css">
    <link href="/remote/tp/Public/Home/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/remote/tp/Public/Home//css/paging.css" />

    <script src="/remote/tp/Public/Home/jquery.min.js"></script>
    <script src="/remote/tp/Public/Home/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/remote/tp/Public/Home/My97DatePicker/WdatePicker.js"></script>
    <script src="/remote/tp/Public/Home/js/redefinedAlert.js"></script><!-- 重定义alert样式  -->
    <script src="/remote/tp/Public/Home/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="/remote/tp/Public/Home/js/zepto.js?2"></script>
    <script src="/remote/tp/Public/Home/js/jquery.cookie.js"></script>
    <script src="/remote/tp/Public/Home/js/jquerysession.js"></script>
    <style type="text/css">
        .diy_select_btn span {
            font-size: 0px;
            color: #787878;
            width: 18px;
            height: 20px;
            display: inline-block;
            border-left: solid 1px #d7d7d7;
            text-align: center;
            vertical-align: top;
            line-height: 20px;
            background: url("/remote/tp/Public/Home/images/down.png") no-repeat center center
        }
    </style>
    <script type="text/javascript">
       function queryloglist(){
         $.get("<?php echo U('Log/operalogdata');?>",{},function(data){
            //将json数据转化为数组
            var operalog = eval('(' +data+ ')');
            
          });
       }
       function search(){
          
       }
       function clearSearch(){
          location.reload();
       }
       $(window).load(queryloglist());
    </script> 
</head>

<body>
  <div class="container main-container">
    <h3 style="float:left;margin-left:-19px;">服务器播放日志</h3>
    <div class="row">
      <br>
    </div> 
    <legend style="margin-left:-19px;"></legend>

    <div class="clearfix searchspin" align="center">
              <dl>
                <dd>
                    <form>
                      <div style="float:left;margin-left:-36px;" >
                        日期查询
                  <input type="text" id="down_date_start" name="down_date_start" size="10" value="" placeholder="开始日期" /> 至
                  <input type="text" id="down_date_end" name="down_date_end" size="10" value="" placeholder="结束日期"/>&nbsp;&nbsp; &nbsp;
                      &nbsp; 
                      </div>

                      <div style="float:left"> 
                        &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                        &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;影片类型 &nbsp;  
                      </div>
                        
                        <div class="diy_select mr5" style="float:left"> 
                            
                            <input type="hidden" name="film_type" value="" class="diy_select_input" id="payee">
                            <input type="text" value="" placeholder="请选择影片类型" class="diy_select_txt" readonly="readonly"> 
                            <div class="diy_select_btn">
                                <span></span>
                            </div> &nbsp;&nbsp; 
                            <ul class="diy_select_list" style="display: none;margin-top:6px;">
                                <li data-value="5" style="width:115px;margin-left:-40px;">创建列表</li>
                                <li data-value="16" style="width:115px;margin-left:-40px;">下发列表</li>
                                <li data-value="13" style="width:115px;margin-left:-40px;">删除列表</li>
                                <li data-value="15" style="width:115px;margin-left:-40px;">修改列表</li>
                                <li data-value="19" style="width:115px;margin-left:-40px;">创建设备</li>
                                <li data-value="20" style="width:115px;margin-left:-40px;">修改设备</li>
                                <li data-value="20" style="width:115px;margin-left:-40px;">删除设备</li>
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

      <div class="row">
        <legend>日志列表</legend>

        <table id="mobileTab" class="table table-hover table-striped table-bordered">       
          <thead>
            <tr>
              <th>影片Id</th>
              <th>电影机编号</th>
              <th>影片名称</th>
              <th>开始时间</th>
              <th>结束时间</th>
              <th>放映时间</th>
              <th>操作用户</th>
              <th>播放类型</th>
            </tr>
          </thead>

          <tbody>
          <!--   动态添加表格项   -->
          </tbody>
        </table>

        <!-- paging分页 -->
  <div class="showPage"  align="center"  id="showPage" style="display:block;margin-top:-20px;">
    
  </div> 
         <!-- paging-->
      </div>
      <br>

      <div class="row" align="center">
          <br>
          <br>
      </div>
      <div class="row" align="center">
        <div class="col-lg-4 col-sm-4 col-md-4"></div>     
        <div class="col-lg-4 col-sm-4 col-md-4"></div>
      </div>

</body>

<script type="text/javascript" src="/remote/tp/Public/Home/js/select.js"></script>
<script type="text/javascript">
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