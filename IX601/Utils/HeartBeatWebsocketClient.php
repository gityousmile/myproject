<?php
require('/data/html/micro/remote/Model/DeviceModel.php');
class WebsocketClient
{

    private $_Socket = null;

    public function __construct($host, $port)
    {
        $this->_connect($host, $port);
    }

    public function __destruct()
    {
        $this->_disconnect();
    }

    public function getSocket(){
        return $this->_Socket;
    }

    public function sendData($data)
    {
        if(!$this->_Socket) {
            return false; 
        }else{
            fwrite($this->_Socket, $this->encode($data)) or die('Error:' . $errno . ':' . $errstr);
            return true;
        }

    }

    public function receiveData(){
        if(!$this->_Socket) {
            return false; 
        }else{
            $wsData = fread($this->_Socket, 2000);
            return $wsData;
        }
    }

    private function encode($data)
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

    private function _connect($host, $port)
    {
        
        $key1 = $this->_generateRandomString(32);
        $key2 = $this->_generateRandomString(32);
        $key3 = $this->_generateRandomString(8, false, true);
        $header = "GET / HTTP/1.1\r\n";
        $header .= "Accept-Encoding: gzip, deflate, sdch\r\n";
        $header .= "Accept-Language: zh-CN,zh;q=0.8\r\n";
        $header .= "Cache-Control: no-cache\r\n";
        $header .= "Connection: Upgrade\r\n";
        $header .= "Host: " . $host . ":" . $port . "\r\n";
        $header .= "Origin:http://192.168.1.200\r\n";
        $header .= "Sec-WebSocket-Extensions: permessage-deflate; client_max_window_bits\r\n";
        $header .= "Sec-WebSocket-Key: " . $key1 . "\r\n";
        $header .= "Sec-WebSocket-Version: 13\r\n";
        $header .= "Upgrade: websocket\r\n";
        $header .= "User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36\r\n";
        $header .= "\r\n";
        @$this->_Socket = fsockopen($host, $port, $errno, $errstr, 2);
        if(!$this->_Socket) {
            return false; 
        }else{
            fwrite($this->_Socket, $header) or die('Error: ' . $errno . ':' . $errstr);
            $response = fread($this->_Socket, 2000);
            return true;
        }

        /**
         * @todo: check response here. Currently not implemented cause "2 key handshake" is already deprecated.
         * See: http://en.wikipedia.org/wiki/WebSocket#WebSocket_Protocol_Handshake
         */
        // echo $header."\r\n";
        // echo $response."\r\n";
    }

    private function _disconnect()
    {
        if(!$this->_Socket) {
            return false; 
        }else{
            fclose($this->_Socket);
            return true;
        }
    }

    private function _generateRandomString($length = 10, $addSpaces = true, $addNumbers = true)
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
}


while(true){

    $WebsocketClient = new WebsocketClient('192.168.1.168', '9502');
    unset($WebSocketClient);

    $deviceModel=new DeviceModel();
    //发送操作日志
    $SendHeartBeat = $deviceModel->getDeviceMessage();
    for($i=0;$i<count($SendHeartBeat);$i++){
        $HeartBeat = "class=IntellixlUse&method=SendHeartBeat&params=".$SendHeartBeat[$i]['params'];
        $WebsocketClient->sendData($HeartBeat);
        $receiveData = $WebsocketClient->receiveData(); 
    }
    
    sleep(8);
}
?>