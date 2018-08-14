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
        <script type="text/javascript" src="zepto.js?2"></script>
        <link href="main.css?1" rel="stylesheet">
        <style> * {  box-sizing: border-box; } </style>
    </head>
    <body>
                <div id="bod">
            <div style="text-align:left; background-color:#ff5118;padding:20px 0; width:100%;">
                <a href="#" target="_parent">
                    
                </a>
            </div>
            <div class="container main-container">
                <h1 style="display: none;" >xxxxxxxxxxxxxxxxxxxxxxxxxxxxx</h1>
                <br/>
                <legend>设备注册</legend>

                <div class="form-group ">
                    <input class="form-control" id="name" name="name" placeholder="设备名" value="" type="text">
                </div>

                <div class="form-group ">
                    <input class="form-control" id="id" name="mobile" placeholder="设备id" value="" type="tel">
                </div>   

                <input type="hidden" id="flag" name="flag" value="add">

                <button type="submit" class="btn btn-warning btn-block btn-lg" id="btn_login" >注册</button>

            </div>
        </div>
         <script>
            $("#btn_login").bind("click",function(){
                var name = $("#name").val();
                var id = $("#id").val();
        
               // show_loading();

                if(!name){
                    show_tips("请填写设备名");
                    return;
                }               
                if(!id){
                    show_tips("请填写设备id");
                    return;
                }


                  $.post('DeviceController.php?method=registerDevice', {name:name,id:id}, function(response){
                        //var resp= eval(response);
      
                       if(response=="0"){
                            alert("该设备已注册");
                       }else if(response=="1"){
                            alert("注册成功");
                       }else{
                            alert("注册失败请检查信息填写格式");
                       }
                        
                        window.location.href = "Register.php";
                    });
                    
            });


        </script>

    </body>

</html>