<?php
	session_start();
	$checked =json_decode($_POST['checked']['0']);
	for($i=0;$i<count($checked);$i++){
		$index=$checked[$i]->id;
		$_SESSION['checkboxs'][$index]=1;
	}

	$unchecked =json_decode($_POST['unchecked']['0']);
	for($i=0;$i<count($unchecked);$i++){
		$index=$unchecked[$i]->id;
		$_SESSION['checkboxs'][$index]=0;
	}

?>