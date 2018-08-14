<?php
 	header("Content-Type:text/html; charset=utf-8");
 	require('../Model/MovieModel.php');
	switch($_GET['method']){
		case "getCopyPercent":
					$fileController=new FileController();
					$fileController->getCopyPercent();
					break;
	}
	class FileController{
		function getCopyPercent(){
			$listName=$_GET['listName'];
			// $dao=new MovieModel();
			// $moviePaths=$dao->getMoviePath($_GET['listName']);
			// $copyPercent=0;
			// $srcFile="";
			// $distFile="";
			// $srcSize=0;
			// $distSize=0;
			// foreach($moviePaths as $path){
			// 	$srcFile="/data/micro_ticket/dst".$path->file_path.$path->save_name;
			// 	$distFile="/usb/data/micro_ticket/dst".$path->file_path.$path->save_name;	
			// 	$srcSize+=file_exists($srcFile)?filesize($srcFile):0;
			// 	$distSize+=file_exists($distFile)?filesize($distFile):0;			
			// }
			$srcFile = "/data/html/micro/remote/downloads/ddd/";
			//$distFile = "/data/html/micro/remote/video/";
			//$copyPercent=getDirSize($srcFile)/getDirSize($distFile);
			$du = "du -sh $srcFile";
			shell_exec($du);
			echo $listName;
		}

		function CalcDirectorySize($DirectoryPath) {
		  // I reccomend using a normalize_path function here
		  // to make sure $DirectoryPath contains an ending slash
		  // To display a good looking size you can use a readable_filesize
		  // function.
		  $Size = 0;
		  $Dir = opendir($DirectoryPath);
		  if (!$Dir)
		    return -1;
		  while (($File = readdir($Dir)) !== false) {
		    // Skip file pointers
		    if ($File[0] == '.') continue; 
		    // Go recursive down, or add the file size
		    if (is_dir($DirectoryPath . $File))      
		      $Size += CalcDirectorySize($DirectoryPath . $File . DIRECTORY_SEPARATOR);
		    else 
		      $Size += filesize($DirectoryPath . $File);    
		  }
		  closedir($Dir);
		  return $Size;
		}
	}
?>