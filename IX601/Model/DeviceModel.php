<?php
    include("../Class/dbconn.class.php");
    include("../Class/Device.class.php");
    include('../Class/OnlineDevice.class.php');

    class DeviceModel{

        public function saveDevice($device){
            $conn=DBConn::getConn();
            
            if(mysqli_connect_errno($conn))     
            { 
                echo "连接 MySQL 失败: " . mysqli_connect_error(); 
            }else{        
                $deviceid=$device->deviceid;
                $ip=$device->ip;
                $version=$device->version;
                $type=$device->type;
                $total_size=$device->total_size;
                $left_size=$device->left_size;
                $system_time=$device->system_time;
                $online=$device->online;
                $status=$device->status;
                $curmovie=$device->curmovie;
                $curr_pos=$device->curr_pos;
                $curid=$device->curid;
                $valid_start=$device->valid_start;
                $valid_end=$device->valid_end;
                $net=$device->net;
                $count=$device->count;

                $record_time=date("Y-m-d H:i:s");//注意apache上存在时钟偏差，nginx上不用加后面的时间偏移

                $sql="select deviceid from devicetab where deviceid ='$deviceid' ";//查询是否存在设备上线记录
                $conn->query("set names utf8");  
                $res= $conn->query($sql);

                if($row=mysqli_fetch_assoc($res)){// 非首次上线时只是更新状态           
                    $curId=$row['deviceid'];
                    $sql = "update devicetab set online=1,record_time='$record_time',ip='$ip',version='$version',type='$type',total_size='$total_size',left_size='$left_size',status='$status',system_time='$system_time',curmovie='$curmovie',curr_pos='$curr_pos',curid='$curid',valid_start='$valid_start',valid_end='$valid_end',net='$net',count='$count' where deviceid='$curId';";
                }else{//首次创建时在数据库中添加一条记录
                    $sql = "insert into devicetab values('$deviceid','$ip','$version','$type','$total_size','$left_size','$system_time','$online','$status','$record_time','$curmovie','$curr_pos','$curid','$valid_start','$valid_end','$net','$count');";                    
                }
                $conn->query("set names utf8");  
                $res= $conn->query($sql);
                if(mysqli_affected_rows($conn)<=0)
                    return 0;
            }       
            return 1;
        }

        public function registerDevice($id,$name,$group_name){
            $conn=DBConn::getConn();
            
            if(mysqli_connect_errno($conn))     
            { 
                echo "连接 MySQL 失败: " . mysqli_connect_error(); 
            }else{
                $deviceid=$id;
                $alias=$name;
                $regis_time=date("Y-m-d H:i:s");
                $sql="insert into registered_device values('$deviceid','$alias','$regis_time',0,'$group_name')";
                $conn->query("set names utf8");  
                $res= $conn->query($sql);

                if($res==false){
                    return 0;
                }
                else{
                    //保存操作日志
                    $id = "CD".time();
                    $time = date('Y-m-d H:i:s',time());
                    $operaname = "创建设备:"." ".$alias;
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
                        return "登录身份已失效";
                    }
                    return 1;
                }
            } 
            
        }

        function addGroup($group_name){
            $conn=DBConn::getConn();
            
            if(mysqli_connect_errno($conn))     
            { 
                echo "连接 MySQL 失败: " . mysqli_connect_error(); 
            }else{
                $selectSql="select group_name from device_group where group_name = '$group_name'";
                $conn->query("set names utf8");  
                $selectres = $conn->query($selectSql);
                if($selectrow=mysqli_fetch_assoc($selectres)){
                    return "组别已存在";
                }

                $regis_time=date("Y-m-d H:i:s");
                $sql="insert into device_group(group_name) values('$group_name')";
                $conn->query("set names utf8");  
                $res= $conn->query($sql);

                if($res == false){
                    return "组别保存失败";
                }
                else{
                    //保存操作日志
                    $id = "CG".time();
                    $time = date('Y-m-d H:i:s',time());
                    $operaname = "创建组别:"." ".$group_name;
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
                        return "登录身份已失效";
                    }
                    
                    return "组别保存成功";
                }
            } 
        }

        function deleterGroup($groupName){
            $conn=DBConn::getConn();
            if(mysqli_connect_errno($conn))     
            { 
                echo "连接 MySQL 失败: " . mysqli_connect_error(); 
            }else{
                for($i=0;$i<count($groupName);$i++){
                    $regis_time=date("Y-m-d H:i:s");
                    $group_name = $groupName[$i]->deleteGroup;
                    $sql="delete from device_group where group_name = '$group_name'";
                    $conn->query("set names utf8");  
                    $res= $conn->query($sql);
                }

                if(mysqli_affected_rows($conn)<=0){
                    return "组别删除失败";
                }else{
                    //保存操作日志
                    $id = "DG".time();
                    $time = date('Y-m-d H:i:s',time());
                    $group_name = "";
                    for($i=0;$i<count($groupName);$i++){
                        $group_name .= " ".$groupName[$i]->deleteGroup;
                    }
                    $operaname = "删除组别:".$group_name;
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
                        return "登录身份已失效";
                    }
                    return "组别删除成功";
                }
            }
        }

        public function savePlayLog($data){

            $conn=mysql_connect("127.0.0.1","root","123456");
            if(!$conn){
                echo "连接失败";
            }
            mysql_select_db("terminal",$conn);
            mysql_query("set names utf8");

            $deviceid = $data->deviceid;
            $id = $data->id;
            $file_name = $data->file_name;
            $play_start = $data->play_start;
            $play_end = $data->play_end;
            $mode = $data->mode;

            $videosql="select play_type from mictic.mt_video where id='$id';";
            $res=mysql_query($videosql,$conn);
            $time="";
            $play_type="";
            $video_type="";
            $username = "";
            $device_name = "";
            while($row=mysql_fetch_row($res)){
                $play_type=$row[0];
            }
            if($play_type="1"){
                $video_type="2D";
            }else{
                $video_type="3D";
            }
            $time = strtotime($play_end)-strtotime($play_start);
            $video_time=round($time/3600)."小时".round(($time%3600)/60)."分".(($time%3600)%60)."秒";
            if($mode==1){
                $username = "远程用户";
            }else{
                $username = "终端用户";
            }

            $deviceSql="select alias from registered_device where deviceid = '$deviceid'";  
            $deviceRes=mysql_query($deviceSql,$conn);
            while($deviceRow=mysql_fetch_row($deviceRes)){
                $device_name = $deviceRow[0];
            }

            $sql="insert into terminal_play_log(deviceid,id,file_name,play_start,play_end,time,username,video_type,device_name,upload_status) values('$deviceid','$id','$file_name','$play_start','$play_end','$video_time','$username','$video_type','$device_name',0)";  
            $res=mysql_query($sql,$conn);

            if($res==false){
                return "播放日志保存失败"; 
            }

            mysql_close($conn);

        }

        public function getDevices(){
            $conn=DBConn::getConn();
            
            if(mysqli_connect_errno($conn))     
            { 
                echo "连接 MySQL 失败: " . mysqli_connect_error(); 
            }else{
                $sql="select devicetab.deviceid,ip,version,type,total_size,left_size,system_time,online,status,curmovie,curr_pos,alias,group_name from devicetab,registered_device where devicetab.deviceid=registered_device.deviceid and";
                $deviceModel = new DeviceModel();
                $sql .= $deviceModel->validGroup();
                $conn->query("set names utf8");  
                $res=$conn->query($sql);
                $devices=array();
                $i=0;
                while($row=mysqli_fetch_row($res)){
                    $devices[$i]['deviceid']=$row['0'];
                    $devices[$i]['ip']=$row['1'];
                    $devices[$i]['version']=$row['2'];
                    $devices[$i]['type']=$row['3'];
                    $devices[$i]['total_size']=$row['4'];
                    $devices[$i]['left_size']=$row['5'];
                    $devices[$i]['system_time']=$row['6'];
                    $devices[$i]['online']=$row['7'];
                    $devices[$i]['status']=$row['8'];
                    $devices[$i]['curmovie']=$row['9'];
                    $devices[$i]['curr_pos']=$row['10'];          
                    $devices[$i]['alias']=$row['11'];
                    $devices[$i]['group_name'] = $row['12'];
                    $i++;
                }
                return $devices; 
            } 
        }

        public function deviceSearch($deviceCode){
            $conn=DBConn::getConn();
            
            if(mysqli_connect_errno($conn))     
            { 
                echo "连接 MySQL 失败: " . mysqli_connect_error(); 
            }else{
                $code = "%".$deviceCode."%";
                $sql="select devicetab.deviceid,ip,version,type,total_size,left_size,system_time,online,status,curmovie,curr_pos,alias,group_name from devicetab,registered_device where devicetab.deviceid=registered_device.deviceid and concat(devicetab.deviceid,ip,version,type,alias,group_name) like '$code' and ";
                $deviceModel = new DeviceModel();
                $sql .= $deviceModel->validGroup();
                $conn->query("set names utf8");  
                $res=$conn->query($sql);
                $devices=array();
                $i=0;
                while($row=mysqli_fetch_row($res)){
                    $devices[$i]['deviceid']=$row['0'];
                    $devices[$i]['ip']=$row['1'];
                    $devices[$i]['version']=$row['2'];
                    $devices[$i]['type']=$row['3'];
                    $devices[$i]['total_size']=$row['4'];
                    $devices[$i]['left_size']=$row['5'];
                    $devices[$i]['system_time']=$row['6'];
                    $devices[$i]['online']=$row['7'];
                    $devices[$i]['status']=$row['8'];
                    $devices[$i]['curmovie']=$row['9'];
                    $devices[$i]['curr_pos']=$row['10'];          
                    $devices[$i]['alias']=$row['11'];
                    $devices[$i]['group_name'] = $row['12'];
                    $i++;
                }
                return $devices;   
            }
        }

        public function getRegisteredDevices(){
            $conn=DBConn::getConn();
            
            if(mysqli_connect_errno($conn))     
            { 
                echo "连接 MySQL 失败: " . mysqli_connect_error(); 
            }else{
                
                $sql="select * from registered_device where";
                $deviceModel = new DeviceModel();
                $sql .= $deviceModel->validGroup();
                $conn->query("set names utf8");  
                $res=$conn->query($sql);
                $devices=array();
                $i=0;
                while($row=mysqli_fetch_row($res)){
                    $device=new RegisteredDevice($row['0'],$row['1'],$row['2'],$row['4']);           
                    $devices[$i]=$device;
                    $i++;
                }
                return $devices;   
            } 
            return 0;
        }

        public function getOnlineDevices($deviceId){
            $conn=DBConn::getConn();
            
            if(mysqli_connect_errno($conn))     
            { 
                echo "连接 MySQL 失败: " . mysqli_connect_error(); 
            }else{
                
                $sql="select online from devicetab where deviceid = '$deviceId';";
                $conn->query("set names utf8");  
                $res=$conn->query($sql);

                $online="";
                while($row=mysqli_fetch_row($res)){         
                    $online=$row[0];
                }
                return $online;   
            } 
        }

        public function getDevicesNum(){
            $conn=DBConn::getConn();
            
            if(mysqli_connect_errno($conn))     
            { 
                echo "连接 MySQL 失败: " . mysqli_connect_error(); 
            }else{
                
                $sql="select count(*) from devicetab;";
                $conn->query("set names utf8");  
                $res=$conn->query($sql);
                
                if($row=mysqli_fetch_assoc($res)){
                   return $row['count(*)'];
                }
                 
            } 
            return 0;
        }

        public function deleteRegisteredDevice($deviceId,$deviceName){
            $conn=DBConn::getConn();
            if(mysqli_connect_errno($conn))     
            { 
                echo "连接 MySQL 失败: " . mysqli_connect_error(); 
            }else{
                $sql="delete from registered_device where deviceid='$deviceId';";
                $conn->query("set names utf8");  
                $res= $conn->query($sql);

                if(mysqli_affected_rows($conn)<=0){
                    return "删除失败";
                }else{
                    //保存操作日志
                    $id = "DD".time();
                    $time = date('Y-m-d H:i:s',time());
                    $operaname = "删除设备:"." ".$deviceName;
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
                        return "登录身份已失效";
                    }
                    return "删除成功";
                }
            }
        }

        public function updateRegisteredDevice($deviceId,$deviceOldName,$alias){
            $conn=DBConn::getConn();
            if(mysqli_connect_errno($conn))     
            { 
                echo "连接 MySQL 失败: " . mysqli_connect_error(); 
            }else{
                $sql="update registered_device set alias='$alias' where deviceid='$deviceId';";
                $conn->query("set names utf8");  
                $res= $conn->query($sql);

                if(mysqli_affected_rows($conn)<=0){
                    return "修改失败";
                }else{
                    //保存操作日志
                    $id = "UD".time();
                    $time = date('Y-m-d H:i:s',time());
                    $operaname = "修改设备:"." ".$deviceOldName." "."为"." ".$alias;
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
                        return "登录身份已失效";
                    }
                    return "修改成功";
                }
            }
        }

        public function getDeviceStatus($deviceId){
            $conn=DBConn::getConn();
            if(mysqli_connect_errno($conn))     
            { 
                echo "连接 MySQL 失败: " . mysqli_connect_error(); 
            }else{
                $sql="select status,curmovie,curr_pos from devicetab,registered_device where devicetab.deviceid=registered_device.deviceid and devicetab.deviceid='$deviceId' and devicetab.online = 1";
                $conn->query("set names utf8");  
                $res= $conn->query($sql);
             
                if($row=mysqli_fetch_assoc($res)){
                    $device=new stdClass();
                    $device->status=$row['status'];
                    $device->curmovie=$row['curmovie'];
                    $device->curr_pos=$row['curr_pos'];  
                    return $device;                       
                }else{
                    $device=new stdClass();
                    $device->status=6;
                    return $device;
                }
            }

        }

        public function getGroup(){
            $conn=DBConn::getConn();
            if(mysqli_connect_errno($conn))     
            { 
                echo "连接 MySQL 失败: " . mysqli_connect_error(); 
            }else{
                $sql="select * from device_group where";
                $deviceModel = new DeviceModel();
                $sql .= $deviceModel->validGroup();
                $conn->query("set names utf8");  
                $res= $conn->query($sql);
                
                $group = array();
                $i=0;
                while($row=mysqli_fetch_row($res)){
                    $group[$i]['group_id']=$row[0];
                    $group[$i]['group_name']=$row[1];
                    $i++;                    
                }
                return $group;
            }
        }

        public function selectdevice($group_name,$deviceCode){
            $conn=DBConn::getConn();
            if(mysqli_connect_errno($conn))     
            { 
                echo "连接 MySQL 失败: " . mysqli_connect_error(); 
            }else{
                $code = "%".$deviceCode."%";
                $groupName = "%".$group_name."%";
                $sql = "";
                if(!empty($deviceCode)){
                    $sql="select od.deviceid,od.alias,od.group_name,od.register_time,od.ip from (select registered_device.deviceid,alias,group_name,register_time,ip from registered_device,devicetab where registered_device.deviceid=devicetab.deviceid and devicetab.online=1) od where od.group_name like '$groupName' and od.deviceid like '$code' or od.alias like '$code' and";
                }else{
                    $sql="select od.deviceid,od.alias,od.group_name,od.register_time,od.ip from (select registered_device.deviceid,alias,group_name,register_time,ip from registered_device,devicetab where registered_device.deviceid=devicetab.deviceid and devicetab.online=1) od where od.group_name like '$groupName' and";
                }
                $deviceModel = new DeviceModel();
                $sql .= $deviceModel->validGroup();
                $conn->query("set names utf8");  
                $res= $conn->query($sql);
                
                $device = array();
                $i=0;
                while($row=mysqli_fetch_row($res)){
                    $device[$i]['deviceid']=$row[0];
                    $device[$i]['alias']=$row[1];
                    $device[$i]['group_name']=$row[2];
                    $i++;                    
                }
                return $device;
            }
        }

        public function getDeviceMessage(){
            $MacReturn = shell_exec("/sbin/ifconfig eth0");
            $index = strpos($MacReturn,"HWaddr ");
            $mac = str_replace(":", "", substr($MacReturn,$index+7,17));

            $conn=mysql_connect("127.0.0.1","root","123456");          
            if(!$conn)     
            { 
                echo "连接 MySQL 失败"; 
            }else{
                $item = array();
                $valid_time = array();
                $data_list = array();
                $data = array();
                $params = array();
                $params_list = array();
                $page_size = "3";
                
                $dataSql = "select devicetab.deviceid,ip,version,type,total_size,left_size,system_time,online,status,curmovie,curr_pos,curid,valid_start,valid_end,net,count,alias,register_time,group_name from devicetab,registered_device where devicetab.deviceid=registered_device.deviceid;";
                mysql_select_db("terminal",$conn);
                mysql_query("set names utf8");  
                $res=mysql_query($dataSql,$conn);

                $i=0;
                while($row=mysql_fetch_row($res)){
                    $item[$i]['id']=$row[11];
                    $item[$i]['file_name']=$row[9];
                    $item[$i]['curr_pos']=$row[10];

                    $valid_time[$i]['valid_start']=$row[12];
                    $valid_time[$i]['valid_end']=$row[13];

                    $data_list[$i]['deviceid']=$row[0];
                    $data_list[$i]['devicename']=$row[16];
                    $data_list[$i]['group_name']=$row[18];
                    $data_list[$i]['online']=$row[7];
                    $data_list[$i]['ip']=$row[1];
                    $data_list[$i]['version']=$row[2];
                    $data_list[$i]['type']=$row[3];
                    $data_list[$i]['system_time']=$row[6];
                    $data_list[$i]['reg_time']=$row[17];
                    $data_list[$i]['total_harddisk']=$row[4];
                    $data_list[$i]['left_harddisk']=$row[5];
                    $data_list[$i]['net']=$row[14];
                    $data_list[$i]['film_count']=$row[15];
                    $data_list[$i]['status']=$row[8];
                    $data_list[$i]['item']=json_encode($item[$i]);
                    $data_list[$i]['valid_time']=json_encode($valid_time[$i]);
                    $i++;                    
                }
                
                $data_count = count($data_list);
                $page_start = 0;
                for($i=0;$i<$data_count/$page_size;$i++){
                    $data[$i]['page_size']=$page_size;
                    $data[$i]['data_list']=array_slice($data_list,$page_start,$page_size);
                    $page_start += $page_size;
                }
                
                $deviceModel=new DeviceModel();
                for($i=0;$i<$data_count/$page_size;$i++){
                    $params['deviceid'] = $deviceModel->getMac();
                    $params['devicename'] = $deviceModel->getServerInfo()['cinema_name'];
                    $params['ip'] = $deviceModel->getTun1Ip();
                    $params['data_count'] = (String)$data_count;
                    $params['page'] = (String)$i;
                    $params['data'] = json_encode($data[$i]);
                    $params_list[$i]['params']=json_encode($params);
                }

                return $params_list;
            }
        }

        public function SendPlayerLog(){
            error_reporting(E_ALL ^ E_DEPRECATED);
            $conn=mysql_connect("127.0.0.1","root","123456");
            if(!$conn){
                echo "连接失败";
            }
            mysql_select_db("terminal",$conn);
            mysql_query("set names utf8");

            $sql="select * from terminal_play_log where upload_status = 0";  
            $res=mysql_query($sql,$conn);

            $playLog=array();
            $i=0;
            while($row=mysql_fetch_row($res)){
                $playLog[$i]["id"]=$row[1];
                $playLog[$i]["file_name"]=$row[2];
                $playLog[$i]["play_start"]=$row[3];
                $playLog[$i]["play_end"]=$row[4];
                $playLog[$i]["play_type"]=$row[7];
                $playLog[$i]["deviceid"]=$row[0];
                $playLog[$i]["device_name"]=$row[8];                     
                $i++;
            }

            $SendPlayerLog = array();

            for($j=0;$j<count($playLog);$j++){

                $deviceid = $playLog[$j]["deviceid"];

                $deviceSql="select group_name from registered_device where deviceid = '$deviceid'";  
                $deviceRes=mysql_query($deviceSql,$conn);
                while($deviceRow=mysql_fetch_row($deviceRes)){
                    $group_name = $deviceRow[0];
                }

                $devicetabSql="select ip from devicetab where deviceid = '$deviceid'";
                $devicetabRes=mysql_query($devicetabSql,$conn);
                while($devicetabRow=mysql_fetch_row($devicetabRes)){
                    $ip = $devicetabRow[0];
                }

                $serverInfoSql = "select cinema_name from server_info";
                $serverInfoRes=mysql_query($serverInfoSql,$conn);
                while($serverInfoRow=mysql_fetch_row($serverInfoRes)){
                    $cinema_name = $serverInfoRow[0];
                }

                $item = array();
                $params = array();

                $item['id'] = $playLog[$j]["id"];
                $item['file_name'] = $playLog[$j]["file_name"];
                $item['play_start'] = $playLog[$j]["play_start"];
                $item['play_end'] = $playLog[$j]["play_end"];
                $item['play_type'] = $playLog[$j]["play_type"];

                $params['deviceid'] = $playLog[$j]["deviceid"];
                $params['ip'] = $ip;
                $params['device_name'] = $playLog[$j]["device_name"];
                $params['cinema_name'] = $cinema_name;
                $params['group_name'] = $group_name;
                $params['item'] = json_encode($item);

                $SendPlayerLog[$j]['params'] = json_encode($params);

            }
            return $SendPlayerLog;
        }

        public function SendServerLog(){
            error_reporting(E_ALL ^ E_DEPRECATED);
            $conn=mysql_connect("127.0.0.1","root","123456");
            if(!$conn){
                echo "连接失败";
            }
            mysql_select_db("terminal",$conn);
            mysql_query("set names utf8");
            $sql="select * from server_opera_log where upload_status = 0";  
            $res=mysql_query($sql,$conn);

            $operaLog=array();
            $i=0;
            while($row=mysql_fetch_row($res)){
                $operaLog[$i]["time"]=$row[3];
                $operaLog[$i]["user"]=$row[0];
                $operaLog[$i]["event"]=$row[2];                     
                $i++;
            }

            $params = array();

            $deviceModel=new DeviceModel();
            $params['deviceid'] = $deviceModel->getMac();
            $params['ip'] = $deviceModel->getTun1Ip();
            $params['cinema_name'] = $deviceModel->getServerInfo()['cinema_name'];
            $params['version'] = $deviceModel->getServerInfo()['version_id'];

            $SendServerLog = array();
            for($i=0;$i<count($operaLog);$i++){
                $params['item'] = json_encode($operaLog[$i]);
                $SendServerLog[$i]['params'] = json_encode($params);
            }
            return $SendServerLog;
        }

        public function getMac(){
            $MacReturn = shell_exec("/sbin/ifconfig eth0");
            $index = strpos($MacReturn,"HWaddr ");
            $mac = str_replace(":", "", substr($MacReturn,$index+7,17));
            return $mac;
        }

        public function getTun1Ip(){
            $MacReturntun1 = shell_exec("/sbin/ifconfig tun1");
            $indextun1 = strpos($MacReturntun1,"addr:");
            $tun1IP = substr($MacReturntun1,$indextun1+5,10);

            $MacReturntun0 = shell_exec("/sbin/ifconfig tun0");
            $indextun0 = strpos($MacReturntun0,"addr:");
            $tun0IP = substr($MacReturntun0,$indextun0+5,10);

            $yunIp = "";
            if(strstr($tun1IP, "10.19")){
                $yunIp = $tun1IP;
            }else{
                if(strstr($tun0IP, "10.19")){
                    $yunIp = $tun0IP;
                }else{
                    $yunIp = "0.0.0.0";
                }
            }
            return $yunIp;
        }

        public function getServerInfo(){
            error_reporting(E_ALL ^ E_DEPRECATED);
            $conn=mysql_connect("127.0.0.1","root","123456");          
            if(!$conn)     
            { 
                echo "连接 MySQL 失败"; 
            }else{
                $sql = "select * from server_info;";
                mysql_select_db("terminal",$conn);
                mysql_query("set names utf8");  
                $res=mysql_query($sql,$conn);
                
                $server_info = array();
                while($row=mysql_fetch_row($res)){
                    $server_info['version_id'] = $row[0];
                    $server_info['cinema_name'] = $row[1];
                    $server_info['yun_ip'] = $row[2];
                }

                return $server_info;
            }
        }

        function updateCinemaName($ciname_name){
            $conn=DBConn::getConn();
            if(mysqli_connect_errno($conn))     
            { 
                echo "连接 MySQL 失败: " . mysqli_connect_error(); 
            }else{
                $sql = "update server_info set cinema_name = '$ciname_name'";
                $conn->query("set names utf8");
                $res = $conn->query($sql);
                if($res==false){
                    return 0; 
                }else{
                    return 1;
                }
            }
        }

        function updateYunIp($yun_ip){
            $conn=DBConn::getConn();
            if(mysqli_connect_errno($conn))     
            { 
                echo "连接 MySQL 失败: " . mysqli_connect_error(); 
            }else{
                $sql = "update server_info set yun_ip = '$yun_ip'";
                $conn->query("set names utf8");
                $res = $conn->query($sql);
                if($res==false){
                    return 0; 
                }else{
                    return 1;
                }
            }
        }

        public function updatePlayLogStatus($play_start){
            error_reporting(E_ALL ^ E_DEPRECATED);
            $conn=mysql_connect("127.0.0.1","root","123456");
            if(!$conn){
                echo "连接失败";
            }
            mysql_select_db("terminal",$conn);
            mysql_query("set names utf8");
            $sql="update terminal_play_log set upload_status = 1 where play_start = '$play_start'";  
            $res=mysql_query($sql,$conn);
        }

        public function updateServerLogStatus($time){
            error_reporting(E_ALL ^ E_DEPRECATED);
            $conn=mysql_connect("127.0.0.1","root","123456");
            if(!$conn){
                echo "连接失败";
            }
            mysql_select_db("terminal",$conn);
            mysql_query("set names utf8");
            $sql="update server_opera_log set upload_status = 1 where time = '$time'";  
            $res=mysql_query($sql,$conn);
        }

        public function validGroup(){
            session_start();
            if(isset($_SESSION['group'])){
                $group_name = $_SESSION['group'];
                if($group_name == "超级用户"){
                    return " group_name like '%%'";
                }else{
                    $validGroup = " (";
                    $group_name = $_SESSION['group'];
                    $groups = explode(",", $group_name);
                    for($i=0;$i<count($groups);$i++){
                        $validGroup .= "group_name = '".$groups[$i]."' or ";
                    }
                    return substr($validGroup, 0, -4).")";
                }
            }
        }
    }
   
?>