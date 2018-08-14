<html>
   <head>
      <meta http-equiv="content-type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!--    <link href="../css/style.css" rel="stylesheet" type="text/css" media="all"/> -->
      <link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
      <link href="../css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="../css/myFont.css" /><!-- 此处设置页面字体为微软雅黑，在css最后覆盖前面的字体样式 -->
      <style type="text/css">/*表格中内容居中*/
        .table th, .table td { 
          text-align: center; 
          height:38px;
        }
      </style>
  </head>

  <body>

    <div class="container main-container">
      <h3>播放列表管理</h3>
        <div class="row" >
          <br>
        </div> 
      <div class="col-lg-12">
        <legend></legend>
          <table id="movieTab" class="table table-hover table-striped table-bordered">       
            <thead>
              <tr>
                <th>序号</th>
                <th>名称</th>
                <th>查看</th> 
                <th>修改</th>
                <th>删除</th> 
                <th>导出</th>
                <th>进度</th>           
              </tr>
            </thead>
            <tbody>
            <!--   动态添加表格项   -->
            </tbody>
          </table>
          <!-- paging分页 -->
            <div class="showPage"  align="center"  id="showPage" style="display:block;">
              <?php
                require_once('../Class/page.class.php'); //分页类
                require('../Model/MovieModel.php'); //引入视频模型类 
                $showrow = 5; //一页显示的行数 
                $curpage = empty($_GET['page']) ? 1 : $_GET['page']; //当前的页,还应该处理非数字的情况 
                $url = "?page={page}"; //分页地址，如果有检索条件 ="?page={page}&q=".$_GET['q']
                $dao = new MovieModel();
                $data = $dao->getSavedMovieListNames();
                $total= count($data);
                if ($total > $showrow){//总记录数大于每页显示数，显示分页 
                  $page = new page($total, $showrow, $curpage, $url, 2); 
                  echo $page->myde_write("saved_list"); 
                } 
              ?> 
            </div> 
          <!-- paging-->
      </div>

      <!-- model模态框显示电影列表的内容 -->
        <div id="movieList" class="modal">
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

      <!-- model模态框下载进度 -->
      <div class="modal fade"  tabindex="-1" id="progressbar">  
        <!--窗口声明：-->  
        <div class="modal-dialog modal-lg">  
          <!-- 内容声明 -->  
          <div class="modal-content">  
            <div class="modal-header" style="height:60px;">
                <a class="close" data-dismiss="modal">x</a>
                <h4 style="font-weight:bold">本地USB导出</h4>
            </div>  
            <div class="modal-body">
              <div class="tables">
                <table id="ExportPercent" class="table table-hover table-striped table-bordered">       
                  <thead>
                    <tr class="info">
                      <th>正在导出列表</th>
                      <th>影片数量</th>
                      <th>总大小</th> 
                      <th>已导影片大小</th>
                      <th>导出进度</th>           
                    </tr>
                  </thead>
                  <tbody>
                  <!--   动态添加表格项   -->                   
                  </tbody>
                </table>
              </div>  
              <div class="progress progress-striped active">  
                <div id="test" class="progress-bar progress-bar-success" role="progressbar" >  
                    
                </div>  
              </div>  
            </div>  
          </div>  
        </div>  
      </div>  
       <!-- model -->

    </div>

  </body>
