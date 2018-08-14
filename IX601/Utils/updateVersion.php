<?php
include("../Class/dbconn.class.php");
switch($_GET['method']){
	case 'varlidVersion':			
		$updateVersion = new updateVersion();
		$updateVersion->varlidVersion();
		break;

	case 'validUpdatePower':			
		$updateVersion = new updateVersion();
		$updateVersion->validUpdatePower();
		break;

	case 'startUpdateVersion':			
		$updateVersion = new updateVersion();
		$updateVersion->startUpdateVersion();
		break;

	case 'getUpdatePercent':			
		$updateVersion = new updateVersion();
		$updateVersion->getUpdatePercent();
		break;

	case 'updateVersionData':			
		$updateVersion = new updateVersion();
		$updateVersion->updateVersionData();
		break;

	case 'getVersionMessage':			
		$updateVersion = new updateVersion();
		$updateVersion->getVersionMessage();
		break;


}
class updateVersion{

	function varlidVersion(){
		$curl = curl_init();
		$source_ftp_file_ini = 'ftp://upgrade.intellix.com.cn/IX601/upgrade.ini'; //完整路径

		curl_setopt($curl, CURLOPT_URL, $source_ftp_file_ini);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_VERBOSE, 1);
		curl_setopt($curl, CURLOPT_FTP_USE_EPSV, 0);
		curl_setopt($curl, CURLOPT_TIMEOUT, 300); // times out after 300s
		curl_setopt($curl, CURLOPT_USERPWD, "root:upgrade"); //FTP用户名：密码// Sets up the output file
		$local_path = '/root';
		if (is_dir($local_path)) {
		    $outfile = fopen($local_path.'/upgrade.ini','w+');
		    curl_setopt($curl, CURLOPT_FILE, $outfile);
		    $info = curl_exec($curl);
		    fclose($outfile);
		    $error_no = curl_errno($curl);
		    curl_close($curl);

		    $updateVersion = new updateVersion();
		    $newVersion = $updateVersion->getNewVersion();
		    $oldVersion = $updateVersion->getOldVersion();
            
		    if($oldVersion != "查询失败"){
		    	if($newVersion > $oldVersion){
		    		if(file_exists("/root/remote.tar.gz")){
		    			echo "正在更新系统";
		    		}else{
		    			echo "当前版本<span>".$oldVersion."</span>将升级到<span>".$newVersion."</span>";
		    		}
		    	}else{
		    		echo "当前版本为最新版本";
		    	}
		    }else{
		    	echo "版本信息获取失败";
		    }
		}
	}

	function getNewVersion(){
		$local_path = '/root';
		$readfile = fopen($local_path.'/upgrade.ini','r');
	    $updateVersion = new updateVersion();
		$upgradeSize = $updateVersion->remote_filesize("upgrade.intellix.com.cn/IX601/upgrade.ini", "root", "upgrade");
	    $upgradeStr = fread($readfile,(int)$upgradeSize);//指定读取大小，这里把整个文件内容读取出来
	    $startIndex = strpos($upgradeStr, "remote_");
	    $endIndex = strpos($upgradeStr, "[mac]");
	    $newVersion = substr($upgradeStr, $startIndex+7,$endIndex-$startIndex-9);
	    return $newVersion;
	}

	function getVersionMessage(){
		$local_path = '/root';
		$readfile = fopen($local_path.'/upgrade.ini','r');
	    $updateVersion = new updateVersion();
		$upgradeSize = $updateVersion->remote_filesize("upgrade.intellix.com.cn/IX601/upgrade.ini", "root", "upgrade");
	    $upgradeStr = fread($readfile,(int)$upgradeSize);//指定读取大小，这里把整个文件内容读取出来
	    $startIndex = strpos($upgradeStr, "[mac]");
	    $endIndex = strpos($upgradeStr, "@");
	    $versionMessage = substr($upgradeStr, $startIndex+7,$endIndex-$startIndex-9);
	    return $versionMessage;
	}

	function startUpdateVersion(){
    	if(file_exists("/root/remote.tar.gz")){
	    	shell_exec("rm /root/remote.tar.gz");
	    }
	    shell_exec("cd /root;wget ftp://upgrade.intellix.com.cn/IX601/remote.tar.gz --ftp-user=root --ftp-password=upgrade");
	}

	function validUpdatePower(){
		$updateVersion = new updateVersion();
		$versionMessage = $updateVersion->getVersionMessage();
        $mac = $updateVersion->getMac();
        if(strstr($versionMessage,$mac)){
        	echo 1;
        }else{
        	echo 0;
        }
	}

	function getMac(){
		$MacReturn = shell_exec("/sbin/ifconfig eth0");
        $index = strpos($MacReturn,"HWaddr ");
        $mac = str_replace(":", "", substr($MacReturn,$index+7,17));
        return $mac;
	}

	function updateSh(){
		$curl = curl_init();
		$source_ftp_file = 'ftp://upgrade.intellix.com.cn/IX601/update.sh'; //完整路径

		curl_setopt($curl, CURLOPT_URL, $source_ftp_file);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_VERBOSE, 1);
		curl_setopt($curl, CURLOPT_FTP_USE_EPSV, 0);
		curl_setopt($curl, CURLOPT_TIMEOUT, 300); // times out after 300s
		curl_setopt($curl, CURLOPT_USERPWD, "root:upgrade"); //FTP用户名：密码// Sets up the output file
		$local_path = '/root';
        
		if (is_dir($local_path)) {
		    $outfile = fopen($local_path.'/update.sh','w+');
		    $status = curl_setopt($curl, CURLOPT_FILE, $outfile);
		    $info = curl_exec($curl);
		    fclose($outfile);
		    $error_no = curl_errno($curl);
		    curl_close($curl);
		}
	}

	function getUpdatePercent(){
		$filePath = "/root/remote.tar.gz";
		if(file_exists($filePath)){
			$localFile = filesize($filePath);
			$updateVersion = new updateVersion();
			$ftpFile = $updateVersion->remote_filesize("upgrade.intellix.com.cn/IX601/remote.tar.gz", "root", "upgrade");
			echo round($localFile/$ftpFile ,2)*100;

		}
	}

	function getOldVersion(){
		$conn=DBConn::getConn();
		if(mysqli_connect_errno($conn)) 	
		{ 
			echo "连接 MySQL 失败: " . mysqli_connect_error(); 
		}else{
			$sql="select version_id from server_info;";
			$conn->query("set names utf8");//根据本地服务器的连接属性配置字符集  
			$res= $conn->query($sql);

            if(mysqli_affected_rows($conn)<=0){
                return "查询失败";
            }else{
            	$oldVersion="";
                while($row=mysqli_fetch_row($res)){
                    $oldVersion=$row['0'];
				}
				return $oldVersion;
            }
		}
	}

	// 获取远程文件大小函数
	function remote_filesize($url, $user, $pw){
		// 快速获取远程文件大小
		// http 文件
        // $url = 'http://bbs.csdn.net/topics/360076220';
		// ftp 文件
		// $username = 'xxxx';//ftp帐号
		// $password = 'xxxx';//ftp密码
		// $url = 'xxx.xxx.xxx/xx.xxx'; //ftp服务器地址+文件路径+文件名例如： ftp.t35.com/down.zip
		$ftp_server = "ftp://" . $user . ":" . $pw . "@" . $url;
		$ch = curl_init();
		// curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_URL, $ftp_server);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_NOBODY, 1);
		$output = curl_exec($ch);
		curl_close($ch);
		preg_match('#Content-Length: (\d+)#i', $output, $arr);
		if (isset($arr[1])) {
		    return $arr[1];
		} else {
		    return 'error';
		}

	}

	function updateVersionData(){

		$updateVersion = new updateVersion();
		$newVersion = $updateVersion->getNewVersion();

		$conn=DBConn::getConn();
		if(mysqli_connect_errno($conn)) 	
		{ 
			echo "连接 MySQL 失败: " . mysqli_connect_error(); 
		}else{
			$sql="update server_info set version_id = '$newVersion';";
			$conn->query("set names utf8");//根据本地服务器的连接属性配置字符集  
			$res= $conn->query($sql);

            if(mysqli_affected_rows($conn)<=0){
                echo 0;
            }else{
            	$updateVersion = new updateVersion();
                $updateVersion->updateSh();
            	if(file_exists("/root/update.sh")){
            		shell_exec("cd /root;chmod -R 777 update.sh;./update.sh");
            		echo 1;
            	}else{
            		echo 0;
            	}
            }
		}
	}


}
?>