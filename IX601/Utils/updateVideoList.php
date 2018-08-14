<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    require('../Model/MovieModel.php');
    $conn=mysql_connect("127.0.0.1","root","123456"); 
    $movies = array();         
    if(!$conn)     
    { 
        echo "连接 MySQL 失败"; 
    }else{
        mysql_select_db("mictic",$conn);
        mysql_query("set names utf8");
        $sql = "select id,file_name,down_time,release_date,play_type,play_times,time,down_status,file_path,save_name,size from mt_video where status = 1 and class = 0 and down_status = 2";  
        $res=mysql_query($sql,$conn);
        
        $i = 0;
        while($row=mysql_fetch_row($res)){
            $movies[$i]['id'] = $row[0];
            $movies[$i]['file_name'] = $row[1];
            $movies[$i]['down_time'] = $row[2];
            $movies[$i]['release_date'] = $row[3];
            $movies[$i]['play_type'] = $row[4];
            $movies[$i]['play_times'] = $row[5];
            $movies[$i]['time'] = $row[6];
            $movies[$i]['down_status'] = $row[7];
            $movies[$i]['file_path'] = $row[8];
            $movies[$i]['save_name'] = $row[9];
            $movies[$i]['size'] = $row[10];
            $i++;
        }
    }
    $Model = new MovieModel();
    echo $Model->saveVideoList($movies);
?>