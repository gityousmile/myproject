<?php
    error_reporting(E_ALL ^ E_DEPRECATED);

    $video_year=$_GET["video_year"]."%";
    $video_type="%,".$_GET["video_type"].",%";
    $keywords="%".$_GET["keywords"]."%";
    $down_start=$_GET['down_start'];
    $down_end=$_GET['down_end'];

    $conn=mysql_connect("127.0.0.1","root","123456");          
    if(!$conn)     
    { 
        echo "连接 MySQL 失败"; 
    }else{
        mysql_select_db("mictic",$conn);
        mysql_query("set names utf8");
        $sql = "select id,file_name,down_time,release_date,play_type,time,size from mt_video where release_date like '$video_year' and file_name like '$keywords' and status = 1 and class = 0 and down_status = 2";  
        if($_GET["video_type"] != ""){
            $sql .= " and concat(',',film_type,',') like '".$video_type."'";
        }
        if($down_start!=""){
            $down_start = $down_start." 00:00:00";
            $sql .= " and down_time >= "."unix_timestamp('$down_start')";
        }
        if($down_end!=""){
            $down_end = $down_end." 23:59:59";
            $sql .= " and down_time <= "."unix_timestamp('$down_end')";
        }
        $res=mysql_query($sql,$conn);
        
        $movies = array();
        $i = 0;
        while($row=mysql_fetch_row($res)){
            $movies[$i]['id'] = $row[0];
            $movies[$i]['file_name'] = $row[1];
            $movies[$i]['down_time'] = $row[2];
            $movies[$i]['release_date'] = $row[3];
            $movies[$i]['play_type'] = $row[4];
            $movies[$i]['time'] = $row[5];
            $movies[$i]['size'] = $row[6];
            $i++;
        }
        echo json_encode($movies);
    }


?>