<?php
	include("../Model/UserModel.php");
	switch($_POST['operation']){
		case 'register':			
			$username=$_POST["user"];
			$password=$_POST["password"];
			$group=$_POST["group"];
			$userModel=new UserModel();		
			echo $userModel->register($username,$password,$group);
			break;

		case 'login':			
			$username=$_POST["user"];
			$password=$_POST["password"];
			$userModel=new UserModel();
			$login=$userModel->checkLogin($username,$password);
			session_start();
			$_SESSION['valid_user']=$login->username;
			$_SESSION['group']=$login->group;
			echo $login->username;
			break;

		case 'logout':
			session_start();   
			unset($_SESSION['valid_user']);  
			session_destroy(); 
			echo "注销成功";
			break;

		case 'getCurUser':
			session_start();   
			if(isset($_SESSION['valid_user'])){
				echo $_SESSION['valid_user'];
			}else{
				echo 0;
			}
			break;

		case 'modifyPassword':
			session_start();   
			if(isset($_SESSION['valid_user'])){
				$valid_user = $_SESSION['valid_user'];
				$oldPwd = $_POST['oldPwd'];
				$newPwd = $_POST['newPwd'];
				$userModel=new UserModel();
				echo $userModel->modifyPassword($valid_user,$oldPwd,$newPwd);
				break;
			}else{
				echo "登录用户信息已失效";
			}
			break;
	}
?>