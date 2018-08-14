<?php
    include_once("../Class/dbconn.class.php");

    class movieModel{
        public function syncPlayList($devid,$movieCount,$movieList){
            $conn=DBConn::getConn();
            $conn->query("set names utf-8");  
            // $res= $conn->query($sql);
            if(mysqli_connect_errno($conn))     
            { 
                echo "连接 MySQL 失败: " . mysqli_connect_error();
                return 0; 
            }else{ 
                    //删除旧的电影列表
                $sql="delete from submitedlist where deviceid='$devid';";
                $res= $conn->query($sql);
                
                for($i=0;$i<$movieCount;$i++){//插入最新下发的电影列表
                    $id=$movieList[$i]->id;
                    $file_name=$movieList[$i]->file_name;
                    $sql="insert into submitedlist (deviceid,file_name,id) values('$devid','$file_name','$id');"; 
                    $conn->query("set names utf8");
                    $res= $conn->query($sql);
                }
        
                if(mysqli_affected_rows($conn)<=0){
                    return 0;
                }
                else{
                    return 1;
                }
            }          
            
        }

        public function savePlayLog($data){
            return $data;
        }

        public function saveSubmitedList($devid,$deviceName,$movielist){
            $conn=DBConn::getConn();
            $conn->query("set names utf-8");  
            // $res= $conn->query($sql);
            if(mysqli_connect_errno($conn))     
            { 
                echo "连接 MySQL 失败: " . mysqli_connect_error();
                return 0; 
            }else{

                //删除旧的电影列表并将本地下载列表的列表名称置为空
                $deletesql="delete from submitedlist where deviceid='$devid' and down_status = 0;";
                $deleteres= $conn->query($deletesql);
                $clearsql="update submitedlist set list_name = '' where deviceid='$devid' and down_status = 1;";
                $clearres= $conn->query($clearsql);

                //保存操作日志
                $id = "SM".time();
                $time = date('Y-m-d H:i:s',time());
                $operaname = "下发列表: ".$movielist[0]->list_name." 到"." ".$deviceName;
                session_start();
                $username = $_SESSION['valid_user'];
                $logsql = "insert into server_opera_log values('$username','$id','$operaname','$time',0);";       
                $conn->query("set names utf8");
                $logres = $conn->query($logsql);
                if($logres==false){
                    return "操作日志保存失败"; 
                }
                
                for($i=0;$i<count($movielist);$i++){//插入最新下发的电影列表
                    $id=$movielist[$i]->id;
                    $list_name=$movielist[$i]->list_name;
                    $validSql = "select deviceid,id from submitedlist where deviceid='$devid' and id='$id' and down_status = 1;";
                    $conn->query("set names utf8");  
                    $validres = $conn->query($validSql);
                    if($validrow=mysqli_fetch_assoc($validres)){
                        $setsql="update submitedlist set list_name = '$list_name' where deviceid='$devid' and id='$id' and down_status = 1;";
                        $setres= $conn->query($setsql);
                    }else{
                        $file_name=$movielist[$i]->file_name;
                        $sql="insert into submitedlist (deviceid,file_name,id,list_name,down_status) values('$devid','$file_name','$id','$list_name',0);"; 
                        $conn->query("set names utf8");
                        $res= $conn->query($sql);
                    }
                }
        
                if(mysqli_affected_rows($conn)<=0){
                    return 0;
                }
                else{
                    return 1;
                }
            }          
        }

        public function saveDownLoadedSubmitedList($data){
            $conn=DBConn::getConn();
            $conn->query("set names utf8");  
            if(mysqli_connect_errno($conn))     
            { 
                echo "连接 MySQL 失败: " . mysqli_connect_error();
                return "失败"; 
            }else{

                //删除旧的电影列表
                $deviceid = $data->deviceid;
                $page = $data->page;
                $data_count = $data->data_count;
                $data_list = $data->data->data_list;
                if($page == "1"){//将已下载列表的数据清空，将已下发列表的下载状态全部置为0
                    $clearsql="delete from submitedlist where deviceid='$deviceid' and down_status = 1 and list_name is null;";
                    $clearres= $conn->query($clearsql);
                    $clearStatusSql = "update submitedlist set down_status = 0 where deviceid='$deviceid' and down_status = 1 and list_name is not null;";
                    $clearStatusres= $conn->query($clearStatusSql);
                }
                
                if($data_count > 0){
                    for($i=0;$i<count($data_list);$i++){//插入本地下载的电影列表
                        $id=$data_list[$i]->id;
                        $validSql = "select deviceid,id from submitedlist where deviceid='$deviceid' and id='$id' and down_status = 0;";
                        $conn->query("set names utf8");  
                        $validres = $conn->query($validSql);
                        if($validrow=mysqli_fetch_assoc($validres)){
                            $updateSql = "update submitedlist set down_status = 1 where deviceid='$deviceid' and id='$id';";
                            $res = $conn->query($updateSql);
                        }else{
                            $file_name=$data_list[$i]->file_name;
                            $list_name="";
                            $sql="insert into submitedlist(deviceid,file_name,id,list_name,down_status) values('$deviceid','$file_name','$id','$list_name',1);"; 
                            $conn->query("set names utf8");
                            $res= $conn->query($sql);
                        }
                    }
                }
            }          
        }

        public function getSubmitedList($devid){
            $conn=DBConn::getConn();        
            
            if(mysqli_connect_errno($conn))     
            { 
                echo "连接 MySQL 失败: " . mysqli_connect_error(); 
                return ;
            }else{ 
                $sql="select file_name,id,list_name,down_status from submitedlist where deviceid='$devid';";
                $conn->query("set names utf8");//注意语句位置，放在前面出错
                $res= $conn->query($sql);

                $movies=array();
                $i=0;
                while($row=mysqli_fetch_row($res)){
                    $movies[$i]=new stdClass();
                    $movies[$i]->file_name=$row[0];
                    $movies[$i]->id=$row[1];
                    $movies[$i]->list_name=$row[2];
                    $movies[$i]->down_status=$row[3];                      
                    $i++;
                }
                return $movies;  
            }          
          
        }

        public function saveMovieList($listName,$movies){         
            $conn=DBConn::getConn();
            if(mysqli_connect_errno($conn))     
            { 
                echo "连接 MySQL 失败: " . mysqli_connect_error(); 
            }else{          
                $sql="select count(*) from saved_movie_list where list_name='$listName';";//列表名称为主键
                $conn->query("set names utf8");  
                $res= $conn->query($sql);
                $row=mysqli_fetch_row($res);
                if($row['0']>0){
                    return "该名称的播放列表已存在";
                }
                $sql="select count(distinct(list_name)) from saved_movie_list;";//列表名称为主键
                $conn->query("set names utf8");  
                $res= $conn->query($sql);
                $row=mysqli_fetch_row($res);
                $listNum=$row['0']+1;

                if($listNum>=21){
                    return "最多保存20个列表";
                }else{
                    $create_time=time();
                    for($i=0;$i<count($movies);$i++){
                        $id=$movies[$i]['id'];
                        $file_name=$movies[$i]['file_name'];
                        $class=$movies[$i]['class'];
                        $valid=$movies[$i]['valid'];
                        $play_start=$movies[$i]['play_start'];
                        $play_end=$movies[$i]['play_end'];

                        $sql="insert into saved_movie_list values('$listName','$id','$file_name','$class','$valid','$play_start','$play_end','$create_time');";
                        $conn->query("set names utf8");  
                        $res= $conn->query($sql);
                    }

                    if(mysqli_affected_rows($conn)<=0){
                        return "保存失败"; 
                    }else{
                        //保存操作日志
                        if(isset($_SESSION['valid_user'])){
                            $id = "CM".time();
                            $time = date('Y-m-d H:i:s',time());
                            $operaname = "创建列表:"." ".$listName;
                            //session_start();
                            $username = $_SESSION['valid_user'];
                            $logsql = "insert into server_opera_log values('$username','$id','$operaname','$time',0);";       
                            $conn->query("set names utf8");
                            $logres = $conn->query($logsql);
                            if($logres==false){
                                return "操作日志保存失败"; 
                            }
                        }else{
                            return "登录信息已失效 请从新登录";
                        }
                        return "保存成功";
                    }
                }

            }
        }

        public function getSavedListByListName($listName){
            $conn=DBConn::getConn();
            if(mysqli_connect_errno($conn))     
            { 
                echo "连接 MySQL 失败: " . mysqli_connect_error(); 
            }else{
                $sql="select * from saved_movie_list where list_name='$listName';";
                $conn->query("set names utf8");  
                $res= $conn->query($sql);
                $i=0;
                $submitList= array();
                while($row=mysqli_fetch_row($res)){
                    $submitList[$i]=new stdClass();
                    $submitList[$i]->id=$row['1'];
                    $submitList[$i]->file_name=$row['2'];                 
                    $submitList[$i]->class=$row['3'];
                    $submitList[$i]->valid=$row['4'];
                    $submitList[$i]->play_start=$row['5'];
                    $i++;
                }
                return $submitList;
            }
        }

        public function getSavedMovieListNames(){
            $conn=DBConn::getConn();
            if(mysqli_connect_errno($conn))     
            { 
                echo "连接 MySQL 失败: " . mysqli_connect_error(); 
            }else{
                $sql="select distinct list_name,create_time from saved_movie_list;";
                $conn->query("set names utf8");  
                $res= $conn->query($sql);
                $i=0;
                $listNames= array();
                while($row=mysqli_fetch_row($res)){
                    $listNames[$i]['list_name']=$row['0'];
                    $listNames[$i]['create_time']=$row['1'];
                    $i++;
                }
                return $listNames;
            }
        }

        public function getMoviePath($listName){
            $conn=DBConn::getConn();
            if(mysqli_connect_errno($conn))     
            { 
                echo "连接 MySQL 失败: " . mysqli_connect_error(); 
            }else{
                $sql="select videolist.file_path,save_name from videolist,saved_movie_list where videolist.id=saved_movie_list.id and saved_movie_list.list_name='$listName'";
                $conn->query("set names utf8");  
                $res= $conn->query($sql);

                $i=0;
                $moviePaths= array();
                while($row=mysqli_fetch_row($res)){
                    $moviePaths[$i]=new stdClass();
                    $moviePaths[$i]->file_path=$row['0'];
                    $moviePaths[$i]->save_name=$row['1'];
                    $i++;
                }
                return $moviePaths;
            }
        }

        public function getDownloadInfo($listName){
            $conn=DBConn::getConn();
            if(mysqli_connect_errno($conn))     
            { 
                echo "连接 MySQL 失败: " . mysqli_connect_error(); 
            }else{
                $sql="select  from videolist,saved_movie_list where videolist.id=saved_movie_list.id and saved_movie_list.list_name='$listName'";
                $conn->query("set names utf8");  
                $res= $conn->query($sql);

                $i=0;
                $movieDownloadInfo= array();
                while($row=mysqli_fetch_row($res)){
                    $movieDownloadInfo[$i]=new stdClass();
                    $movieDownloadInfo[$i]->file_name=$row['0'];
                    $movieDownloadInfo[$i]->file_path=$row['1'];
                    $movieDownloadInfo[$i]->save_name=$row['2'];      
                    $movieDownloadInfo[$i]->size=$row['3'];
                    $i++;
                }
                return $movieDownloadInfo;
            }
        }

        public function deleteSavedMovieList($listName){
            $conn=DBConn::getConn();
            if(mysqli_connect_errno($conn))     
            { 
                echo "连接 MySQL 失败: " . mysqli_connect_error(); 
            }else{
                $sql="delete from saved_movie_list where list_name='$listName';";
                $conn->query("set names utf8");  
                $res= $conn->query($sql);

                if(mysqli_affected_rows($conn)<=0){
                    return "删除失败";
                }else{
                    //保存操作日志
                    $id = "DM".time();
                    $time = date('Y-m-d H:i:s',time());
                    $operaname = "删除列表:"." ".$listName;
                    session_start();
                    if(isset($_SESSION['valid_user'])){
                        $username = $_SESSION['valid_user'];
                        $logsql = "insert into server_opera_log values('$username','$id','$operaname','$time',0);";       
                        $conn->query("set names utf8");
                        $logres = $conn->query($logsql);
                        if($logres==false){
                            return "操作日志保存失败"; 
                        }
                    }else{
                        return "登录信息已失效";
                    }
                    return "删除成功";
                }
            }
        }

        public function updateSavedMovieList($oldName,$newName){
             $conn=DBConn::getConn();
            if(mysqli_connect_errno($conn))     
            { 
                echo "连接 MySQL 失败: " . mysqli_connect_error(); 
            }else{
                if($oldName==$newName){
                    return "修改成功";
                }
                $sql="select count(*) from saved_movie_list where list_name='$newName';";//列表名称为主键
                $conn->query("set names utf8");  
                $res= $conn->query($sql);
                $row=mysqli_fetch_row($res);
                if($row['0']>0){
                    return "该名称的播放列表已存在";
                }
                $sql="update saved_movie_list set list_name='$newName' where list_name='$oldName';";
                $conn->query("set names utf8");  
                $res= $conn->query($sql);

                if(mysqli_affected_rows($conn)<=0){
                    return "修改失败";
                }
                else{
                    //保存操作日志
                    $id = "UM".time();
                    $time = date('Y-m-d H:i:s',time());
                    $operaname = "修改列表: "." ".$oldName." "."为"." ".$newName;
                    session_start();
                    if(isset($_SESSION['valid_user'])){
                        $username = $_SESSION['valid_user'];
                        $logsql = "insert into server_opera_log values('$username','$id','$operaname','$time',0);";       
                        $conn->query("set names utf8");
                        $logres = $conn->query($logsql);
                        if($logres==false){
                            return "操作日志保存失败"; 
                        } 
                    }else{
                        return "登录信息已失效";
                    }
                    return "修改成功";
                }

            }
        }

        public function dumpMovieList($listName){
            $conn=DBConn::getConn();
            if(mysqli_connect_errno($conn))     
            { 
                echo "连接 MySQL 失败: " . mysqli_connect_error(); 
            }else{
                $sql="select v.id,v.file_name,v.file_path,v.save_name,v.size,v.time from mictic.mt_video as v inner join terminal.saved_movie_list as sml on v.id = sml.id where list_name='$listName';";
                $conn->query("set names utf8");               
                $res= $conn->query($sql);
                $i=0;
                $videoList= array();
                while($row=mysqli_fetch_row($res)){
                    $videoList[$i]["id"]=$row['0'];
                    $videoList[$i]["file_name"]=$row['1'];                 
                    $videoList[$i]["file_path"]=$row['2'];
                    $videoList[$i]["save_name"]=$row['3'];
                    $videoList[$i]["size"]=$row['4'];
                    $videoList[$i]["time"]=$row['5'];
                    $i++;
                }
                return $videoList;
            }
        }

        public function saveVideoList($videoList){//存储风霆迅url提供的下载和未下载的影片信息
            $conn=DBConn::getConn();
            if(mysqli_connect_errno($conn))     
            { 
                echo "连接 MySQL 失败: " . mysqli_connect_error(); 
            }else{ 
                $exist = 0;
                $name = "";
                for($i=0;$i<count($videoList);$i++){
                    $id = $videoList[$i]['id'];
                    $validSql = "select id from videolist where id = '$id';";
                    $conn->query("set names utf8");  
                    $validres = $conn->query($validSql);
                    if($validrow=mysqli_fetch_assoc($validres)){

                    }else{
                        $sql="insert into videolist (id,file_name,down_time,release_date,play_type,play_times,time,down_status,file_path,save_name,size) values('".$videoList[$i]['id']."','".addslashes($videoList[$i]['file_name'])
                         ."','".$videoList[$i]['down_time']."','".$videoList[$i]['release_date']."','".$videoList[$i]['play_type']
                         ."','".$videoList[$i]['play_times']."','".$videoList[$i]['time']."','".$videoList[$i]['down_status']."','".$videoList[$i]['file_path']."','".$videoList[$i]['save_name']."','".$videoList[$i]['size']."');"; 
                        $conn->query("set names utf8");  
                        $res = $conn->query($sql);
                        $name .= " ".$sql;
                        $exist++;
                    }          
                }
                
                $selectSql="select id from videolist;";
                $conn->query("set names utf8");               
                $res= $conn->query($selectSql);
                $i=0;
                $movieList= array();
                while($row=mysqli_fetch_row($res)){
                    $movieList[$i]["id"]=$row['0'];
                    $i++;
                }
                for($i=0;$i<count($movieList);$i++){
                    $id = $movieList[$i]['id'];
                    $validSql = "select v.id from mictic.mt_video as v where v.id = '$id' and v.status = 1 and v.class = 0 and v.down_status = 2;";
                    $conn->query("set names utf8");  
                    $validres = $conn->query($validSql);
                    if($validrow=mysqli_fetch_assoc($validres)){

                    }else{
                        $sql="delete from videolist where id = '$id';";
                        $conn->query("set names utf8");  
                        $res = $conn->query($sql);
                        $exist++;
                    }
                }
                if($exist == 0){
                    return "本地数据库为最新库";
                }else{
                    return "本地数据库更新成功";
                }
            }
        }

        public function getMovieTime($movieName){
            $conn=DBConn::getConn();
            if(mysqli_connect_errno($conn))     
            { 
                echo "连接 MySQL 失败: " . mysqli_connect_error(); 
            }else{
                $sql="select time from mictic.mt_video where file_name='$movieName';";
                $conn->query("set names utf8");  
                $res= $conn->query($sql);
               
                if($row=mysqli_fetch_assoc($res)){
                    return $row['time'];
                }else
                    return 0;
            }
        }

        public function getVideoList(){
            $conn=DBConn::getConn();
            if(mysqli_connect_errno($conn))     
            { 
                echo "连接 MySQL 失败: " . mysqli_connect_error(); 
            }else{
                $sql="select * from videolist order by id asc;";
                $conn->query("set names utf8");  
                $res= $conn->query($sql);
               
                $i=0;
                $videoList= array();
                while($row=mysqli_fetch_row($res)){
                    $videoList[$i]=new stdClass();
                    $videoList[$i]->id=$row['0'];
                    $videoList[$i]->file_name=$row['1'];                 
                    $videoList[$i]->down_time=$row['2'];
                    $videoList[$i]->release_date=$row['3'];
                    $videoList[$i]->play_type=$row['4'];
                    $videoList[$i]->play_times=$row['5'];
                    $videoList[$i]->time=$row['6'];
                    $videoList[$i]->down_status=$row['7'];
                    $i++;
                }
                return $videoList;
            }
        }
    }
   
?>