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
        $search = "";
        $searchReturn = array();
        if(IS_POST){
            $down_date_start = I('post.down_date_start','','strip_tags');
            $down_date_end = I('post.down_date_end','','strip_tags');
            $diy_select_txt = I('post.diy_select_txt','','strip_tags');
            $diy_select_code = I('post.diy_select_code','','strip_tags');

            $search .= "oprera_name like '$diy_select_txt%'";
            if($diy_select_code) {
                $search .= " and concat(oprera_id,oprera_name,username) like '%$diy_select_code%'";
            }
            if($down_date_start) {
                $search .= " and time >=  '$down_date_start 00:00:00'";
            }
            if($down_date_end) {
                $search .= " and time <=  '$down_date_end 23:59:59'";
            }
            $searchReturn['down_date_start'] = $down_date_start;
            $searchReturn['down_date_end'] = $down_date_end;
            $searchReturn['diy_select_txt'] = $diy_select_txt;
            $searchReturn['diy_select_code'] = $diy_select_code;
        }
        $model = M('server_opera_log');
        $where = $this->varlidUser();
        $count = $model->where($where)->where($search)->count();   //查询满足要求的总记录数
        $showrow = 10; //一页显示的行数
        $curpage = empty($_POST['page']) ? 1 : $_POST['page']; //当前的页,还应该处理非数字的情况
        $page  = new \Common\Utils\page($count, $showrow, $curpage, "operaLog?page={page}", 2);    //实例化分页类 传入总记录数和每页显示的记录数(25)
        $show  = $page->myde_write("movie_list");  //分页显示输出
        $firstRow = ($curpage-1)*10;
        $sort = empty($_POST['sort']) ? "desc" : $_POST['sort'];  //获取排序方式
        $operalogdata  = $model->where($where)->where($search)->order('time '.$sort)->limit($firstRow.','.$showrow)->select();
        $this -> assign('operalogdata',$operalogdata);
        $this -> assign('page',$show);
        $this -> assign('sort',$sort);
        $this -> assign('searchReturn',$searchReturn);
    	$this -> display();
    }

    public function serverLog(){
        $search = "";
        $searchReturn = array();
        if(IS_POST){
            $down_date_start = I('post.down_date_start','','strip_tags');
            $down_date_end = I('post.down_date_end','','strip_tags');
            $diy_select_code = I('post.diy_select_code','','strip_tags');

            $search .= "concat(id,terminal_play_log.deviceid,alias,file_name,username,video_type,group_name) like '%$diy_select_code%'";
            if($down_date_start) {
                $search .= " and play_end >=  '$down_date_start 00:00:00'";
            }
            if($down_date_end) {
                $search .= " and play_end <=  '$down_date_end 23:59:59'";
            }
            $searchReturn['down_date_start'] = $down_date_start;
            $searchReturn['down_date_end'] = $down_date_end;
            $searchReturn['diy_select_code'] = $diy_select_code;
        }
        $model = M('terminal_play_log');
        $where = $this->validGroup();
        $join = 'RIGHT JOIN registered_device ON terminal_play_log.deviceid = registered_device.deviceid';
        $count = $model->join($join)->where($where)->where($search)->count();   //查询满足要求的总记录数
        $devices = $model->join($join)->where($where)->where($search)->distinct(true)->field('terminal_play_log.deviceid')->select();   //查询满足要求设备有几种
        $deviceCount = count($devices);
        $showrow = 10; //一页显示的行数
        $curpage = empty($_POST['page']) ? 1 : $_POST['page']; //当前的页,还应该处理非数字的情况
        $page  = new \Common\Utils\page($count, $showrow, $curpage, "operaLog?page={page}", 2);    //实例化分页类 传入总记录数和每页显示的记录数(25)
        $show  = $page->myde_write("movie_list");  //分页显示输出
        $firstRow = ($curpage-1)*10;
        $sortname = empty($_POST['sortname']) ? "id" : $_POST['sortname'];  //获取排序方式
        if($sortname == "id"){
            $sortname = "CONVERT($sortname,SIGNED)";
        }
        if($sortname == "deviceid"){
            $sortname = "terminal_play_log.deviceid";
        }
        if($sortname == "device_name" || $sortname == "group_name" || $sortname == "file_name" || $sortname == "username"){
            $sortname = "convert($sortname using gbk)";
        }
        $sortType = empty($_POST['sort']) ? "asc" : $_POST['sort'];  //获取排序方式
        $sort = $sortname." ".$sortType;
        $playLog = $model->join($join)->where($where)->where($search)->order($sort)->limit($firstRow.','.$showrow)->select();
        // $sql = $model->getLastSql();
        // $this -> assign('sql',$sql);
        $this -> assign('playLog',$playLog); 
        $this -> assign('page',$show);
        $this -> assign('searchReturn',$searchReturn);
        $this -> assign('count',$count."次"); 
        $this -> assign('deviceCount',$deviceCount."台");
        $sortname = empty($_POST['sortname']) ? "id" : $_POST['sortname'];  //获取排序方式
        $this -> assign('sortname',$sortname);
        $this -> assign('sort',$sortType);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
        $this -> display();
    }

    Public function serverDeleteSearch(){
        $search = "";
        if(IS_POST){
            $down_date_start = I('post.down_date_start','','strip_tags');
            $down_date_end = I('post.down_date_end','','strip_tags');
            $diy_select_code = I('post.diy_select_code','','strip_tags');

            $search .= "concat(id,terminal_play_log.deviceid,alias,file_name,username,video_type,group_name) like '%$diy_select_code%'";
            if($down_date_start) {
                $search .= " and play_end >=  '$down_date_start 00:00:00'";
            }
            if($down_date_end) {
                $search .= " and play_end <=  '$down_date_end 23:59:59'";
            }
        }
        $model = M('terminal_play_log');
        $where = $this->validGroup();
        $join = 'LEFT JOIN registered_device ON terminal_play_log.deviceid = registered_device.deviceid';
        $playLogs = $model->join($join)->where($where)->where($search)->select();   //查询满足要求的总记录数
        $res = 0;
        foreach ($playLogs as $playLog) {
            $id = $playLog['id'];
            $deviceid = $playLog['deviceid'];
            $play_start = $playLog['play_start'];
            $play_end = $playLog['play_end'];
            $delete = "id = '$id' and deviceid = '$deviceid' and play_start = '$play_start' and play_end = '$play_end'";
            $affect = $model->where($delete)->delete();
            $res += $affect;
        }
        if($res > 0){
            echo "删除成功";
        }else{
            echo "删除失败";
        }
    }

    public function varlidUser(){
        if(session('?valid_user') && session('?group')){
            $group = session('group');
            if($group == "超级用户"){
                return "1=1";
            }else{
                $username = session('valid_user');
                return "username='$username'";
            }
        }
    }

    public function validGroup(){
        if(session('?group')){
            $group_name = session('group');
            if($group_name == "超级用户"){
                return "group_name like '%%'";
            }else{
                $validGroup = "";
                $groups = explode(",", $group_name);
                $count = count($groups);
                for($i=0;$i<$count;$i++){
                    $group = $groups[$i];
                    $validGroup .= "group_name = '$group' or ";
                }
                return substr($validGroup, 0, -4);
            }
        }
    }

    public function exportExcel(){
        $search = "";
        $down_date_start = I('get.down_date_start','','strip_tags');
        $down_date_end = I('get.down_date_end','','strip_tags');
        $diy_select_code = I('get.diy_select_code','','strip_tags');

        $search .= "concat(id,terminal_play_log.deviceid,alias,file_name,username,video_type,group_name) like '%$diy_select_code%'";
        if($down_date_start) {
            $search .= " and play_end >=  '$down_date_start 00:00:00'";
        }
        if($down_date_end) {
            $search .= " and play_end <=  '$down_date_end 23:59:59'";
        }
        $model = M('terminal_play_log');
        $where = $this->validGroup();
        $join = 'LEFT JOIN registered_device ON terminal_play_log.deviceid = registered_device.deviceid';
        $playLog = $model->join($join)->where($where)->where($search)->field('terminal_play_log.deviceid,id,file_name,play_start,play_end,time,username,video_type,alias,group_name')->select();   //查询满足要求的总记录数

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