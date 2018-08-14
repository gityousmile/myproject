<?php
 	header("Content-Type:text/html; charset=utf-8");
    require('../Model/MovieModel.php');
	switch($_GET['method']){
		case "submitList":
					$movieController=new MovieController();
					$movieController->submitList();
					break;

		case "submitSavedListByListName":
					$movieController=new MovieController();
					$movieController->submitSavedListByListName();
					break;

		case "getChecked":
					$movieController=new MovieController();
					$movieController->getChecked();
					break;

		case "saveList":
					$movieController=new MovieController();
					$movieController->saveList();
					break;

		case "getMovieList":
					$movieController=new MovieController();
					$movieController->getMovieList();
					break;

		case "getDownloadAndLoadingMovie":
					$movieController=new MovieController();
					$movieController->getDownloadAndLoadingMovie();
					break;

		case "saveMovieList":
					$movieController=new MovieController();
					$movieController->saveMovieList();
					break;

		case "getSavedMovieListNames":
					$movieController=new MovieController();
					$movieController->getSavedMovieListNames();
					break;

		case "getSavedListByUrlListName":
					$movieController=new MovieController();
					$movieController->getSavedListByUrlListName($_GET['listName']);
					break;

		case "deleteSavedMovieList":
					$movieController=new MovieController();
					$movieController->deleteSavedMovieList();
					break;

		case "updateSavedMovieList":
					$movieController=new MovieController();
					$movieController->updateSavedMovieList();
					break;

		case "dumpMovieList":
					$movieController=new MovieController();
					$movieController->dumpMovieList();
					break;

		case "dumpMovieListFalse":
					$movieController=new MovieController();
					$movieController->dumpMovieListFalse();
					break;

		case "getDownloadAndLoadingMovieByConditions":
					$movieController=new MovieController();
					$movieController->getDownloadAndLoadingMovieByConditions();
					break;

		case "getMovieTime"://从videolist中查询影片的时长
					$movieController=new MovieController();
					$movieController->getMovieTime();
					break;
						
		case "getCopyPercent"://获取导出影片的进度的百分比
					$movieController=new MovieController();
					$movieController->getCopyPercent();
					break;

		case "getExportMessage"://获取文件导出的具体信息
					$movieController=new MovieController();
					$movieController->getExportMessage();
					break;

		case "getVideoList":
					$movieController=new MovieController();
					$movieController->getVideoList();
					break;

		case "importVideo":
					$movieController=new MovieController();
					$movieController->importVideo();
					break;

		case "getMessageTest":
					$movieController=new MovieController();
					$movieController->getMessageTest();
					break;		
	}

	class MovieController{

		function getChecked(){
            $host = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
            $url_ftx="http://".$host;
			session_start();
			$checkedstr="";
			if(isset($_SESSION['checkboxs'])){
				foreach($_SESSION['checkboxs'] as $k=>$v){
					if($v==1){
						$checkedstr .= $k." ";
					}
				}
			}
			echo $checkedstr;
		}

		function getMovieList(){
			$dao = new MovieModel();
    		echo json_encode($dao->getSubmitedList($_GET['devid']));
		}

		function submitList(){
            $host = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
            //echo $host;
            $url_ftx="http://".$host;

		   	session_start(); 

	    	$curl = curl_init();
		    //设置抓取的url
		    //curl_setopt($curl, CURLOPT_URL, 'http://192.168.1.49/index.php/Home/Interface/index?class=HallUse&method=getVideoList&params=%7B%22down_status%22%3A%222%22%2C%22%22%3A%22%22%7Ds');
  			$url=$url_ftx."/index.php/Home/Interface/index?class=HallUse&method=getVideoList&params=%7B%22down_status%22%3A%222%22%2C%22%22%3A%22%22%7Ds";
			curl_setopt($curl, CURLOPT_URL,"$url");
		    //设置头文件的信息作为数据流输出
		    curl_setopt($curl, CURLOPT_HEADER, 0);
		    //设置获取的信息以文件流的形式返回，而不是直接输出。
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		    //执行命令
		    $data = curl_exec($curl);

		    $obj = json_decode($data,true);
		    //关闭URL请求
		    curl_close($curl);
		    //显示获得的数据
		    $count=$obj["data"]["count"];
		    $list=$obj["data"]["data_list"];
		    for($i=2;$i<=$count/15+1;$i++){
		        $curl = curl_init();
		        //curl_setopt($curl, CURLOPT_URL, 'http://192.168.1.49/index.php/Home/Interface/index?class=HallUse&method=getVideoList&params={"down_status":"2","page_size":"15","page":\"$i\"}');
				$url=$url_ftx."/index.php/Home/Interface/index?class=HallUse&method=getVideoList&params={\"down_status\":\"2\",\"page_size\":\"15\",\"page\":\"$i\"}";
       			curl_setopt($curl, CURLOPT_URL,"$url");
		        //设置头文件的信息作为数据流输出
		        curl_setopt($curl, CURLOPT_HEADER, 0);
		        //设置获取的信息以文件流的形式返回，而不是直接输出。
		        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		        $data = curl_exec($curl);
		        $obj = json_decode($data,true);
		        curl_close($curl);
		        $list2=$obj["data"]["data_list"];
		        $list=array_merge($list,$list2);
		    }


		 	$submitList=array();
		 	$index=0;//用于遍历原始列表
		 	$count=0;//用于给新列表计数
			foreach($_SESSION['checkboxs'] as $k=>$v){
			// 	if($_SESSION['checkboxs'][0])
			// 	$submitList
				if($v==1){
					$submitList[$count++]=$list[$index];
				} 
				$index++;
			}

			$submitList2=array();
			$movielist=array();

			for($i=0;$i<count($submitList);$i++){
				$submitList2[$i] = new stdClass();
				$movielist[$i] = new stdClass();
				$submitList2[$i]->id=$submitList[$i]["id"];
				$movielist[$i]->id=$submitList[$i]["id"];
				$submitList2[$i]->file_name=$submitList[$i]["file_name"];
				$submitList2[$i]->file_name=str_replace(' ','_',$submitList2[$i]->file_name);
				$movielist[$i]->file_name=$submitList[$i]["file_name"];

				$submitList2[$i]->class=$submitList[$i]["class"];
				$submitList2[$i]->valid="0";
				$submitList2[$i]->play_start="";
				$submitList2[$i]->play_end="";
			}
			if(count($submitList2)==0){
				echo "下发列表不能为空";
				return;
			}

			if(count($submitList2)>20){
				echo "下发列表不能超过20部";
				return;
			}
			// print_r($submitList2);
			$data=json_encode($submitList2);
			$devid=$_GET['devid'];
			// $ch = curl_init ();
	
			// $ip=$_GET['ip'];
			// $url='http://'.$ip.'/Home/Interface/index?class=IntellixlUse&method=SetPlayList&params={"deviceid":"'."$devid".'","data":{"count":"'.count($submitList).'","data_list":'.$data.'}}';
			// curl_setopt($ch , CURLOPT_URL,$url);
		 //    //设置头文件的信息作为数据流输出
		 //    curl_setopt($ch , CURLOPT_HEADER, 0);
		 //    //设置获取的信息以文件流的形式返回，而不是直接输出。
		 //    curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
			// $return = curl_exec($ch);
			// $ret=iconv("GB2312","UTF-8",$return);
			// curl_close ($ch);
			
			// if(substr($ret,17,-27)==8){//截取字符串子串，获取返回状态0为成功
			// 	echo "不在档期内";
			// }else if(substr($ret,17,-27)==0){
			$dao= new MovieModel();
			$dao->saveSubmitedList($devid,$movielist);
			// }
			// else if(substr($ret,17,-27)==7){
			// 	echo "磁盘已满";
			// }
			// else{
			// 	echo "下发有误请检查连接";
			// }			
			
			$_SESSION['checkboxs']=null;//清除提交列表中的内容

         	echo $data;
		}

		function submitSavedListByListName(){

			$devid=$_GET['devid'];//下发到的设备id
			$ip=$_GET['ip'];//下发到的设备ip
			$deviceId=$_GET['deviceId'];//存储播放列表的设备id
			$listName=$_GET['listName'];//电影列表id
			$deviceName = $_GET['deviceName'];
		  
			$dao= new MovieModel();
			$submitList=array();
			$submitList=$dao->getSavedListByListName($listName);
			
			$movielist=array();

			for($i=0;$i<count($submitList);$i++){
				$movielist[$i] = new stdClass();
				$movielist[$i]->file_name=$submitList[$i]->file_name;
				$submitList[$i]->file_name=str_replace(' ','_',$submitList[$i]->file_name);
				// $submitList[$i]->file_name=str_replace('W','w',$submitList[$i]->file_name);
				// echo $submitList[$i]->file_name;
				$movielist[$i]->id=$submitList[$i]->id;
				$movielist[$i]->list_name=$listName;
			}
			if(count($submitList)==0){
				echo "下发列表不能为空";
				return;
			}

			if(count($submitList)>20){
				echo "下发列表不能超过20部";
				return;
			}
			// print_r($submitList2);
			$data=json_encode($submitList);
			// $ch = curl_init ();
	
			// $url='http://'.$ip.'/Home/Interface/index?class=IntellixlUse&method=SetPlayList&params={"deviceid":"'."$devid".'","data":{"count":"'.count($submitList).'","data_list":'.$data.'}}';
			// curl_setopt($ch , CURLOPT_URL,$url);
		 //    //设置头文件的信息作为数据流输出
		 //    curl_setopt($ch , CURLOPT_HEADER, 0);
		 //    //设置获取的信息以文件流的形式返回，而不是直接输出。
		 //    curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
			// $return = curl_exec($ch);
			// $ret=iconv("GB2312","UTF-8",$return);
			// curl_close ($ch);
			// //echo $ret;
			// if(substr($ret,17,-27)==8){//截取字符串子串，获取返回状态0为成功
			// 	echo "不在档期内";
			// }else if(substr($ret,17,-27)==0){
				$dao= new MovieModel();
				$dao->saveSubmitedList($devid,$deviceName,$movielist);
				// echo count($submitList)."部电影已下发至终端";
			//}
			// else if(substr($ret,17,-27)==7){
			// 	echo "磁盘已满";
			// }
			// else{
			// 	echo "下发有误请检查连接";
			// }			
   //       	return 1;
			echo $data;//返回播放列表内容到前端重组为websocket请求
		}

		function saveList(){
            $host = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
                         //echo $host;
                         $url_ftx="http://".$host;

			$curl = curl_init();
		    //设置抓取的url
		    //curl_setopt($curl, CURLOPT_URL, 'http://192.168.1.49/index.php/Home/Interface/index?class=HallUse&method=getVideoList&params=%7B%22down_status%22%3A%222%22%2C%22%22%3A%22%22%7Ds');
    		$url=$url_ftx."/index.php/Home/Interface/index?class=HallUse&method=getVideoList&params=%7B%22down_status%22%3A%222%22%2C%22%22%3A%22%22%7Ds";
			curl_setopt($curl, CURLOPT_URL,"$url");
		    //设置头文件的信息作为数据流输出
		    curl_setopt($curl, CURLOPT_HEADER, 0);
		    //设置获取的信息以文件流的形式返回，而不是直接输出。
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		    //执行命令
		    $data = curl_exec($curl);

		    $obj = json_decode($data,true);
		    //关闭URL请求
		    curl_close($curl);
		    //显示获得的数据
		    $count=$obj["data"]["count"];
		    $list=$obj["data"]["data_list"];
		    for($i=2;$i<=$count/15+1;$i++){
		        $curl = curl_init();
		        //curl_setopt($curl, CURLOPT_URL, 'http://192.168.1.49/index.php/Home/Interface/index?class=HallUse&method=getVideoList&params={"down_status":"2","page_size":"15","page":\"$i\"}');
				$url=$url_ftx."/index.php/Home/Interface/index?class=HallUse&method=getVideoList&params={\"down_status\":\"2\",\"page_size\":\"15\",\"page\":\"$i\"}";
       			curl_setopt($curl, CURLOPT_URL,"$url");
		        //设置头文件的信息作为数据流输出
		        curl_setopt($curl, CURLOPT_HEADER, 0);
		        //设置获取的信息以文件流的形式返回，而不是直接输出。
		        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		        $data = curl_exec($curl);
		        $obj = json_decode($data,true);
		        curl_close($curl);
		        $list2=$obj["data"]["data_list"];
		        $list=array_merge($list,$list2);
		    }
			$dao = new MovieModel();
    		echo $dao->saveVideoList($list);
		}

		function getDownloadAndLoadingMovie(){
            $host = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
            
            $url_ftx="http://".$host;
			$curl = curl_init();//获取已下载的电影
		    //设置抓取的url
		    //curl_setopt($curl, CURLOPT_URL, 'http://192.168.1.49/index.php/Home/Interface/index?class=HallUse&method=getVideoList&params={"down_status":"2"}');
			$url=$url_ftx."/index.php/Home/Interface/index?class=HallUse&method=getVideoList&params={\"down_status\":\"2\"}";
       		curl_setopt($curl, CURLOPT_URL,"$url");
		    //设置头文件的信息作为数据流输出
		    curl_setopt($curl, CURLOPT_HEADER, 0);
		    //设置获取的信息以文件流的形式返回，而不是直接输出。
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		    //执行命令
		    $data = curl_exec($curl);

		    $obj = json_decode($data,true);
		    //关闭URL请求
		    curl_close($curl);
		    //显示获得的数据
		    $count=$obj["data"]["count"];
		    $loadedList=$obj["data"]["data_list"];
		    for($i=2;$i<=$count/15+1;$i++){
			        $curl = curl_init();
			       // curl_setopt($curl, CURLOPT_URL, 'http://192.168.1.49/index.php/Home/Interface/index?class=HallUse&method=getVideoList&params={"down_status":"2","page_size":"15","page":\"$i\"}');
					$url=$url_ftx."/index.php/Home/Interface/index?class=HallUse&method=getVideoList&params={\"down_status\":\"2\",\"page_size\":\"15\",\"page\":\"$i\"}";
       				curl_setopt($curl, CURLOPT_URL,"$url");
			        //设置头文件的信息作为数据流输出
			        curl_setopt($curl, CURLOPT_HEADER, 0);
			        //设置获取的信息以文件流的形式返回，而不是直接输出。
			        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			        $data = curl_exec($curl);
			        $obj = json_decode($data,true);
			        curl_close($curl);
			        $tmpList=$obj["data"]["data_list"];
			        $loadedList=array_merge($loadedList,$tmpList);
			}

			$curl = curl_init();//获取正在下载的电影
		    //设置抓取的url
		  	//  curl_setopt($curl, CURLOPT_URL, 'http://192.168.1.49/index.php/Home/Interface/index?class=HallUse&method=getVideoList&params={"down_status":"1"}');
			$url=$url_ftx."/index.php/Home/Interface/index?class=HallUse&method=getVideoList&params={\"down_status\":\"1\"}";
       		curl_setopt($curl, CURLOPT_URL,"$url");
		    //设置头文件的信息作为数据流输出
		    curl_setopt($curl, CURLOPT_HEADER, 0);
		    //设置获取的信息以文件流的形式返回，而不是直接输出。
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		    //执行命令
		    $data = curl_exec($curl);

		    $obj = json_decode($data,true);
		    //关闭URL请求
		    curl_close($curl);
		    //显示获得的数据
		    $count=$obj["data"]["count"];
		    $loadingList=$obj["data"]["data_list"];
		    for($i=2;$i<=$count/15+1;$i++){
			        $curl = curl_init();
			        //curl_setopt($curl, CURLOPT_URL, 'http://192.168.1.49/index.php/Home/Interface/index?class=HallUse&method=getVideoList&params={"down_status":"2","page_size":"15","page":\"$i\"}');
					$url=$url_ftx."/index.php/Home/Interface/index?class=HallUse&method=getVideoList&params={\"down_status\":\"1\",\"page_size\":\"15\",\"page\":\"$i\"}";
      				curl_setopt($curl, CURLOPT_URL,"$url");
			        //设置头文件的信息作为数据流输出
			        curl_setopt($curl, CURLOPT_HEADER, 0);
			        //设置获取的信息以文件流的形式返回，而不是直接输出。
			        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			        $data = curl_exec($curl);
			        $obj = json_decode($data,true);
			        curl_close($curl);
			        $tmpList=$obj["data"]["data_list"];
			        $loadingList=array_merge($loadingList,$tmpList);
			}

			$list=array_merge($loadingList,$loadedList);
			$dao = new MovieModel();
			echo $dao->saveVideoList($list);
			// echo json_encode($list);
		}	


		function saveMovieList(){
			error_reporting(E_ALL ^ E_DEPRECATED);
			$dao = new MovieModel();
			$listName=$_GET['listName'];
			session_start(); 
            $list=array();

		    $conn=mysql_connect("127.0.0.1","root","123456");          
		    if(!$conn)     
		    { 
		        echo "连接 MySQL 失败"; 
		    }else{
		    	$movies = array();
		    	$i = 0;
		    	foreach($_SESSION['checkboxs'] as $k=>$v){
					if($v==1){
						mysql_select_db("mictic",$conn);
				        mysql_query("set names utf8");
				        $sql = "select id,file_name,class from mt_video where status = 1 and class = 0 and down_status = 2 and id = '$k'";  
				        $res=mysql_query($sql,$conn);
				        
				        while($row=mysql_fetch_row($res)){
				            $movies[$i]['id'] = $row[0];
				            $movies[$i]['file_name'] = $row[1];
				            $movies[$i]['class'] = $row[2];
				            $movies[$i]['valid'] = "0";
				            $movies[$i]['play_start'] = "1970-01-01";
				            $movies[$i]['play_end'] = "1970-01-01";
				            $i++;
				        }
					} 
				}

				if(count($movies)==0){
					echo "列表不能为空";
					return;
				}

				if(count($movies)>20){
					echo "下发列表不能超过20部";
					return;
				}

		        $checkboxs=array();
			    $_SESSION['checkboxs']=$checkboxs;
	    		echo $dao->saveMovieList($listName,$movies);
		    }
		}

		function getSavedListByListName($listName){
			$dao = new MovieModel();
    		echo json_encode($dao->getSavedListByListName($listName));
		}

		function getSavedListByUrlListName($listName){//url中含中文进行解码时需要配合URl解码解析出中文内容
			$dao = new MovieModel();
			$listName=urldecode($listName);
			$listName=str_replace("'",'',$listName);//去除参数中带的引号
    		echo json_encode($dao->getSavedListByListName($listName));
		}

		function getSavedMovieListNames(){
			$dao = new MovieModel();
    		echo json_encode($dao->getSavedMovieListNames());
		}

		function deleteSavedMovieList(){
			$dao = new MovieModel();
			$listName=$_GET['listName'];
			echo $dao->deleteSavedMovieList($listName);
		}

		function updateSavedMovieList(){
			$dao = new MovieModel();
    		echo $dao->updateSavedMovieList($_GET['oldName'],$_GET['newName']);
		}

		//将文件拷贝到USB中的伪方法
		function dumpMovieListFalse(){
			$ls = "ls /usb";
            $return = shell_exec($ls);
			if($return != null){
				$listName=$_GET['listName'];
			    $dao = new MovieModel();
	    		$videoList = $dao->dumpMovieList($listName);
	    		$length = count($videoList);
	            $serverPath = "/data/micro_ticket/dst";
	            $usbPath = "/usb";
	            $cpFilePath = '';
	            $usbDir = '';
	            $fileSize = 0;
	            $fileStatus = 0;
	            for($i=0;$i<$length;$i++){
	                $serverFilePath = $serverPath.$videoList[$i]["file_path"].$videoList[$i]["save_name"];
	                $usbDir = $usbPath.$serverPath.$videoList[$i]["file_path"];
	                $usbFilePath = $usbDir.$videoList[$i]["save_name"];
	                if(is_dir($usbDir)){
	                	if(file_exists($usbFilePath)){
	                		//echo "文件已存在";
	                		if(filesize($usbFilePath) < filesize($serverFilePath)){
	                			$cpFilePath .= "cp"." ".$serverFilePath." ".$usbDir."&&";
	                			$fileSize += filesize($serverFilePath);
	                			$fileStatus +=1;
	                		}
	                	}else{
	                		//echo "文件不存在";
	                		$cpFilePath .= "cp"." ".$serverFilePath." ".$usbDir."&&";
	                		$fileSize += filesize($serverFilePath);
	                		$fileStatus +=1;
	                	}
	                }else{
	                	//第三个参数是“true”表示能创建多级目录，iconv防止中文目录乱码
						mkdir(iconv("UTF-8", "GBK", $usbDir),0777,true);
						if(file_exists($usbFilePath)){
							//echo "文件已存在";
	                	}else{
	                		//echo "文件不存在";
	                		$cpFilePath .= "cp"." ".$serverFilePath." ".$usbDir."&&";
	                		$fileSize += filesize($serverFilePath);
	                		$fileStatus +=1;
	                	}
	                }
	            }
	            $copyShell = rtrim($cpFilePath,"&&");
	            //echo $copyShell;
	            $countSizeStr = shell_exec("df /usb");          //利用shell命令计算剩余的硬盘容量
	            $movieController=new MovieController();
	            $str = $movieController->merge_spaces($countSizeStr);
	            $sizeArr = explode(" ",$str);  
	            $countSize = $sizeArr[9];
	            $fileTotalSize = $fileSize/1024;

	            if($countSize < $fileTotalSize){
	            	echo "硬盘内存不足";
	            }else{
	            	if($fileStatus > 0){
            			$shell = "ps -ef | grep cp";
					    $return = shell_exec($shell);
					    if(strstr($return, $copyShell)){
					   	    echo "正在导出 请耐心等待";
					    }else{
					   	    echo "影片开始导出";
					    }
	            		//shell_exec($copyShell);
	            	}else{
	            		echo "影片已存在";
	            	}
	            }
			}else{
				echo "硬盘不存在 请插入硬盘";
			}
		}

		//将文件拷贝到USB中,真实拷贝
		function dumpMovieList(){
			$ls = "ls /usb";
            $return = shell_exec($ls);
			if($return != null){
				$listName=$_GET['listName'];
			    $dao = new MovieModel();
	    		$videoList = $dao->dumpMovieList($listName);
	    		$length = count($videoList);
	    		$usbListName = $listName.".txt";
	    		$usbListPath = "/usb/data/list/";
	    		$usbListFile = $usbListPath.$usbListName;
	    		if(is_dir($usbListPath)){
	    			if(file_exists($usbListFile)){
	    				
		        	}else{
		        		$top = "id"."  "."file_name"."  "."file_path"."  "."save_name"."  "."size"."  "."time\n";
		    			$file = fopen($usbListFile,'w');
		    			fwrite($file,$top);
		        		for($i=0;$i<$length;$i++){
		        			$list = $videoList[$i]["id"]."  ".$videoList[$i]["file_name"]."  ".$videoList[$i]["file_path"]."  ".$videoList[$i]["save_name"]."  ".$videoList[$i]["size"]."  ".$videoList[$i]["time"]."\n";
		        		    fwrite($file,$list);
		        		}
	                    fclose($file);
	                    shell_exec("sync");
		        	}
	    		}else{
	    			mkdir(iconv("UTF-8", "GBK", $usbListPath),0777,true);
	    			$top = "id"."  "."file_name"."  "."file_path"."  "."save_name"."  "."size"."  "."time\n";
	    			$file = fopen($usbListFile,'w');
	    			fwrite($file,$top);
	    			for($i=0;$i<$length;$i++){
	        			$list = $videoList[$i]["id"]."  ".$videoList[$i]["file_name"]."  ".$videoList[$i]["file_path"]."  ".$videoList[$i]["save_name"]."  ".$videoList[$i]["size"]."  ".$videoList[$i]["time"]."\n";
	        		    fwrite($file,$list);
	        		}
                    fclose($file);
                    shell_exec("sync");
	    		}
	            $serverPath = "/data/micro_ticket/dst";
	            $usbPath = "/usb";
	            $cpFilePath = '';
	            $usbDir = '';
	            $fileSize = 0;
	            $fileStatus = 0;
	            for($i=0;$i<$length;$i++){
	                $serverFilePath = $serverPath.$videoList[$i]["file_path"].$videoList[$i]["save_name"];
	                $usbDir = $usbPath.$serverPath.$videoList[$i]["file_path"];
	                $usbFilePath = $usbDir.$videoList[$i]["save_name"];
	                if(is_dir($usbDir)){
	                	if(file_exists($usbFilePath)){
	                		//echo "文件已存在";
	                		if(filesize($usbFilePath) < filesize($serverFilePath)){
	                			$cpFilePath .= "cp"." ".$serverFilePath." ".$usbDir."&&";
	                			$fileSize += filesize($serverFilePath);
	                			$fileStatus +=1;
	                		}
	                	}else{
	                		//echo "文件不存在";
	                		$cpFilePath .= "cp"." ".$serverFilePath." ".$usbDir."&&";
	                		$fileSize += filesize($serverFilePath);
	                		$fileStatus +=1;
	                	}
	                }else{
	                	//第三个参数是“true”表示能创建多级目录，iconv防止中文目录乱码
						mkdir(iconv("UTF-8", "GBK", $usbDir),0777,true);
						shell_exec("sync");
						if(file_exists($usbFilePath)){
							//echo "文件已存在";
	                	}else{
	                		//echo "文件不存在";
	                		$cpFilePath .= "cp"." ".$serverFilePath." ".$usbDir."&&";
	                		$fileSize += filesize($serverFilePath);
	                		$fileStatus +=1;
	                	}
	                }
	            }
	            $copyShell = $cpFilePath."sync";
	            //echo $copyShell;
	            $countSizeStr = shell_exec("df /usb");          //利用shell命令计算剩余的硬盘容量
	            $movieController=new MovieController();
	            $str = $movieController->merge_spaces($countSizeStr);
	            $sizeArr = explode(" ",$str);  
	            $countSize = $sizeArr[9];
	            $fileTotalSize = $fileSize/1024;

	            if($countSize < $fileTotalSize){
	            	echo "硬盘内存不足";
	            }else{
	            	if($fileStatus > 0){
	            		echo "影片开始导出";
	            		shell_exec($copyShell);
	            	}else{
	            		echo "影片已存在";
	            	}
	            }
			}else{
				echo "硬盘不存在 请插入硬盘";
			}
		}

        //将字符串中多个空格转化为一个
		function merge_spaces($string){
		    return preg_replace("/\s(?=\s)/","\\1",$string);
		}

		function getExportMessage(){
			$listName=$_GET['listName'];
		    $dao = new MovieModel();
		    $videoList = $dao->dumpMovieList($listName);
		    $ExportMessage = array();
		    $ExportMessage["listname"] = $listName;
		    $ExportMessage["videoNum"] = count($videoList)."部";
            
		    $serverPath = "/data/micro_ticket/dst";
            $usbPath = "/usb";
            $cpFilePath = '';
            $usbDir = '';
		    $totalSize = 0;
		    $currentFileSize = 0;
		    $exportNum = 0;
		    for($i=0;$i<count($videoList);$i++){
		    	$totalSize += $videoList[$i]["size"];

		    	$serverFilePath = $serverPath.$videoList[$i]["file_path"].$videoList[$i]["save_name"];
                $usbDir = $usbPath.$serverPath.$videoList[$i]["file_path"];
                $usbFilePath = $usbDir.$videoList[$i]["save_name"];

		    	if(is_dir($usbDir)){
		    		if(file_exists($usbFilePath)){
		    			$exportNum += 1;
		    			$currentFileSize += filesize($usbFilePath);
		    		}else{

		    		}
		    	}else{

		    	}
		    }

		    $ls = "ls /usb";
            $return = shell_exec($ls);
            if($return != null){
            	$ExportMessage["exportPersent"] = $exportNum."/".count($videoList);
            	$ExportMessage["currentFileSize"] = sprintf("%.1f",$currentFileSize/(1024*1024*1024))."G";
            }else{
            	$ExportMessage["exportPersent"] = "硬盘不存在";
            	$ExportMessage["currentFileSize"] = "0.0G";
            }

		    $ExportMessage["totalSize"] = "共".sprintf("%.1f",$totalSize/(1024*1024*1024))."G";

		    echo json_encode($ExportMessage);

		}

		function getCopyPercent(){
			$listName=$_GET['listName'];
		    $dao = new MovieModel();
    		$videoList = $dao->dumpMovieList($listName);
    		$length = count($videoList);
            $fileDir = "/usb/data/micro_ticket/dst";
            $totalSize = 0;
            $copySize = 0;
    		for($i=0;$i<$length;$i++){
    			$usbFilePath = $fileDir.$videoList[$i]["file_path"].$videoList[$i]["save_name"];
    			$totalSize += $videoList[$i]["size"];
    			if(file_exists($usbFilePath)){
    				$copySize += filesize($usbFilePath);
    			}else{
    				
    			}
    		}
    		//echo $copySize;
    		//echo $totalSize;
    		$ls = "ls /usb";
            $return = shell_exec($ls);
            if($return != null){
            	$copyPersent = sprintf("%.2f",$copySize/$totalSize)*100;
            }else{
            	$copyPersent = 0;
            }
    		echo $copyPersent;
		}

		function getDownloadAndLoadingMovieByConditions(){
                $host = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
                        // echo $host;
                         $url_ftx="http://".$host;

                $video_year=$_GET["video_year"];
                $video_type=$_GET["video_type"];
                $keywords=$_GET["keywords"];
                $url1="";
                $url2="";
                $url3="";
                $url4="";
                $url0="\"down_status\":\"2\",";
                $url5="\"down_status\":\"1\",";

                //$url="http://192.168.1.49/index.php/Home/Interface/index?class=HallUse&method=getVideoList&params={ ";
                $url=$url_ftx."/index.php/Home/Interface/index?class=HallUse&method=getVideoList&params={ ";
                if($keywords!="NULL")
                {
                    $url1="\"keywords\":\"$keywords\",";
                }

                if($video_type!="NULL")
               {
                  $url2="\"video_type\":\"$video_type\",";
               }


                if($video_year!="NULL")
                {
                   $url3="\"video_year\":\"$video_year\",";
                }

                $url4="$url"."$url0"."$url1"."$url2"."$url3"."\"\":\"\"}";

                $i=2;


			$curl = curl_init();//获取已下载的电影
		    //设置抓取的url
		    //curl_setopt($curl, CURLOPT_URL, 'http://192.168.1.49/Home/Interface/index?class=HallUse&method=getVideoList&params={"down_status":"2"}');


		  	curl_setopt($curl, CURLOPT_URL, "$url4");
		    //设置头文件的信息作为数据流输出
		    curl_setopt($curl, CURLOPT_HEADER, 0);
		    //设置获取的信息以文件流的形式返回，而不是直接输出。
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		    //执行命令
		    $data = curl_exec($curl);

		    $obj = json_decode($data,true);
		    //关闭URL请求
		    curl_close($curl);
		    //显示获得的数据
		    $count=$obj["data"]["count"];
		    $loadedList=$obj["data"]["data_list"];
		    for($i=2;$i<=$count/15+1;$i++){
			        $curl = curl_init();
                                $url4="$url"."$url0"."$url1"."$url2"."$url3"."\"page_size\":\"15\",\"page\":"."\"$i\"}";

			       // curl_setopt($curl, CURLOPT_URL, 'http://192.168.1.49/Home/Interface/index?class=HallUse&method=getVideoList&params={"down_status":"2","page_size":"15","page":\"$i\"}');
                                curl_setopt($curl, CURLOPT_URL,"$url4");
			        //设置头文件的信息作为数据流输出
			        curl_setopt($curl, CURLOPT_HEADER, 0);
			        //设置获取的信息以文件流的形式返回，而不是直接输出。
			        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			        $data = curl_exec($curl);
			        $obj = json_decode($data,true);
			        curl_close($curl);
			        $tmpList=$obj["data"]["data_list"];
			        $loadedList=array_merge($loadedList,$tmpList);
			}
                        $url4="$url"."$url5"."$url1"."$url2"."$url3"."\"\":\"\"}";

			$curl = curl_init();//获取正在下载的电影
		    //设置抓取的url
		   // curl_setopt($curl, CURLOPT_URL, 'http://192.168.1.49/Home/Interface/index?class=HallUse&method=getVideoList&params={"down_status":"1"}');
                   curl_setopt($curl, CURLOPT_URL, "$url4");
		    //设置头文件的信息作为数据流输出
		    curl_setopt($curl, CURLOPT_HEADER, 0);
		    //设置获取的信息以文件流的形式返回，而不是直接输出。
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		    //执行命令
		    $data = curl_exec($curl);

		    $obj = json_decode($data,true);
		    //关闭URL请求
		    curl_close($curl);
		    //显示获得的数据
		    $count=$obj["data"]["count"];
		    $loadingList=$obj["data"]["data_list"];
		    for($i=2;$i<=$count/15+1;$i++){
			        $curl = curl_init();
                                 $url4="$url"."$url5"."$url1"."$url2"."$url3"."\"page_size\":\"15\",\"page\":"."\"$i\"}";

			        //curl_setopt($curl, CURLOPT_URL, 'http://192.168.1.49/Home/Interface/index?class=HallUse&method=getVideoList&params={"down_status":"1","page_size":"15","page":\"$i\"}');
                                 curl_setopt($curl, CURLOPT_URL,"$url4");
			        //设置头文件的信息作为数据流输出
			        curl_setopt($curl, CURLOPT_HEADER, 0);
			        //设置获取的信息以文件流的形式返回，而不是直接输出。
			        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			        $data = curl_exec($curl);
			        $obj = json_decode($data,true);
			        curl_close($curl);
			        $tmpList=$obj["data"]["data_list"];
			        $loadingList=array_merge($loadingList,$tmpList);
			}

			$list=array_merge($loadingList,$loadedList);
			echo json_encode($list);
		}	

		function getMovieTime(){
			$movieName=$_GET['movie'];
			$dao = new MovieModel();
			echo $dao->getMovieTime($movieName);
		}

		function getVideoList(){
			$dao = new MovieModel();
			echo json_encode($dao->getVideoList());
		}

		function importVideo(){
			$ls = "ls /usb";
            $return = shell_exec($ls);
            $usbPath = "";
            $serverPath = "";
			if($return != null){
				// $arr_file = array();
				// $usbFiles = $this->tree($arr_file, "/usb/data/micro_ticket/dst/");
				// $serverFiles = $this->tree($arr_file, "/data/micro_ticket/dst/");
				// for($i=0;$i<count($usbFiles);$i++){
				// 	for($j=0;$j<count($serverFiles);$j++){
				// 		if($usbFiles[$i] == $serverFiles[$j]){

				// 		}else{
				// 			 $usbPath .= " "."/usb/data/micro_ticket/dst".$usbFiles[$i];
				// 			 $sub = strpos($serverFiles[$j], "/");
				// 			 $serverPath = "/data/micro_ticket/dst";
				// 		}
				// 	}
				// }
				$shell = "ps -ef | grep cp";
			    $return = shell_exec($shell);
			    $copyShell = "cp -drnu /usb/data/micro_ticket/dst/";
			    if(strstr($return, $copyShell)){
			   	    echo "正在导出 请耐心等待";
			    }else{
			   	    shell_exec("cp -drnu /usb/data/micro_ticket/dst/* /data/micro_ticket/dst/");
			   	    if(strstr($return, $copyShell)){
			   	    	echo "导入成功";
			   	    }else{
			   	    	echo "影片不存在";
			   	    }
			    }
			}else{
				echo "硬盘不存在 请插入硬盘";
			}
		}

		function tree(&$arr_file, $directory, $dir_name=''){
		    $mydir = dir($directory);
		    while($file = $mydir->read())
		    {
		        if((is_dir("$directory/$file")) AND ($file != ".") AND ($file != ".."))
		        {
		            $this->tree($arr_file, "$directory/$file", "$dir_name/$file");
		        }
		        else if(($file != ".") AND ($file != ".."))
		        {
		            $arr_file[] = "$dir_name/$file";
		        }
		    }
		    $mydir->close();
		    return $arr_file;
		}

		function getMessageTest(){
			$listName = $_GET['listname'];
			$dao = new MovieModel();
			var_dump($dao->dumpMovieList($listName));
		}
	}
?>