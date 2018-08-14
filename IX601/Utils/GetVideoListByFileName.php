<?php
    error_reporting(E_ALL ^ E_DEPRECATED);

    $fileName=$_GET["fileName"];

    $conn=mysql_connect("127.0.0.1","root","123456");          
    if(!$conn)     
    { 
        echo "连接 MySQL 失败"; 
    }else{
        mysql_select_db("mictic",$conn);
        mysql_query("set names utf8");
        $sql = "select size,play_type,face_pic,file_name,time,uptime,direct,starring,score,language,film_type,release_date,country,drama_cn,file_path from mt_video where file_name like '$fileName' and status = 1 and class = 0 and down_status = 2";  
        $res=mysql_query($sql,$conn);
        
        $movies = array();
        $i = 0;
        while($row=mysql_fetch_row($res)){
            $movies[$i]['size'] = $row[0];
            $movies[$i]['play_type'] = $row[1];
            $movies[$i]['pic'] = $row[2];
            $movies[$i]['file_name'] = $row[3];
            $movies[$i]['time'] = $row[4];
            $movies[$i]['uptime'] = $row[5];
            $movies[$i]['direct'] = $row[6];
            $movies[$i]['starring'] = $row[7];
            $movies[$i]['score'] = $row[8];
            $movies[$i]['language'] = $row[9];
            $movies[$i]['film_type'] = $row[10];
            $movies[$i]['release_date'] = $row[11];
            $movies[$i]['country'] = $row[12];
            $movies[$i]['drama_cn'] = $row[13];
            $movies[$i]['file_path'] = $row[14];
            $i++;
        }
        echo json_encode($movies);
    }


?>