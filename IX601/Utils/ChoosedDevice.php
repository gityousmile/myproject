<?php
	session_start();
	if($_GET['method']=="get")
		echo $_SESSION['deviceIndex'];
	else if($_GET['method']=="save"){
		$_SESSION['deviceIndex']=$_GET['deviceIndex'];
	}	
?>