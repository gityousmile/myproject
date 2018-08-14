<?php

  header("Content-Type:text/html; charset=utf-8");
    $curl = curl_init();
    //设置抓取的url
    curl_setopt($curl, CURLOPT_URL, 'http://192.168.1.49/index.php/Home/Interface/index?class=HallUse&method=getVideoList&params=%7B%22down_status%22%3A%222%22%2C%22%22%3A%22%22%7Ds');
    //设置头文件的信息作为数据流输出
    curl_setopt($curl, CURLOPT_HEADER, 0);
    //设置获取的信息以文件流的形式返回，而不是直接输出。
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    //执行命令
    $data = curl_exec($curl);

    $obj = json_decode($data,true);
    //关闭URL请求
    curl_close($curl);
    //显示获得的数据
    $count=$obj["data"]["count"];
    $list=$obj["data"]["data_list"];
    // print_r($list);
    for($i=2;$i<=$count/15+1;$i++){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'http://192.168.1.49/Home/Interface/index?class=HallUse&method=getVideoList&params={"down_status":"2","page_size":"15","page":"'.$i.'"}');
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 0);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($curl);
        $obj = json_decode($data,true);
        curl_close($curl);

        $list2=$obj["data"]["data_list"];
        print_r($data);
        // $list=array_merge($list,$list2);
    }
?>