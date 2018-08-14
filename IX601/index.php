<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="renderer" content="webkit">
        <meta name="viewport" content="width=device-width,initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no, -ms-touch-action: none">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="format-detection" content="telephone=no">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/sweetalert.min.js"></script> 
        <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
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
        <script type="text/javascript">
            function queryVideoList(){    
              $.get("./Controller/MovieController.php?method=getDownloadAndLoadingMovie",{},function(data){ 
                        console.log(data);//存储播放列表
                    }
              );
            }
            function validUser(){
                $.post('./Controller/UserController.php', {operation:"getCurUser"}, function(response){
                    if(response!=0){
                      console.log(response);
                    }else{
                      window.location.href = "login.php";
                    }           
                });
            }
            $(window).load(validUser());
        </script>

    </head>
    <frameset rows="15%,*">
    	<frame src="./View/Banner.php" scrolling="no" frameborder="0">
		<frameset cols="20%,*">
			<frame id ="Navigation" src="./View/Navigation.php" frameborder="0">
			<frame id="MovieListDistribute" src="./View/MovieListDistribute.php" name="view_frame" frameborder="0">
		</frameset>
	</frameset>

</html>