<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no, -ms-touch-action: none">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="format-detection" content="telephone=no">
        <meta name="description" content="" />
        <title>注册页面</title>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/animate.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../css/select3default.css">
        <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
        <link rel="stylesheet" type="text/css" href="../css/select3.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">

        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/wow.min.js"></script>
        <script src="../js/sweetalert.min.js"></script> 
        <script src="../js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="../js/select3-full.js"></script>
        <link rel="stylesheet" href="../css/myFont.css" />
        <link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
  
        <style> 
        * {  box-sizing: border-box; } 
        #selectGroup{
            width: 100%;
            height: 34px;
            color: #555;
            padding: 6px 8px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-left: -15px;
        }
        #groupManage{
            margin-left: -15px;
            width: 100%;
            margin-top: 10px;
        }
        #password{
           margin-bottom: 20px; 
        }
        #groupSelect{
            margin-left: -15px;
            width: 100%;
            border: 1px solid #ccc;
            color: #555;
            background-color: #fff;
            background-image: none;
            border-radius: 4px;
            margin-top: -40px;
            margin-bottom: 20px;
        }
        #registContent{
            /*display: none;*/
        }
        #manage{
            text-align: center;
            background: rgba(138, 109, 59, 0.18);
            display: none;
        }
        #groupName{
             margin-top: 16px;
        }
        #groupName .col-md-3{
            margin-top: 16px;
        }
        #groupName .col-md-3 button{
            width: 80px;
        }
        #groupManagebutton button{
            margin-top:22px;
            height: 40px;
            width: 152px;
        }
        #groupManagespan{
           margin-top: 40px;
        }
        .span{
            margin: 0 auto;
            height: 40px;
            width: 147px;
            padding-top: 12px;
            background: rgba(248, 187, 134, 0.68);
            color: rgb(118, 87, 60);
        }
        #addGroup{
            height: 114px;
            margin-top: 25px;
            border-radius: 4px;
            margin-bottom: 25px;
            background: rgba(85, 85, 85, 0.08);
            border-radius: 4px;
        }
        #addGroup .col-md-9{
            margin-top: 38px;
        }
        #addGroup .col-md-3{
            margin-top: 38px;
        }
        #legend{
            border: 2px solid rgba(0, 0, 0, 0.05);
            margin-top: 38px;
        }
        </style>
    </head>
    <body>
        
        <div class="row">
        </div>
      <div class="row">  
      
            <div class="col-lg-12 panel panel-warning">
                <div class="panel-heading" align="center">
                    <h3> &nbsp;&nbsp;&nbsp;用户注册</h3>
                </div>

                <div class="row">
                    <br><br><br><br>
                </div>
                <div class="panel-body">
                    <div class="col-lg-3 container main-container" >
                    </div>
                    <div class="col-lg-6 container main-container"  id="registContent">

                        <div class="form-group ">
                            <input class="form-control" id="name" name="name" placeholder="用户名" value="" type="text">
                        </div>

                        <div class="form-group ">
                            <input class="form-control" id="password" name="mobile" placeholder="密码" value="" type="tel">
                        </div>

                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <h2><a id="select-multiple-cities" class="anchor" href="#select-multiple-cities" aria-hidden="true"></a></h2>
                            <div id="groupSelect" class="select3-input example-input"></div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2">
                            <button type="submit" class="btn btn-success" id="groupManage">组别管理</button>
                        </div>
                        <br>
                        <input type="hidden" id="flag" name="flag" value="add">
                        <br>
                        <br>
                        <button type="submit" class="btn btn-warning btn-block btn-lg" id="btn_login" >注册</button>
                    </div>
                    <div class="col-lg-6 container main-container wow bounceInDown" id="manage">
                        <div class="col-lg-12 col-md-12 col-sm-12" id="groupName">
                           <!-- 动态加载 -->
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12" id="groupManagebutton">
                            <button type="button" class="btn btn-info" id="gmb">组别管理</button>
                            <button type="button" style="display:none" class="btn btn-info" id="groupDelete">删除</button>
                            <button type="button" style="display:none" class="btn btn-info" id="groupHide">取消</button>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12" id="legend">
                            
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12" id="groupManagespan">
                            <div class="span">
                                创建组别
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="col-lg-2 col-md-2 col-sm-2">
                            
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8"  id="addGroup">
                                <div class="col-lg-9 col-md-9 col-sm-9">
                                   <input class="form-control" type="text" class placeholder="请输入组别名">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                   <button type="button" class="btn btn-warning">保存组别</button>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2">
                                
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12" id="goback">
                            <button type="button" id="goBack" class="btn btn-info" style="width:80px;margin-bottom: 25px;">返回</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <script>
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

            $("#btn_login").bind("click",function(){
                var name = $("#name").val();
                var password = $("#password").val();
                var operation = "register";
                var reg = /^\w{6,12}$/;
                var userReg = /^\w+$/;

                var group = "";
                $("#groupSelect .select3-multiple-input-container .select3-multiple-selected-item").each(function(){
                    var group_name = $(this).text();
                    group += group_name+",";
                })
                group = group.substr(0,group.length-1);

                if(!name){
                    swal("请填写用户名");
                    return;
                }               
                if(!password){
                    swal("请填写密码");
                    return;
                }

                if(!name.match(userReg)){
                    swal("请填写由字母和数字组成的用户名");
                    return;
                }

                if(!password.match(reg)){
                    swal("请填写由字母和数字组成的6-12位密码");
                    return;
                }

                if(group == ""){
                    swal("请选择组别");
                    return;
                }
                
                $.post('../Controller/UserController.php', {operation:operation,user:name,password:password,group:group}, function(response){
                    if(response=="0"){
                        swal("该用户已注册");
                        setTimeout('window.location.href = "UserRegister.php"',1000);
                    }else if(response=="1"){
                        swal("注册成功");
                        setTimeout('window.location.href = "UserRegister.php"',1000);
                    }else{
                        swal("注册失败请检查信息填写格式");
                        setTimeout('window.location.href = "UserRegister.php"',1000);
                    }
                    // window.location.href = "UserRegister.php";                       
                });
                    
            });
            
            $(function(){
                new WOW().init();
                $.post('../Controller/DeviceController.php?method=getGroup', {}, function(data){
                    var grouplist = eval("("+data+")");
                    var group_name = new Array();
                    for(var o in grouplist){
                        group_name[o] = grouplist[o]['group_name'];
                    }
                    $('#groupSelect').select3({
                        items: group_name,
                        multiple: true,
                        placeholder: '请选择组别'
                    });
                    $("#selectGroup option").remove();
                    $("#groupName .col-md-3").remove();
                    $("#selectGroup").append('<option selected="">请选择组别</option>');
                    for(var o in grouplist){
                        $("#selectGroup").append('<option>'+grouplist[o]['group_name']+'</option>')
                        $("#groupName").append('<div class="col-lg-3 col-md-3 col-sm-3">'
                                                +'<button type="button" class="btn btn-success">'
                                                +grouplist[o]['group_name']
                                                +'</button></div>'
                                               );
                    }
                    $("#groupName .col-md-3 .btn-success").click(function(){
                    $(this).removeClass("btn-success");
                    $(this).addClass("btn-danger");
                    $("#groupName .col-md-3 .btn-danger").click(function(){
                        $(this).removeClass("btn-danger");
                        $(this).addClass("btn-success");
                        $("#groupName .col-md-3 .btn-success").click(function(){
                            $(this).removeClass("btn-success");
                            $(this).addClass("btn-danger");
                            $("#groupName .col-md-3 .btn-danger").click(function(){
                                $(this).removeClass("btn-danger");
                                $(this).addClass("btn-success");
                            })
                        })
                    })
                })
                });

                function loadGroup(){
                    $.post('../Controller/DeviceController.php?method=getGroup', {}, function(data){
                        var grouplist = eval("("+data+")");
                        //console.log(grouplist);
                        $("#selectGroup option").remove();
                        $("#groupName .col-md-3").remove();
                        $("#selectGroup").append('<option selected="">请选择组别</option>');
                        for(var o in grouplist){
                            $("#selectGroup").append('<option>'+grouplist[o]['group_name']+'</option>');
                            $("#groupName").append('<div class="col-lg-3 col-md-3 col-sm-3">'
                                                    +'<button type="button" class="btn btn-success">'
                                                    +grouplist[o]['group_name']
                                                    +'</button></div>'
                                                   );
                        }
                        $("#groupName .col-md-3 .btn-success").click(function(){
                        $(this).removeClass("btn-success");
                        $(this).addClass("btn-danger");
                        $("#groupName .col-md-3 .btn-danger").click(function(){
                            $(this).removeClass("btn-danger");
                            $(this).addClass("btn-success");
                            $("#groupName .col-md-3 .btn-success").click(function(){
                                $(this).removeClass("btn-success");
                                $(this).addClass("btn-danger");
                                $("#groupName .col-md-3 .btn-danger").click(function(){
                                    $(this).removeClass("btn-danger");
                                    $(this).addClass("btn-success");
                                })
                            })
                        })
                    })
                    });
                }

                $("#groupManage").click(function(){
                    $("#registContent").hide();
                    $("#manage").show();
                })
                $("#goback button").click(function(){
                    $("#registContent").show();
                    $("#manage").hide();
                })
                $("#groupManagebutton button").click(function(){
                    $(this).hide();
                    $("#groupDelete").show();
                    $("#groupHide").show();
                })
                $("#groupHide").click(function(){
                    $("#gmb").show();
                    $("#groupDelete").hide();
                    $("#groupHide").hide();
                })

                $("#groupDelete").click(function(){
                    var deleteContent = new Array();
                    //var deleteContent = $("#groupName .col-md-3 .btn-danger").html();
                    var i = 0;
                    $("#groupName .col-md-3 .btn-danger").each(function(){
                        var deleteGroup = $(this).html();
                        deleteContent[i] = {deleteGroup:deleteGroup};
                        $(this).parent().remove();
                        i++;
                    })
                    if(deleteContent.length > 0){
                        var deleteName = $.toJSON(deleteContent);
                        $.post('../Controller/DeviceController.php?method=deleterGroup', {'groupName[]':deleteName}, function(data){
                            swal(data);
                            if(data = "组别删除成功"){
                                $("#groupName .col-md-3 .btn-danger").each(function(){
                                    $(this).parent().remove();
                                });
                                loadGroup();
                            }
                        })
                    }else{
                        swal("请选择组别");
                    }
                })

                $("#addGroup .col-md-3 button").click(function(){
                    var group_name = $("#addGroup .col-md-9 input").val();
                    if(!group_name){
                        swal("请输入组别名");
                        return;
                    }else if(group_name.length>4){
                        sweetAlert("组别名称最多为4个字");
                        return;
                    }
                    $.post('../Controller/DeviceController.php?method=addGroup', {group_name:group_name}, function(data){
                        swal(data);
                        if(data == "组别保存成功"){
                            loadGroup();
                            $("#addGroup .col-md-9 input").val("");
                        }
                    })
                })

                $("#goBack").click(function(){
                    $.post('../Controller/DeviceController.php?method=getGroup', {}, function(data){
                        var grouplist = eval("("+data+")");
                        var group_name = new Array();
                        for(var o in grouplist){
                            group_name[o] = grouplist[o]['group_name'];
                        }
                        $('#groupSelect').select3({
                            items: group_name,
                            multiple: true,
                            placeholder: '请选择组别'
                        });
                    })
                })
            })

        </script>

    </body>

</html>