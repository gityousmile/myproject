<?php
/**
 * Created by PhpStorm.
 * User: Why
 * Date: 2017-02-15
 * Time: 13:57
 */
namespace Home\Controller;
use Think\Controller;

class LogController extends Controller {

    public function operaLog(){
    	$this -> display();
    }

    public function operalogdata(){
        $conn=mysql_connect("127.0.0.1","root","123456");
        if(!$conn){
            echo "连接失败";
        }
        mysql_select_db("terminal",$conn);
        mysql_query("set names utf8");
        $sql="select * from server_opera_log where";
        $LogController = new LogController();
        $sql .= $LogController->varlidUser();
        $res=mysql_query($sql,$conn);  
        $rows=mysql_affected_rows($conn);//获取行数
        $colums=mysql_num_fields($res);//获取列数

        $operaLog=array();
        $i=0;
        while($row=mysql_fetch_row($res)){
            $operaLog[$i]["username"]=$row[0];
            $operaLog[$i]["oprera_id"]=$row[1];
            $operaLog[$i]["oprera_name"]=$row[2];
            $operaLog[$i]["time"]=$row[3];                      
            $i++;
        }
        echo json_encode($operaLog);
    }

    public function operalogSearch(){
        $down_date_start = $_POST['down_date_start'];
        $down_date_end = $_POST['down_date_end'];
        $diy_select_txt = $_POST['diy_select_txt']."%";
        $diy_select_code = "%".$_POST['diy_select_code']."%";

        $conn=mysql_connect("127.0.0.1","root","123456");
        if(!$conn){
            echo "连接失败";
        }
        mysql_select_db("terminal",$conn);
        mysql_query("set names utf8");
        $sql="select * from server_opera_log where oprera_name like '$diy_select_txt' and concat(oprera_id,oprera_name,username) like '$diy_select_code'";
        if($down_date_start!=""){
            $down_date_start = $down_date_start." 00:00:00";
            $sql = "select * from server_opera_log where oprera_name like '$diy_select_txt' and concat(oprera_id,oprera_name,username) like '$diy_select_code' and unix_timestamp(time) >=  unix_timestamp('$down_date_start')";
        }
        if($down_date_end!=""){
            $down_date_end = $down_date_end." 23:59:59";
            $sql = $sql." "."and"." "."unix_timestamp(time)"." "."<="." "."unix_timestamp('$down_date_end')";
        }
        $LogController = new LogController();
        $sql = $sql." and".$LogController->varlidUser();

        $res=mysql_query($sql,$conn);  
        $rows=mysql_affected_rows($conn);//获取行数
        $colums=mysql_num_fields($res);//获取列数
        $operaLog=array();
        $i=0;
        while($row=mysql_fetch_row($res)){
            $operaLog[$i]["username"]=$row[0];
            $operaLog[$i]["oprera_id"]=$row[1];
            $operaLog[$i]["oprera_name"]=$row[2];
            $operaLog[$i]["time"]=$row[3];                      
            $i++;
        }
        echo json_encode($operaLog);
    }

    public function serverLog(){
        $this -> display();
    }

    public function serverlogdata(){
        $conn=mysql_connect("127.0.0.1","root","123456");
        if(!$conn){
            echo "连接失败";
        }
        mysql_select_db("terminal",$conn);
        mysql_query("set names utf8");
        $sql="select * from terminal_play_log,registered_device where terminal_play_log.deviceid = registered_device.deviceid and";
        $LogController = new LogController();
        $sql .= $LogController->validGroup();

        $res=mysql_query($sql,$conn);  
        $rows=mysql_affected_rows($conn);//获取行数
        $colums=mysql_num_fields($res);//获取列数

        $playLog=array();
        $i=0;
        while($row=mysql_fetch_row($res)){
            $playLog[$i]["deviceid"]=$row[0];
            $playLog[$i]["id"]=$row[1];
            $playLog[$i]["file_name"]=$row[2];
            $playLog[$i]["play_start"]=$row[3];
            $playLog[$i]["play_end"]=$row[4];
            $playLog[$i]["time"]=$row[5];
            $playLog[$i]["username"]=$row[6];
            $playLog[$i]["video_type"]=$row[7];
            $playLog[$i]["device_name"]=$row[8];
            $playLog[$i]["group_name"]=$row[14];                     
            $i++;
        }
        echo json_encode($playLog);
    }

