<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
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
                        <input type="text" id="down_date_start" name="down_date_start" size="10" value="" onfocus="WdatePicker({maxDate:'#F<?php echo ('%y-%M-%d'($dp["$D('down_date_end')"])); ?>'})" placeholder="开始日期"  /> 至
                        <input type="text" id="down_date_end" name="down_date_end" size="10" value=""  onfocus="WdatePicker({minDate:'#F<?php echo ($dp["$D('down_date_start')"]); ?>',maxDate:'%y-%M-%d'})" placeholder="结束日期" />&nbsp;&nbsp; 上映年份
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
                                <li style="width:115px;margin-left:-40px;">全部</li>
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
            <input type='text' id='listName'  class='form-control input-lg' style="width:300px" placeholder="" value="">
            <span class="col-lg-1"> </span><button onclick="saveMovieList()" class="btn btn-primary  btn-lg col-lg-3">保存播放列表</button>
          </div>
        </div>
        <br>
      </div> 

      <div class="row">
        <legend>影片列表</legend>

        <table id="mobileTab" class="table table-hover table-striped table-bordered">       
          <thead>
            <tr>
              <th><input type="checkbox" id="checkAll" name="checkAll" ></th>
              <th><a href="javascript:;" style="text-decoration: none;" onclick="sortMovieListById()">影片ID&#8593&#8595</a></th>
              <th><a href="javascript:;" style="text-decoration: none;" onclick="sortMovieListByFileName()">影片名&#8593&#8595</a></th>
              <th><a href="javascript:;" style="text-decoration: none;" onclick="sortMovieListByDownTime()">下载日期&#8593&#8595</a></th>
              <th><a href="javascript:;" style="text-decoration: none;" onclick="sortMovieListByReleaseDate()">上映年份&#8593&#8595</a></th>
              <th>影片类型 </th>
          <!--     <th>播放次数 </th> -->
              <th>影片时长 </th>
            </tr>
          </thead>

          <tbody>
          <!--   动态添加表格项   -->
          </tbody>
        </table>

    </div>
</body>