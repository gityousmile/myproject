<?php
 	header("Content-Type:text/html; charset=utf-8");
 	include("../Model/DeviceModel.php");
 	include("../Model/MovieModel.php");

 	switch($_GET['method']){
 		case "SendHeartBeat":
 			$terminalController=new TerminalController();
 			$terminalController->getHeartBeat();
 			break;

 		case "SyncPlayList":
 			$terminalController=new TerminalController();
 			$terminalController->syncPlayList();
 			break;

 		case "ShutDown":
 			$terminalController=new TerminalController();
 			$terminalController->shutDown();
 			break;

 	}

 	class TerminalController{
	 	function getHeartBeat(){
		    $ch = curl_init();

			//设置抓取的url
			$sucResp=array();
			$sucResp=new stdClass();
			$sucResp->res="0";
			$sucResp->msg="成功";
			$sucResp->data="";

			$erResp=array();
			$erResp = new stdClass();
			$erResp->res="1";
			$erResp->msg="失败";
			$erResp->data="";

			
			$data=json_decode($_GET["params"])->data;
			$deviceid=json_decode($_GET["params"])->deviceid;
			$ip=json_decode($_GET["params"])->ip;
			$version=json_decode($_GET["params"])->version;
			$type=json_decode($_GET["params"])->type;
			$system_time=json_decode($_GET["params"])->system_time;
			$total_harddisk=json_decode($_GET["params"])->total_harddisk;
			$left_harddisk=json_decode($_GET["params"])->left_harddisk;
			$net=json_decode($_GET["params"])->net;
			$count=json_decode($_GET["params"])->film_count;
			$status=json_decode($_GET["params"])->status;
			$item=json_decode($_GET["params"])->item;
			$valid_time=json_decode($_GET["params"])->valid_time;

			// if($item!=""){
			// 	// var_dump($item);
			// 	// echo $item->file_name;
			// 	// $deviceModel->saveCurmovie($item->file_name);
			// }

			// if($data->count!='0'){
			// 	// $data_list=$data->data_list;
			// 	// $film=$data_list[0];
			// 	// var_dump($film);
			// }
			// var_dump($data);
			// echo $film->file_name;

			$deviceModel = new DeviceModel();

			$device = new Device($deviceid,$ip,$version,$type,$total_harddisk,$left_harddisk,$system_time,1,$status,$item->file_name,$item->curr_pos,$item->id,$valid_time->valid_start,$valid_time->valid_end,$net,$count);

			if($deviceModel->saveDevice($device)==1){
				echo json_encode($sucResp);
			}else{
				echo json_encode($erResp);
			}
		}

		function syncPlayList(){
			$ch = curl_init();

			//设置抓取的url
			$sucResp=array();
			$sucResp=new stdClass();
			$sucResp->res="0";
			$sucResp->msg="成功";
			$sucResp->data="";

			$erResp=array();
			$erResp = new stdClass();
			$erResp->res="1";
			$erResp->msg="失败";
			$erResp->data="";

			$data=json_decode($_GET["params"])->data;
			$deviceid=json_decode($_GET["params"])->deviceid;			

			$movieModel = new MovieModel();
			
			if($movieModel->syncPlayList($deviceid,$data->count,$data->data_list)==1){
				echo json_encode($sucResp);
			}else{
				echo json_encode($erResp);
			}
		}

		function shutDown(){
			$sucResp=array();
			$sucResp=new stdClass();
			$sucResp->res="0";
			$sucResp->msg="成功";
			$sucResp->data="";

			$erResp=array();
			$erResp = new stdClass();
			$erResp->res="1";
			$erResp->msg="失败";
			$erResp->data="";

			echo json_encode($sucResp);
			// shell_exec("sudo shutdown -r now");//重启
			shell_exec("/sbin/shutdown -h now");//关机
		}	

	
	}

?>