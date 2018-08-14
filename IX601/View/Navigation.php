<?php
	$host = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
	//echo $host;
	$url_ftx="http://".$host."/Home/Login/index";
	//echo $url_ftx;
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>左侧导航</title>
	<link rel="stylesheet" type="text/css" href="../css/default.css">
	<link rel="stylesheet" href="../css/navistyles.css" type="text/css" />
	<link href="../css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../css/myFont.css" />
	<script src="../js/jquery.min.js"></script>
	<script src="../js/jquery-2.1.1.min.js" type="text/javascript"></script>
	<script src="../js/jquery.ssd-vertical-navigation.min.js"></script>
	<script src="../js/app.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){

			var ftx_url="<?php  echo $url_ftx;?>" ;
			// alert("ftx_url:"+ftx_url);
			var a = document.getElementById('link_url');
			a.href=ftx_url;

		});
	</script>
</head>

<body id="bg">
	<div class="container">

		<div id="contentWrapper">

			<div id="contentLeft">
				<ul id="leftNavigation">

					<li class="active">
						<a href="#"><i class="fa fa-caret-square-o-right leftNavIcon"></i>电影机播控</a>
						<ul>
							<li>
								<a href="MovieListDistribute.php" target="view_frame"><i class="fa fa-angle-right leftNavIcon"></i>播放列表创建</a>
							</li>
							<li>
								<a href="SavedMovieListSubmit.php" target="view_frame"><i class="fa fa-angle-right leftNavIcon"></i>播放列表下发</a>
							</li>
							<li>
								<a href="SavedMovieListManage.php" target="view_frame"><i class="fa fa-angle-right leftNavIcon"></i>播放列表管理</a>
							</li>
							<li>
								<a href="ControlMoviePlay.php" target="view_frame"><i class="fa fa-angle-right leftNavIcon"></i>设备控制</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#"><i class="fa fa-cog leftNavIcon"></i> 电影机管理</a>
						<ul>
							<li>
								<a href="DeviceManage.php" target="view_frame"><i class="fa fa-angle-right leftNavIcon"></i> 设备状态</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#"><i class="fa fa-cloud-download leftNavIcon"></i>下载影片</a>
						<ul>
							<li>
								<a href="#" id="link_url" target="view_frame">下载影片</a>
							</li>
						</ul>
					</li>
					
					<li>
						<a href="#"><i class="fa fa-film leftNavIcon"></i> 影片管理</a>
						<ul>
							<li>
								<a href="MovieListManage.php" target="view_frame"><i class="fa fa-angle-right leftNavIcon"></i>系统片库</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#"><i class="fa fa-user leftNavIcon"></i>系统管理</a>
						<ul>
							<li>
								<a href="ModifyPassword.php" target="view_frame"><i class="fa fa-angle-right leftNavIcon"></i>修改密码</a>
							</li>
							<?php 
							    session_start();
							    if(isset($_SESSION['valid_user']) && isset($_SESSION['group'])){
							    	$group = $_SESSION['group'];
							    	if($group == "超级用户"){
							    		echo '<li><a href="UserRegister.php" target="view_frame"><i class="fa fa-angle-right leftNavIcon"></i>用户注册</a></li>';
							    	    echo '<li><a href="DeviceRegister.php" target="view_frame"><i class="fa fa-angle-right leftNavIcon"></i> 设备注册</a></li>';
							    	}
							    }	
							?>
							<li>
								<a href="RegisteredDevice.php" target="view_frame"><i class="fa fa-angle-right leftNavIcon"></i>设备查看</a>
							</li>
							<li>
								<a href="SystemInfo.php" target="view_frame"><i class="fa fa-angle-right leftNavIcon"></i>系统信息</a>
							</li>
							<li>
								<a href="../tplog/index.php/Home/Log/operaLog" target="view_frame"><i class="fa fa-angle-right leftNavIcon"></i>操作日志查询</a>
							</li>
							<li>
								<a href="../tplog/index.php/Home/Log/serverLog" target="view_frame"><i class="fa fa-angle-right leftNavIcon"></i>播放日志查询</a>
							</li>
						</ul>
					</li>

				</ul>
			</div>
		</div>
	</div>
</body>
</html>
