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
        <title>修改密码</title>
       <!-- 新 Bootstrap 核心 CSS 文件 -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/animate.css" rel="stylesheet">

        <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/wow.min.js"></script>
        <script src="../js/sweetalert.min.js"></script> 
        <link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
        <link rel="stylesheet" href="../css/myFont.css" />
        <script type="text/javascript">
        function modifyPassword(){
            var oldPwd = $("#oldPwd").val();
            var newPwd = $("#newPwd").val();
            var renewPwd = $("#renewPwd").val();
            var operation = "modifyPassword";

            if(oldPwd == ""){
                swal("请输入旧密码");
            }else if(newPwd == ""){
                swal("请输入新密码");
            }else if(newPwd.replace(/\s+/g, "").length == 0){
                swal("新密码不可全为空格");
            }else if(renewPwd == ""){
                swal("请重新输入新密码");
            }else if(renewPwd != newPwd){
                swal("两次输入新密码不一致");
            }else{
                $.post("../Controller/UserController.php",{operation:operation,oldPwd:oldPwd,newPwd:newPwd,renewPwd:renewPwd},function(data){
                    if(data == "新密码修改成功"){
                        $("#oldPwd").val("");
                        $("#newPwd").val("");
                        $("#renewPwd").val("");
                    };
                    swal(data);
                })
            }

            
        }
        </script>
    </head>
    <body>
    	<div class="row">
        </div>
        <div class="row">  
      
            <div class="col-lg-12 panel panel-warning">
                <div class="panel-heading" align="center">
                    <h3> &nbsp;&nbsp;&nbsp;修改密码</h3>
                </div>

                <div class="row">
                    <br><br><br><br>
                </div>
                <div class="panel-body">
                    <div class="col-lg-3 container main-container" >
                    </div>
                    <div class="col-lg-6 container main-container" id="registContent">

                        <div class="form-group ">
                            <input class="form-control" id="oldPwd" name="oldPwd" placeholder="请输入旧密码" value="" type="password">
                        </div>

                        <div class="form-group">
                            <input class="form-control" id="newPwd" name="newPwd" placeholder="请输入新密码" value="" type="password">
                        </div>
                        
                        <div class="form-group">
                            <input class="form-control" id="renewPwd" name="renewPwd" placeholder="请重新输入新密码" value="" type="password">
                        </div>
                        <br>
                        <button type="button" onclick="modifyPassword()" class="btn btn-warning btn-block btn-lg" id="btn_login" >确认修改</button>
                    </div>
                </div>
            </div>
        </div>

    </body>