    public function serverlogSearch(){
        $down_date_start = $_POST['down_date_start'];
        $down_date_end = $_POST['down_date_end'];
        $diy_select_code = "%".$_POST['diy_select_code']."%";

        $conn=mysql_connect("127.0.0.1","root","123456");
        if(!$conn){
            echo "连接失败";
        }
        mysql_select_db("terminal",$conn);
        mysql_query("set names utf8");
        $sql="select * from terminal_play_log,registered_device where terminal_play_log.deviceid = registered_device.deviceid and concat(id,terminal_play_log.deviceid,device_name,file_name,username,video_type,group_name) like '$diy_select_code'";
        if($down_date_start!=""){
            $down_date_start = $down_date_start." 00:00:00";
            $sql = $sql." "."and"." "."unix_timestamp(play_end)"." ".">"." "."unix_timestamp('$down_date_start')";
        }
        if($down_date_end!=""){
            $down_date_end = $down_date_end." 23:59:59";
            $sql = $sql." "."and"." "."unix_timestamp(play_end)"." "."<"." "."unix_timestamp('$down_date_end')";
        }
        $LogController = new LogController();
        $sql = $sql." and".$LogController->validGroup();
        $res=mysql_query($sql,$conn);  
        $rows=mysql_affected_rows($conn);//获取行数
        $colums=mysql_num_fields($res);//获取列数
        
        $playLog=array();
        $i=0;
        while($row=mysql_fetch_row($res)){
            $playLog[$i]["deviceid"]=$row[0];
            $playLog[$i]["id"]=$row[1];
            $playLog[$i]["file_name"]=$row[2];
            $playLog[$i]["play_start"]=$row[3];
            $playLog[$i]["play_end"]=$row[4];
            $playLog[$i]["time"]=$row[5];
            $playLog[$i]["username"]=$row[6];
            $playLog[$i]["video_type"]=$row[7];
            $playLog[$i]["device_name"]=$row[8]; 
            $playLog[$i]["group_name"]=$row[14];                     
            $i++;
        }
        echo json_encode($playLog);
    }

    Public function serverDeleteSearch(){
        $down_date_start = $_POST['down_date_start'];
        $down_date_end = $_POST['down_date_end'];
        $diy_select_code = "%".$_POST['diy_select_code']."%";

        $conn=mysql_connect("127.0.0.1","root","123456");
        if(!$conn){
            echo "连接失败";
        }
        mysql_select_db("terminal",$conn);
        mysql_query("set names utf8");
        $sql="delete from terminal_play_log where concat(id,deviceid,device_name,file_name,username,video_type) like '$diy_select_code'";
        if($down_date_start!=""){
            $down_date_start = $down_date_start." 00:00:00";
            $sql = $sql." "."and"." "."unix_timestamp(play_end)"." ".">"." "."unix_timestamp('$down_date_start')";
        }
        if($down_date_end!=""){
            $down_date_end = $down_date_end." 23:59:59";
            $sql = $sql." "."and"." "."unix_timestamp(play_end)"." "."<"." "."unix_timestamp('$down_date_end')";
        }
        $res=mysql_query($sql,$conn);  
        $rows=mysql_affected_rows($conn);//获取行数
        mysql_close($conn);
        
        if($rows > 0){
            echo "删除成功";
        }else{
            echo "删除失败";
        }
    }

    public function varlidUser(){
        session_start();
        if(isset($_SESSION['valid_user']) && isset($_SESSION['group'])){
            $username = $_SESSION['valid_user'];
            $group_name = $_SESSION['group'];
            if($group_name == "超级用户"){
                return " username like '%%'";
            }else{
                $varlidUser = " username = '$username'";
                return $varlidUser;
            }
        }
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

    public function exportExcel(){
        $conn=mysql_connect("127.0.0.1","root","123456");
        if(!$conn){
            echo "连接失败";
        }
        mysql_select_db("terminal",$conn);
        mysql_query("set names utf8");
        $sql="select * from terminal_play_log,registered_device where terminal_play_log.deviceid = registered_device.deviceid and";
        $LogController = new LogController();
        $sql .= $LogController->validGroup();  
        $res=mysql_query($sql,$conn);  
        $rows=mysql_affected_rows($conn);//获取行数
        $colums=mysql_num_fields($res);//获取列数

        $playLog=array();
        $i=0;
        while($row=mysql_fetch_row($res)){
            $playLog[$i]["deviceid"]=$row[0];
            $playLog[$i]["id"]=$row[1];
            $playLog[$i]["file_name"]=$row[2];
            $playLog[$i]["play_start"]=$row[3];
            $playLog[$i]["play_end"]=$row[4];
            $playLog[$i]["time"]=$row[5];
            $playLog[$i]["username"]=$row[6];
            $playLog[$i]["video_type"]=$row[7];
            $playLog[$i]["device_name"]=$row[8];
            $playLog[$i]["group_name"]=$row[14];                      
            $i++;
        }
        mysql_close($conn);
        
        $filename = "播放日志".date('Y-m-d',time());

        header("Content-type:application/octet-stream");
        header("Accept-Ranges:bytes");
        header("Content-type:application/vnd.ms-excel");  
        header("Content-Disposition:attachment;filename=".$filename.".xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        $title = array('电影机编号','影片Id','影片名称','开始时间','结束时间','影片时长','操作用户','播放类型','电影机名称','组别名');
        foreach ($title as $k => $v) {
            $title[$k]=iconv("UTF-8", "GB2312",$v);
        }
        $title= implode("\t", $title);
        echo "$title\n";

        $data = $playLog;
        if (!empty($data)){
            foreach($data as $key=>$val){
                foreach ($val as $ck => $cv) {
                    $data[$key][$ck]=iconv("UTF-8", "GB2312", $cv);
                }
                $data[$key]=implode("\t", $data[$key]);
                
            }
            echo implode("\n",$data);
        }
    }

}