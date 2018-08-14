<?php
	include("../Class/dbconn.class.php");
	class UserModel{
		function checkLogin($username,$password){
			$conn=DBConn::getConn();
			if(mysqli_connect_errno($conn)) 	
			{ 
    			echo "连接 MySQL 失败: " . mysqli_connect_error(); 
			}else{
				$password = md5($password);
				$sql="select username,group_name from administrator where username ='$username' and password = '$password';";
				$conn->query("set names utf8");//根据本地服务器的连接属性配置字符集  
				$res= $conn->query($sql);

                if(mysqli_affected_rows($conn)<=0){
                    return 0;
                }else{
                	$login=new stdClass();
	                while($row=mysqli_fetch_row($res)){
	                    $login->username=$row['0'];
	                    $login->group=$row['1'];
					}
					return $login;
                }
			}
		}
			
		function register($username,$password,$group){
			$conn=DBConn::getConn();
			if(mysqli_connect_errno($conn)) 	
			{ 
    			echo "连接 MySQL 失败: " . mysqli_connect_error(); 
			}else{
				$password = md5($password);
				$sql="insert into administrator values('$username','$password','$group');";
				$conn->query("set names utf8");//根据本地服务器的连接属性配置字符集  
				$res= $conn->query($sql);
		
				if(mysqli_affected_rows($conn)<=0){
                    return 0;
                }
                else{
                    return 1;
                }
			}
		}

		function modifyPassword($valid_user,$oldPwd,$newPwd){
			$conn=DBConn::getConn();
			if(mysqli_connect_errno($conn)) 	
			{ 
    			echo "连接 MySQL 失败: " . mysqli_connect_error(); 
			}else{
				$oldPwd = md5($oldPwd);
				$sql="select * from administrator where username = '$valid_user' and password = '$oldPwd';";
				$conn->query("set names utf8");//根据本地服务器的连接属性配置字符集  
				$res= $conn->query($sql);
		
				if(mysqli_affected_rows($conn)<=0){
                    return "旧密码不正确";
                }else{
                	$newPwd = md5($newPwd);
                	$updateSql = "update administrator set password = '$newPwd' where username = '$valid_user';";
                    $updateres= $conn->query($updateSql);
                    if(mysqli_affected_rows($conn)<=0){
	                    return "新密码修改错误";
	                }else{
	                	return "新密码修改成功";
	                }
                }
                $conn->close();
			}
		} 
	}
?>