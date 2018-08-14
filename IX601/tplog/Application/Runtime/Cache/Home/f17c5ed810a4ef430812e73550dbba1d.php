<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="/remote/tplog/Public/Home/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/remote/tplog/Public/Home/css/guanlicenter_zcsy.css" />
    <link rel="stylesheet" href="/remote/tplog/Public/Home/css/myFont.css" />
    <link rel="stylesheet" type="text/css" href="/remote/tplog/Public/Home/css/sweetalert.css">
    <link href="/remote/tplog/Public/Home/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/remote/tplog/Public/Home//css/paging.css" />

    <script src="/remote/tplog/Public/Home/jquery.min.js"></script>
    <script src="/remote/tplog/Public/Home/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/remote/tplog/Public/Home/My97DatePicker/WdatePicker.js"></script>
    <script src="/remote/tplog/Public/Home/js/redefinedAlert.js"></script><!-- 重定义alert样式  -->
    <script src="/remote/tplog/Public/Home/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="/remote/tplog/Public/Home/js/zepto.js?2"></script>
    <script src="/remote/tplog/Public/Home/js/jquery.cookie.js"></script>
    <script src="/remote/tplog/Public/Home/js/jquerysession.js"></script>
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
            background: url("/remote/tplog/Public/Home/images/down.png") no-repeat center center
        }
    </style>
    <script type="text/javascript">

       function exportExcel(){
          var down_date_start = $("#down_date_start").val();
          var down_date_end = $("#down_date_end").val();
          var diy_select_code = $("#searchVideo").val();
          var select = "down_date_start="+down_date_start+"&down_date_end="+down_date_end+"&diy_select_code="+diy_select_code;
          swal({  
                  title:"",  
                  text:"确定要导出此播放日志吗？",  
                  type:"warning",  
                  showCancelButton:"true",  
                  showConfirmButton:"true",  
                  confirmButtonText:"确定",  
                  cancelButtonText:"取消",  
                  animation:"slide-from-top"  
              }, function() {  
                  window.location.href="<?php echo U('Log/exportExcel');?>?"+select;
        });
       }
       function clearSearch(){
          $("#down_date_start").val("");
          $("#down_date_end").val("");
          $("#searchVideo").val("");
          $("form").submit();
       }
       function deleteSearch(){
          var down_date_start = $("#down_date_start").val();
          var down_date_end = $("#down_date_end").val();
          var diy_select_code = $("#searchVideo").val();
          swal({  
                  title:"",  
                  text:"确定要删除当前搜索结果的数据吗？",  
                  type:"warning",  
                  showCancelButton: true, 
                  closeOnConfirm: false,  
                  confirmButtonText:"确定",  
                  cancelButtonText:"取消",  
                  animation:"slide-from-top"  
              }, function() {  
                  $.post("<?php echo U('Log/serverDeleteSearch');?>",
                    {down_date_start:down_date_start,down_date_end:down_date_end,
                      diy_select_code:diy_select_code},function(data){
                      swal(data);
                  });
          });
       }
       function saveChecked(page){
          $("#page").val(page);
          $("form").submit();
       }
       function sort(obj){
          var name = $(obj).attr("name");
          var sortname = $("#sortname").val();
          var sort = $("#sort").val();
          if(name == sortname){
              if(sort == "asc"){
                $("#sort").val("desc");
              }else{
                $("#sort").val("asc");
              }
          }else{
              $("#sortname").val(name);
              $("#sort").val("asc");
          }
          $("form").submit();
       }
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
                    <form action="<?php echo U('Home/Log/serverLog');?>" method="post">
                      <div style="float:left;margin-left:-36px;" >
                        日期查询
                  <input type="text" id="down_date_start"  onfocus="WdatePicker()" name="down_date_start" size="10" value="<?php echo ($searchReturn["down_date_start"]); ?>" placeholder="开始日期" /> 至
                  <input type="text" id="down_date_end" onfocus="WdatePicker()" name="down_date_end" size="10" value="<?php echo ($searchReturn["down_date_end"]); ?>" placeholder="结束日期"/>&nbsp;&nbsp; &nbsp;
                      &nbsp; 
                      </div>
                      <input type="hidden" id="page" name="page" value="">
                      <input type="hidden" id="sortname" name="sortname" value="<?php echo ($sortname); ?>">
                      <input type="hidden" id="sort" name="sort" value="<?php echo ($sort); ?>">
                      <div style="float:left"> 
                        &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                        &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;关键字 &nbsp;  
                      </div>
                        <div style="float:left;margin-left:3px;" >                                              
                          <input id="searchVideo" name="diy_select_code" size="12" type="text" placeholder="请输入关键词"  value="<?php echo ($searchReturn["diy_select_code"]); ?>" > &nbsp;&nbsp;                          
                        </div>
                        
                        <div style="float:left"> 
                          &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                          &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;  
                        </div>

                        <div style="float:left"><input type="submit" class="sblue-btn" value="搜索" />
                        &nbsp;&nbsp;<input type="button" class="sblue-btn" onclick="clearSearch()" value="清空" /></div>
                    </form>
                </dd>
            </dl>
            <div style="float:right;margin-top:-20px;">&nbsp;&nbsp;
                  <a href="#" id="exportExcel" onclick="exportExcel()" type="button" class="sblue-btn" style="text-decoration:none;">导出Excel</a>
            </div>
            <div style="float:right;margin-top:-20px;margin-right:50px;">&nbsp;&nbsp;
                  <a href="#" id="exportExcel" onclick="deleteSearch()" type="button" class="sblue-btn" style="text-decoration:none;">删除搜索</a>
            </div>
        </div>
    
      <div class="row" >
        <div  class="col-lg-10" align="right" class="logo" ><h4><a href="#" id="loginButton"><span></span></a></h4></div> 
      </div> 

      <div class="row">
        <br>
      </div> 

      <div class="row">
        <p style="font-size: 21px;margin-bottom:-7px;">日志列表</p>
        <p style="float:right;margin-right:10px;margin-bottom:5px;">播放次数:<b id="playTimes" style="color:red;margin-left:5px"><?php echo ($count); ?></b></p>
        <p style="float:right;margin-right:10px;margin-bottom:5px;">设备台数:<b id="deviceCount" style="color:red;margin-left:5px"><?php echo ($deviceCount); ?></b></p>
        <legend></legend>
        <table id="mobileTab" class="table table-hover table-striped table-bordered">       
          <thead>
            <tr>
              <th><a href="javascript:;" name="id" style="text-decoration: none;" onclick="sort(this)">影片Id&#8593&#8595</a></th>
              <th><a href="javascript:;" name="deviceid" style="text-decoration: none;" onclick="sort(this)">电影机编号&#8593&#8595</a></th>
              <th><a href="javascript:;" name="device_name" style="text-decoration: none;" onclick="sort(this)">电影机别名&#8593&#8595</a></th>
              <th><a href="javascript:;" name="group_name" style="text-decoration: none;" onclick="sort(this)">组别名&#8593&#8595</a></th>
              <th><a href="javascript:;" name="file_name" style="text-decoration: none;" onclick="sort(this)">影片名称&#8593&#8595</a></th>
              <th><a href="javascript:;" name="play_start" style="text-decoration: none;" onclick="sort(this)">开始时间&#8593&#8595</a></th>
              <th><a href="javascript:;" name="play_end" style="text-decoration: none;" onclick="sort(this)">结束时间&#8593&#8595</a></th>
              <th>播放时长</th>
              <th>操作用户</th>
              <th>播放类型</th>
            </tr>
          </thead>

          <tbody>
             <?php if(is_array($playLog)): $i = 0; $__LIST__ = $playLog;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$log): $mod = ($i % 2 );++$i;?><tr>
                  <td><?php echo ($log["id"]); ?></td>
                  <td><?php echo ($log["deviceid"]); ?></td>
                  <td><?php echo ($log["device_name"]); ?></td>
                  <td><?php echo ($log["group_name"]); ?></td>
                  <td><?php echo ($log["file_name"]); ?></td>
                  <td><?php echo ($log["play_start"]); ?></td>
                  <td><?php echo ($log["play_end"]); ?></td>
                  <td><?php echo ($log["time"]); ?></td>
                  <td><?php echo ($log["username"]); ?></td>
                  <td><?php echo ($log["video_type"]); ?></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>
        </table>

        <!-- paging分页 -->
        <div class="showPage"  align="center"  id="showPage" style="display:block;margin-top:-20px;">
          <?php echo ($page); ?>
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

<script type="text/javascript" src="/remote/tplog/Public/Home/js/select.js"></script>
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