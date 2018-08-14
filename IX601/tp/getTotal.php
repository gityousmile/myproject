<?php
class getTotal{
	public function getServerTotal(){
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
        $sql="select * from server_opera_log where oprera_name like '$diy_select_txt'";  
        $res=mysql_query($sql,$conn);  
        $rows=mysql_affected_rows($conn);//获取行数
        return $rows;
    }

    public function getPlayTotal(){
        $conn=mysql_connect("127.0.0.1","root","123456");
        if(!$conn){
            echo "连接失败";
        }
        mysql_select_db("terminal",$conn);
        mysql_query("set names utf8");
        $sql="select * from terminal_play_log";  
        $res=mysql_query($sql,$conn);  
        $rows=mysql_affected_rows($conn);//获取行数
        return $rows;
    }
}
?>