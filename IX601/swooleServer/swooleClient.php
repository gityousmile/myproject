<?php
    require('/data/html/micro/remote/Model/DeviceModel.php');
    $client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);
	$client->on("connect", function($cli) {
		$key1 = generateRandomString(32);
		$header = "GET / HTTP/1.1\r\n";
	    $header .= "Accept-Encoding: gzip, deflate, sdch\r\n";
	    $header .= "Accept-Language: zh-CN,zh;q=0.8\r\n";
	    $header .= "Cache-Control: no-cache\r\n";
	    $header .= "Connection: Upgrade\r\n";
	    $header .= "Host: " . "192.168.1.118" . ":" . "8080" . "\r\n";
	    $header .= "Origin:http://192.168.1.200\r\n";
	    $header .= "Sec-WebSocket-Extensions: permessage-deflate; client_max_window_bits\r\n";
	    $header .= "Sec-WebSocket-Key: " . $key1 . "\r\n";
	    $header .= "Sec-WebSocket-Version: 13\r\n";
	    $header .= "Upgrade: websocket\r\n";
	    $header .= "User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36\r\n";
        $header .= "\r\n";
	    $cli->send($header);
	});
	$client->on("receive", function($cli, $data){
        echo "receive:".$data."\n";
        $deviceModel=new DeviceModel();
        $SendHeartBeat = $deviceModel->getDeviceMessage();
        for($i=0;$i<count($SendHeartBeat);$i++){
            $HeartBeat = "class=IntellixlUse&method=SendHeartBeat&params=".$SendHeartBeat[$i]['params'];
            $cli->send(encode($HeartBeat)); 
        }
        sleep(2);
	});
	$client->on("error", function($cli){
	    echo "Connection error\n";
	});
	$client->on("close", function($cli){
	    echo "Connection close\n";
	});

    $client->connect('192.168.1.118', 9502);

	function encode($data)
    {
        $data = is_array($data) || is_object($data) ? json_encode($data) : (string)$data;
        $len = strlen($data);
        $mask = array();
        for ($j = 0; $j < 4; $j ++)
        {
            $mask[] = mt_rand(1, 255);
        }
        $head[0] = 129;
        if ($len <= 125)
        {
            $head[1] = $len;
        } elseif ($len <= 65535)        
        {
            $split = str_split(sprintf('%016b', $len), 8);
            $head[1] = 126;
            $head[2] = bindec($split[0]);
            $head[3] = bindec($split[1]);
        } else
        {
            $split = str_split(sprintf('%064b', $len), 8);
            $head[1] = 127;
            for ($i = 0; $i < 8; $i ++)
            {
                $head[$i + 2] = bindec($split[$i]);
            }
            if ($head[2] > 127)
            {
                return false;
            }
        }
        $head[1] += 128;
        $head = array_merge($head, $mask);
        foreach ($head as $k => $v)
        {
            $head[$k] = chr($v);
        }
        $mask_data = '';
        for ($j = 0; $j < $len; $j ++)
        {
            $mask_data .= chr(ord($data[$j]) ^ $mask[$j % 4]);
        }
        return implode('', $head) . $mask_data;
    }

    function generateRandomString($length = 10, $addSpaces = true, $addNumbers = true)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!"§$%&/()=[]{}';
        $useChars = array();
        // select some random chars:
        for ($i = 0; $i < $length; $i ++)
        {
            $useChars[] = $characters[mt_rand(0, strlen($characters) - 1)];
        }
        // add spaces and numbers:
        if ($addSpaces === true)
        {
            array_push($useChars, ' ', ' ', ' ', ' ', ' ', ' ');
        }
        if ($addNumbers === true)
        {
            array_push($useChars, rand(0, 9), rand(0, 9), rand(0, 9));
        }
        shuffle($useChars);
        $randomString = trim(implode('', $useChars));
        $randomString = substr($randomString, 0, $length);

        return $randomString;
    }
?>