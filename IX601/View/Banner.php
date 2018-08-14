<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no, -ms-touch-action: none">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="format-detection" content="telephone=no">
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/myFont.css" />
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/sweetalert.min.js"></script> 
        <link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
        <style>
            .intellixLogo{
                float:left;
                display:inline;
            }

            .intellixLogout{
                float:right; 
                display:inline;
                margin-top:20px;
                margin-right:200px;;
            }
        </style>
    </head>

    <body>  
        <div>
            <div class="logo intellixLogo"><h2><img src="../images/logo.jpg" width="150" height="50" alt="logo" />
                <span>文化娱乐管理系统</span> </h2>
            </div>
            <div class="row menu_nav intellixLogout">    
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <button id="logOut" onclick="logOut();" class="btn btn-warning btn-lg" >
                        <span class="glyphicon glyphicon-log-out"></span> 注销
                    </button>  
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4">
                    <span style="float:right;margin-right:-136px;margin-top:15px;">欢迎:&nbsp
                        <b>
                            <?php
                                session_start();
                                echo $_SESSION['valid_user'];
                            ?>
                        </b>
                    </span>
                </div>

               <!-- <div class="col-lg-2 col-md-2 col-sm-2">
                    <button id="shutDown" onclick="shutDown();" class="btn btn-primary btn-lg">
                        <span class="glyphicon glyphicon-off"></span> 关机
                    </button>
                </div>-->
            </div> 

        </div>     
        <script>
            function logOut(){
                var operation="logout";
                $.post('../Controller/UserController.php',{operation:operation},function(data){
                    window.parent.location.href="../login.php";
                });
            }

            function shutDown(){
                var operation="ShutDown";
                          
                (parent.frames[2]).swal({ 
                                            title: "您确定要关闭吗？", 
                                            text: "关闭服务器后需要您手动重启，确定关闭吗？", 
                                            type: "warning", 
                                            showCancelButton: true, 
                                            closeOnConfirm: false, 
                                            confirmButtonText: "确定关闭", 
                                            cancelButtonText: "取消", 
                                            confirmButtonColor: "#ec6c62", 
                                            cancelButtonColor: "#449D44", 
                                        }, function() { 
                                            $.get("../Utils/GetTerminal.php", {method:operation}, function(data) { 
                                                setTimeout('window.parent.location.href = "login.php"',1000);
                                            });
                                        });
              
            }      
        </script> 
    </body>
</html>