<?php
 	header("Content-Type:text/html; charset=utf-8");
 	switch($_GET['method']){
 		case "GetServerIP":
 			$serverInfoManager=new ServerInfoManager();
 			$serverInfoManager->getServerIP();
 			break;
 	}
 	class ServerInfoManager{
 			function getServerIP(){
			echo $_SERVER['SERVER_ADDR'];
			// echo shell_exec("sudo ifconfig eth0 | grep 'inet addr' | awk '{ print $2}' | awk -F: '{print $2}'");//获取ip
		}	
	}	
?>