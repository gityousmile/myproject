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
    <link rel="stylesheet" href="/remote/tplog/Public/Home/css/paging.css" />

    <script src="/remote/tplog/Public/Home/js/jquery.min.js"></script>
    <script src="/remote/tplog/Public/Home/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/remote/tplog/Public/Home/My97DatePicker/WdatePicker.js"></script>
    <script src="/remote/tplog/Public/Home/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="/remote/tplog/Public/Home/js/zepto.js?2"></script>
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

       function sortByTime(){
          var sort = $("#sort").val();
          if(sort == "desc"){
            sort = "asc";
          }else{
            sort = "desc";
          }
          $("#sort").val(sort);
          $("form").submit();
       }

       function saveChecked(page){
          $("#page").val(page);
          $("form").submit();
       }

       function clearSearch(){
          $("#down_date_start").val("");
          $("#down_date_end").val("");
          $(".diy_select_txt").val("");
          $("#searchVideo").val("");
          $("form").submit();
       }
    </script> 
</head>

<body>
  <div class="container main-container">
    <h3 style="float:left;margin-left:-19px;">系统操作日志</h3>
    <div class="row">
      <br>
    </div> 
    <legend style="margin-left:-19px;"></legend>
    
    <div class="clearfix searchspin" align="center">
              <dl>
                <dd>
                    <form action="<?php echo U('Home/Log/operaLog');?>" method="post">
                      <div style="float:left;margin-left:-36px;" >
                        日期查询
                  <input type="text" id="down_date_start" onfocus="WdatePicker()" name="down_date_start" size="10" value="<?php echo ($searchReturn["down_date_start"]); ?>" placeholder="开始日期" /> 至
                  <input type="text" id="down_date_end" onfocus="WdatePicker()" name="down_date_end" size="10" value="<?php echo ($searchReturn["down_date_end"]); ?>" placeholder="结束日期"/>&nbsp;&nbsp; &nbsp;
                      &nbsp; 
                      </div>
                      <input type="hidden" id="page" name="page" value="">
                      <input type="hidden" id="sort" name="sort" value="<?php echo ($sort); ?>">
                      <div style="float:left"> 
                        &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                        &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;操作类型 &nbsp;  
                      </div>
                        
                        <div class="diy_select mr5" style="float:left"> 
                            
                            <input type="hidden" name="film_type" value="" class="diy_select_input" id="payee">
                            <input type="text" value="<?php echo ($searchReturn["diy_select_txt"]); ?>" name="diy_select_txt" placeholder="请选择影片类型" class="diy_select_txt" readonly="readonly"> 
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
                                <li data-value="20" style="width:115px;margin-left:-40px;">创建组别</li>
                                <li data-value="20" style="width:115px;margin-left:-40px;">删除组别</li>
                              </ul>
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
              <th>序号</th>
              <th><a href="javascript:;" style="text-decoration: none;" onclick="sortByTime()">操作日期
                &#8593&#8595</a></th>
              <th>操作用户</th>
              <th>操作信息</th>
            </tr>
          </thead>

          <tbody>
            <?php if(is_array($operalogdata)): $i = 0; $__LIST__ = $operalogdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$log): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($log["oprera_id"]); ?></td>
                <td><?php echo ($log["time"]); ?></td>
                <td><?php echo ($log["username"]); ?></td>
                <td><?php echo ($log["oprera_name"]); ?></td>
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>
        </table>

        <!-- paging分页 -->
        <div class="showPage"  align="center"  id="showPage" style="display:block;margin-top:-20px;">
          <?php echo ($page); ?>
        </div> 

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