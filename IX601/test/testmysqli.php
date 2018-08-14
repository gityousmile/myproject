<?php 
    header("Content-Type:text/html; charset=utf-8");
	include("dbconn.class.php");
	$conn=DBConn::getConn();
            // $sql="TRUNCATE videolist;";
            $conn->query("set names utf-8");
            $devid="0040ca99a271";  
            // $res= $conn->query($sql);
            if(mysqli_connect_errno($conn))     
            { 
                echo "连接 MySQL 失败: " . mysqli_connect_error(); 
            }else{ 
               $sql="select file_name from submitedlist where deviceid='$devid';";
                $conn->query("set names utf8");//根据本地服务器的连接属性配置字符集  
                $res= $conn->query($sql);
                $movies=array();
                $i=0;
                while($row=mysqli_fetch_row($res)){
                    $movies[$i]=($row[0]);                     
                    $i++;
                }
                print_r($movies);
;            }
?>