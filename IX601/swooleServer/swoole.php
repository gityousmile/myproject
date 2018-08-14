<?php
require('/data/html/micro/remote/Model/DeviceModel.php');
require('/data/html/micro/remote/Model/MovieModel.php');
include_once("/data/html/micro/remote/Class/dbconn.class.php");
//创建websocket服务器对象，监听0.0.0.0:9502端口
$ws = new swoole_websocket_server("0.0.0.0", 9502);
$redis = new redis();
$redis->connect('127.0.0.1', 6379);
//监听WebSocket连接打开事件
$ws->on('open', function ($ws, $request) {  
   echo "conenct established" ;
});

//监听WebSocket消息事件
$ws->on('message', function ($ws, $frame) {
    global $redis;
    // echo strpos($frame->data,"SendPlayFilmACK");
    if(strpos($frame->data,"=SetPlayFilmACK&")!=""){
        $data=json_decode(substr($frame->data,strpos($frame->data,"params=")+7));
        $fdNum=$data->clientid;//获取浏览器的通道号fd
        $fd=$redis->hget("browser:".$fdNum,"clientfd");
        if($data->res=="0"){
            $ws->push($fd,"播放成功");
        }else if($data->res=="7"){
            $ws->push($fd,"磁盘已满");
        }else if($data->res=="8"){
            $ws->push($fd,"不在档期内");
        }
        else if($data->res=="9"){
            $ws->push($fd,"电影不在播放列表内");
        }
        else if($data->res=="10"){
            $ws->push($fd,"播放器未下载该电影，不能公网播放");
        }
        else if($data->res=="11"){
            $ws->push($fd,"电影不在播放列表内");
        }
        else if($data->res=="12"){
            $ws->push($fd,"播放列表不存在播放器内");
        }
        else{
            $ws->push($fd,"操作有误");
        }
    }else if(strpos($frame->data,"=SetStopFilmACK&")!=""){
        $data=json_decode(substr($frame->data,strpos($frame->data,"params=")+7));
        $fdNum=$data->clientid;
        $fd=$redis->hget("browser:".$fdNum,"clientfd");
        if($data->res=="0"){
            $ws->push($fd,"已停止");
        }else if($data->res=="7"){
            $ws->push($fd,"磁盘已满");
        }else if($data->res=="8"){
            $ws->push($fd,"不在档期内");
        }else if($data->res=="9"){
            $ws->push($fd,"电影不在播放列表内");
        }
        else if($data->res=="10"){
            $ws->push($fd,"播放器未下载该电影，不能公网播放");
        }
        else if($data->res=="11"){
            $ws->push($fd,"电影不在播放列表内");
        }
        else if($data->res=="12"){
            $ws->push($fd,"播放列表不存在播放器内");
        }
        else{
            $ws->push($fd,"操作有误");
        }
    }else if(strpos($frame->data,"=SetPlayListACK&")!=""){
        $data=json_decode(substr($frame->data,strpos($frame->data,"params=")+7));
        $fdNum=$data->clientid;
        $fd=$redis->hget("browser:".$fdNum,"clientfd");
        if($data->res=="0"){
            $ws->push($fd,"下发成功");
        }else if($data->res=="7"){
            $ws->push($fd,"磁盘已满");
        }else if($data->res=="8"){
            $ws->push($fd,"不在档期内");
        }
        else if($data->res=="9"){
            $ws->push($fd,"电影不在播放列表内");
        }
        else if($data->res=="10"){
            $ws->push($fd,"播放器未下载该电影，不能公网播放");
        }
        else if($data->res=="11"){
            $ws->push($fd,"电影不在播放列表内");
        }
        else if($data->res=="12"){
            $ws->push($fd,"播放列表不存在播放器内");
        }
        else{
            $ws->push($fd,"操作有误");
        }
        
    }else if(strpos($frame->data,"=SendPlayLog&")!=""){
         $data=json_decode(substr($frame->data,strpos($frame->data,"params=")+7));
         $deviceModel=new DeviceModel();
         $deviceModel->savePlayLog($data);
         $msg = 'class=IntellixlUse&method=SendPlayLogAck&params={"res":"0","msg":"成功","data":{"id":'."\"".$data->id."\"".",".'"play_start":'."\"".$data->play_start."\""."}}";
         if($ws->exist($frame->fd)){
           $ws->push($frame->fd,$msg);//通过当前通道返回响应信息
         }
         
    }else if(strpos($frame->data,"=SendFileList&")!=""){
         $data=json_decode(substr($frame->data,strpos($frame->data,"params=")+7));
         $MovieModel=new MovieModel();
         $MovieModel->saveDownLoadedSubmitedList($data);
         $msg = 'class=IntellixlUse&method=SendFileListACK&params={"res":"0","msg":"成功","data":{}}';
         if($ws->exist($frame->fd)){
           $ws->push($frame->fd,$msg);//通过当前通道返回响应信息    
         }
         
    }else if(strpos($frame->data,"=SetPlayFilm&")!=""){
        $data=json_decode(substr($frame->data,strpos($frame->data,"params=")+7));
        $fd=$redis->hget("terminal:".$data->deviceid,"clientfd");//获取设备所占的websocket通道号
        $text=substr($frame->data,strpos($frame->data,'{"deviceid"'),strpos($frame->data,"data")-strpos($frame->data,'{"deviceid"'));
        $msg="class=IntellixlUse&method=SetPlayFilm&params=".$text.'clientid":"'.$frame->fd.'"';
        $text=substr($frame->data,strpos($frame->data,',"data"'));
        $msg=$msg.$text;
        $redis->hset("browser:".$frame->fd,"clientfd",$frame->fd);//设置浏览器端所占通道号  
        echo $msg;
        if($ws->exist($fd)){
            $ws->push($fd,$msg);
        }  

    }else if(strpos($frame->data,"=SetStopFilm&")!=""){       
        $data=json_decode(substr($frame->data,strpos($frame->data,"params=")+7));
        $fd=$redis->hget("terminal:".$data->deviceid,"clientfd");//获取设备所占的websocket通道号
        $text=substr($frame->data,strpos($frame->data,'{"deviceid"'),strpos($frame->data,"data")-strpos($frame->data,'{"deviceid"'));
        $msg="class=IntellixlUse&method=SetStopFilm&params=".$text.'clientid":"'.$frame->fd.'"';
        $text=substr($frame->data,strpos($frame->data,',"data"'));
        $msg=$msg.$text;
        $redis->hset("browser:".$frame->fd,"clientfd",$frame->fd);//设置浏览器端所占通道号 
        if($ws->exist($fd)){
            $ws->push($fd,$msg);
        }  
          
    }else if(strpos($frame->data,"=SetPlayList&")!=""){
        echo $frame->data;
        $data=json_decode(substr($frame->data,strpos($frame->data,"params=")+7));
        $fd=$redis->hget("terminal:".$data->deviceid,"clientfd");//获取浏览器端所占的websocket通道号
        $text=substr($frame->data,strpos($frame->data,'{"deviceid"'),strpos($frame->data,"data")-strpos($frame->data,'{"deviceid"'));
        $msg="class=IntellixlUse&method=SetPlayList&params=".$text.'clientid":"'.$frame->fd.'"';
        $text=substr($frame->data,strpos($frame->data,',"data"'));
        $msg=$msg.$text;
        $redis->hset("browser:".$frame->fd,"clientfd",$frame->fd);
        if($ws->exist($fd)){
            $ws->push($fd,$msg);
        }      
    }
    else if(strpos($frame->data,"=SendHeartBeat&")!=""){
        $data=json_decode(substr($frame->data,strpos($frame->data,"params=")+7));
        if($ws->exist($frame->fd)){
            $ws->push($frame->fd,'class=IntellixlUse&method=SendHeartBeatACK&params={"res":"0","msg":"","data":{}}');//通过当前通道返回响应信息
        }
        $redis->hset("terminal:".$data->deviceid,"clientfd",$frame->fd);//存储设备所占的websocket通道号
    }else{
        ;        
    }
});

//监听WebSocket连接关闭事件
$ws->on('close', function ($ws, $fd) {
    //print_r($GLOBALS['fd']);
    global $redis;
    $redis->hdel("browser:".$fd,"clientfd");
    echo "client-{$fd} is closed\n";
});

$ws->start();