<script type="text/javascript">
  function querySavedMovieList(){    
          //动态生成电影列表
          $.get("../Controller/MovieController.php?method=getSavedMovieListNames",{},function(data){  
            lists= eval('(' +data+ ')');
            function reverseOrder(lists){
                for(var i=0;i<lists.length;i++){
                   for(var j=i;j<lists.length;j++){
                      if(parseInt(lists[i]["create_time"])<parseInt(lists[j]["create_time"])){
                         var temp = lists[i];
                         lists[i] = lists[j];
                         lists[j] = temp;
                      }
                   }           
                }
                return lists;
            }
            for(var o in reverseOrder(lists)){
              var curpage = <?php echo $curpage = empty($_GET['page']) ? 1 : $_GET['page'];?>;
              if(o>=(curpage-1)*5&&o<curpage*5){
                var line=parseInt(o)%5;
                listNu=parseInt(o)+1;
                var listName=lists[o];
                $("#movieTab tbody").append("<tr>"+'<td>'+listNu+'</td>'   
                                          +'<td>'+lists[o]['list_name']+'</td>'                              
                                          +'<td><a href="#movieList" data-toggle="modal" class="btn btn-warning btn-large">查看</a></td>'
                                          +"<td><button class='btn btn-primary  btn-md' onclick='editMovieList(this);'>修改</button></td>"
                                          +"<td><button class='btn btn-danger  btn-md' onclick='deleteMovieList(this);'>删除</button></td>"
                                          +"<td><button class='btn btn-primary  btn-md' onclick='dumpMovieList(this);'>导出</button></td>"
                                          +'<td><button href="#progressbar" data-toggle="modal" class="btn btn-success btn-large">进度</button></td>'
                                          +'</tr>');
                
                $("#movieTab tbody tr:eq("+line+") td:eq(2) a").click({listName:listName},function(evt){
                  listName=$(this).parent().prev().html();  
                  $("#movieList .modal-body").html("<iframe style='height:340px;box-shadow:0px 0px 1px 1px #888888;' frameborder='0' src='SavedMovieList.php?listName="+listName+"'></iframe>");
                });

                $("#movieTab tbody tr:eq("+line+") td:eq(6) button").click({listName:listName},function(evt){
                    listName=$(this).parent().prev().prev().prev().prev().prev().html();
                    $.get("../Controller/MovieController.php?method=getCopyPercent",{listName:listName},function(data){
                        $("div[role='progressbar']").css("width",data+"%");
                        var html = '已导出:'+data+'%';
                        $("div[role='progressbar']").html(html);
                        $.get("../Controller/MovieController.php?method=getExportMessage",{listName:listName},function(data){
                          var ExportMessage = eval('('+data+')');
                          $("#ExportPercent tbody tr").remove();
                          $("#ExportPercent tbody").append("<tr>"+'<td>'+ExportMessage['listname']+'</td>'   
                                        +'<td>'+ExportMessage['videoNum']+'</td>'
                                        +'<td>'+ExportMessage['totalSize']+'</td>'
                                        +'<td>'+ExportMessage['currentFileSize']+'</td>'
                                        +'<td>'+ExportMessage['exportPersent']+'</td>'                              
                                        +'</tr>');
                        })
                      }     
                    );
                    //window.location.href = "../Controller/MovieController.php?method=getCopyPercent";
                });               
              }
             
            }
           
          });
        }

        function dumpMovieList(curLine){
          listName=$(curLine).parent().prev().prev().prev().prev().html();
          swal({  
              title:"",  
              text:"确定要导出该列表吗？",  
              type:"warning",  
              showCancelButton:"true",  
              showConfirmButton:"true",  
              confirmButtonText:"确定",  
              cancelButtonText:"取消",  
              closeOnConfirm:false,  
              closeOnCancel:true  
            }, function(){
              //首先使用伪方法弹出提示信息
              $.get("../Controller/MovieController.php?method=dumpMovieListFalse",{listName:listName},function(data){
                  sweetAlert(data);
                  //然后使用此方法进行真实导出
                  if(data == "影片开始导出"){
                    $.get("../Controller/MovieController.php?method=dumpMovieList",{listName:listName},function(data){});
                  }           
              });
              //window.location.href = "../Controller/MovieController.php?method=dumpMovieList";
          });
        }

        function deleteMovieList(curLine){
          listName=$(curLine).parent().prev().prev().prev().html();
          // console.log(listName);
          swal({  
              title:"",  
              text:"确定要删除该列表吗？",  
              type:"warning",  
              showCancelButton:"true",  
              showConfirmButton:"true",  
              confirmButtonText:"确定",  
              cancelButtonText:"取消",  
              animation:"slide-from-top"  
            }, function() { 
            $.get("../Controller/MovieController.php?method=deleteSavedMovieList",{listName:listName},function(data){
              // $.alert(data);
              window.location.href = "SavedMovieListManage.php";
            });
          });
        }

        function editMovieList(curLine){
          var td=$(curLine).parent();//编辑按钮所在列
          td.prev().prev().html("<input type='text'  class='form-control input-md' size='3' placeholder='"+$(curLine).parent().prev().prev().html()+"'>");
          $(curLine).remove();
          td.append("<button class='btn btn-warning  btn-md' onclick='saveMovieList(this);'>保存</button>");
        }

        function saveMovieList(curLine){
          var nameTd=$(curLine).parent().prev().prev();//编辑框所在列
          
          var newName=nameTd.find("input").val();
          var oldName=nameTd.find("input").attr("placeholder");
    
          var td=$(curLine).parent();//保存按钮所在列
          if(newName==""||oldName==""){//当没有改动时还原原始别名
            $(curLine).remove();
            td.append("<button class='btn btn-primary  btn-md' onclick='editMovieList(this);'>修改</button>");
            nameTd.find("input").remove();
            nameTd.append(oldName);
            return;
          }
          if(newName.replace(/\s+/g, "").length == 0){
              sweetAlert("列表名不可全为空格");
              return;
          }
          if(newName.length>6 || oldName.length>6){
              sweetAlert("列表名称最多为6个字");
              return;
          }
          $.get("../Controller/MovieController.php?method=updateSavedMovieList",{oldName:oldName,newName:newName},function(data){
            $.alert(data);
            if(data=="修改成功"){
              $(curLine).remove();
              td.append("<button class='btn btn-primary  btn-md' onclick='editMovieList(this);'>修改</button>");
              nameTd.find("input").remove();
              nameTd.append(newName);
            }
          });
          
        }

  </script>
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/sweetalert.min.js"></script>  
  <script src="../js/redefinedAlert.js"></script><!-- 重定义alert样式  -->
  <script src="../js/vue.js"></script><!-- 引入vue  -->
  <script type="text/javascript">
   
        var percentData = {
            length:0
        }

        // 创建一个 Vue 实例或 "ViewModel"
        // 它连接 View 与 Model
        var vm=new Vue({
            el: '#progressbar',
            data: percentData
        });
    
  </script>
  <script type="text/javascript">
    $(window).load(querySavedMovieList());
  </script>

</html>