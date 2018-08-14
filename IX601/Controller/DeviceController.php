<?php
 	header("Content-Type:text/html; charset=utf-8");
    require('../Model/DeviceModel.php');

	switch($_GET['method']){
		case "getDevices":
					$deviceController=new DeviceController();
					$deviceController->getDevices();
					break;

		case "getRegisteredDevices":
					$deviceController=new DeviceController();
					$deviceController->getRegisteredDevices();
					break;

		case "getOnlineDevices":
					$deviceController=new DeviceController();
					$deviceController->getOnlineDevices();
					break;

		case "getDevicesNum":
					$deviceController=new DeviceController();
					$deviceController->getDevicesNum();
					break;

		case "registerDevice":
					$deviceController=new DeviceController();
					$deviceController->registerDevice();
					break;

		case "deleteRegisteredDevice":
					$deviceController=new DeviceController();
					$deviceController->deleteRegisteredDevice();
					break;

		case "updateRegisteredDevice":
					$deviceController=new DeviceController();
					$deviceController->updateRegisteredDevice();
					break;

		case "postOrder":
					$deviceController=new DeviceController();
					$deviceController->postOrder();
					break;

		case "getDeviceStatus":
					$deviceController=new DeviceController();
					$deviceController->getDeviceStatus();
					break;

		case "getGroup":
					$deviceController=new DeviceController();
					$deviceController->getGroup();
					break;

		case "addGroup":
					$deviceController=new DeviceController();
					$deviceController->addGroup();
					break;

		case "deleterGroup":
					$deviceController=new DeviceController();
					$deviceController->deleterGroup();
					break;

		case "selectdevice":
					$deviceController=new DeviceController();
					$deviceController->selectdevice();
					break;

		case "getDeviceMessage":
					$deviceController=new DeviceController();
					$deviceController->getDeviceMessage();
					break;

		case "getServerInfo":
					$deviceController=new DeviceController();
					$deviceController->getServerInfo();
					break;

		case "updateCinemaName":
					$deviceController=new DeviceController();
					$deviceController->updateCinemaName();
					break;

		case "updateYunIp":
					$deviceController=new DeviceController();
					$deviceController->updateYunIp();
					break;

		case "deviceSearch":
					$deviceController=new DeviceController();
					$deviceController->deviceSearch();
					break;

		case "testMessage":
					$deviceController=new DeviceController();
					$deviceController->testMessage();
					break;	

	}

	class DeviceController{
		function getDevices(){
			$deviceModel=new DeviceModel();	
			echo json_encode($deviceModel->getDevices());
		}

		function getRegisteredDevices(){
			$deviceModel=new DeviceModel();	
			echo json_encode($deviceModel->getRegisteredDevices());
		}

		function getOnlineDevices(){
			$deviceId = $_GET['deviceId'];
			$deviceModel=new DeviceModel();	
			echo $deviceModel->getOnlineDevices($deviceId);
		}

		function getDevicesNum(){
			$deviceModel=new DeviceModel();	
			echo json_encode($deviceModel->getDevicesNum());
		}

		function registerDevice(){
			$deviceModel=new DeviceModel();
			$id = $_POST['id'];
			$name = $_POST['name'];
			$group_name = $_POST['group_name'];
			echo json_encode($deviceModel->registerDevice($id,$name,$group_name));
		}

		function deleteRegisteredDevice(){
			$deviceModel=new DeviceModel();
			echo $deviceModel->deleteRegisteredDevice($_GET['deviceId'],$_GET['deviceName']);	
		}

		function updateRegisteredDevice(){
			$deviceModel=new DeviceModel();
			echo $deviceModel->updateRegisteredDevice($_GET['deviceId'],$_GET['deviceOldName'],$_GET['alias']);
		}

		function postOrder(){
			$devid = $_GET['devid'];
			$id = $_GET['id'];
			$file_name = $_GET['file_name'];
			$ip = $_GET['ip'];
		    $ch = curl_init();
			//设置抓取的url
			if($_GET['flag']=='play'){
				$url='http://'.$ip.'/Home/Interface/index?class=IntellixlUse&method=SetPlayFilm&params={"deviceid":"'.$devid.'","id":"'.$id.'","file_name":"'.$file_name.'","class":"0","data":{}}';
			}else{
				$url='http://'.$ip.'/Home/Interface/index?class=IntellixlUse&method=SetStopFilm&params={"deviceid":"'.$devid.'","data":{}}';
			}
			curl_setopt($ch , CURLOPT_URL,$url);
			//设置头文件的信息作为数据流输出
			curl_setopt($ch , CURLOPT_HEADER, 0);
			//设置获取的信息以文件流的形式返回，而不是直接输出。
			curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
			$return = curl_exec($ch);
			// echo iconv("GB2312","UTF-8",$return);//收到GB2312编码转换成UTF-8
			$ret=iconv("GB2312","UTF-8",$return);
			// echo $ret;
			if(substr($ret,17,-27)==8){//截取字符串子串，获取返回状态0为成功
				echo "不在档期内";
			}else if(substr($ret,17,-27)==0){
				echo "操作成功";
			}else if(substr($ret,17,-27)==7){
				echo "磁盘已满";
			}else{
				echo "下发有误请检查连接";
			}	
			curl_close ($ch);
		}

		function getDeviceStatus(){
			$devid=$_GET['devid'];
			$deviceModel=new DeviceModel();	
			echo json_encode($deviceModel->getDeviceStatus($devid));
		}

		function getGroup(){
			$deviceModel=new DeviceModel();	
			echo json_encode($deviceModel->getGroup());
		}

		function addGroup(){
		    $group_name = $_POST['group_name'];
			$deviceModel=new DeviceModel();	
			echo $deviceModel->addGroup($group_name);
		}

		function deleterGroup(){
			$groupName = json_decode($_POST['groupName']['0']);
			$deviceModel=new DeviceModel();
            echo $deviceModel->deleterGroup($groupName);
		}

		function selectdevice(){
			$group_name = $_POST['group_name'];
			$deviceCode = $_POST['deviceCode'];
			$deviceModel=new DeviceModel();
            echo json_encode($deviceModel->selectdevice($group_name,$deviceCode));
		}

		function getServerInfo(){
			$deviceModel=new DeviceModel();
			echo json_encode($deviceModel->getServerInfo());
		}

		function updateCinemaName(){
			$ciname_name = $_POST['cinema_name'];
			$deviceModel=new DeviceModel();
			echo $deviceModel->updateCinemaName($ciname_name);
		}

		function updateYunIp(){
			$yun_ip = $_POST['yun_ip'];
			$deviceModel=new DeviceModel();
			echo $deviceModel->updateYunIp($yun_ip);
		}

		function getDeviceMessage(){
			$deviceModel=new DeviceModel();
			$deviceModel->SendServerLog();
		}

		function deviceSearch(){
			$deviceCode=$_POST['deviceCode'];
			$deviceModel=new DeviceModel();	
			echo json_encode($deviceModel->deviceSearch($deviceCode));
		}

		function testMessage(){
			$deviceModel=new DeviceModel();
			echo $deviceModel->validGroup();
		}

	}
?>