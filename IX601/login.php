<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>文化娱乐管理系统</title> 
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
  <link href="css/login2.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="css/myFont.css" />
</head>
<body>
<h1>文化娱乐管理系统<sup>V2016</sup></h1>

<div class="login" style="margin-top:50px;">
    <div class="web_qr_login" id="web_qr_login" style="display: block; height: 235px;">    
      <!--登录-->
      <div class="web_login" id="web_login">     
        <div class="login-box">   
          <div class="login_form">
            <form  name="loginform"  accept-charset="utf-8" id="login_form" class="loginForm" method="post">
              <input type="hidden" name="did" value="0"/>
              <input type="hidden" name="to" value="log"/>
              <div class="uinArea" id="uinArea">
                <label class="input-tips" for="u">帐号：</label>
                <div class="inputOuter" id="uArea">           
                  <input type="text" id="u" name="user_name" class="inputstyle"/>
                </div>
              </div>

              <div class="pwdArea" id="pwdArea">
                <label class="input-tips" for="p">密码：</label> 
                <div class="inputOuter" id="pArea">
                  <input type="password" id="p" name="user_password" class="inputstyle"/>
                </div>
              </div>
                   
              <div style="padding-left:50px;margin-top:20px;">
                <input type="button" id="btn_login" value="登 录" style="width:150px;" class="button_blue"/>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!--登录end-->
    </div>
  </div>
</div>
<div class="jianyi">*推荐使用ie8或以上版本ie浏览器或Chrome内核浏览器访问本站</div>
  <script>
    $("#btn_login").bind("click",function(){
      var user = $("#u").val();
      var password = $("#p").val();
      var operation="login";
      if(!user){
        alert("请输入用户名！");
        $("#u").focus();
        return;
      }
                           
      if(!password){
        alert("请输入密码！");
        $("#p").focus();
        return;
      }
      
      $.post('./Controller/UserController.php', {user:user,password:password,operation:operation}, function(response){
        if(response!=0){
          window.location.href = "index.php";
        }else{
          alert("用户名或密码错误，请重新登录！");
        }               
      });
    });
    
    $(function(){ 
      $(document).keydown(function(event){ 
        if(event.keyCode==13){ 
           $("#btn_login").click(); 
        } 
      })
    });
  </script>
</body>
</html>