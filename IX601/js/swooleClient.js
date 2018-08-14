        var wsServer;
        var websocket;
        $(window).load(initIP());


        function initIP(){    
          //动态生成设备表
           $.get("../Utils/GetServerInfo.php?method=GetServerIP",{},function(resp){ 
              wsServer = 'ws://'+resp+':9502';
              //wsServer = 'ws://'+'16d77t2517.iask.in:10741';
              websocket = new WebSocket(wsServer);
              // console.log(wsServer);
              websocket.onopen = function (evt) {
                    //websocket.readyState 属性：
                    /*
                    CONNECTING    0    The connection is not yet open.
                    OPEN    1    The connection is open and ready to communicate.
                    CLOSING    2    The connection is in the process of closing.
                    CLOSED    3    The connection is closed or couldn't be opened.
                    */
                   // msg.innerHTML = websocket.readyState;
              };
              //监听连接关闭
              websocket.onclose = function (evt) {
                console.log("Disconnected");
              };

              //onmessage 监听服务器数据推送
              websocket.onmessage = function (evt) {
                close_loading();
                console.log(evt.data);
                if(evt.data != "下发成功"){
                  $.alert(evt.data);
                }                 
              };
              //监听连接错误信息
              websocket.onerror = function (evt, e) {
                console.log('Error occured: ' + evt.data);
              };
            });
        }

        function postOrder(type,deviceId,movieId,movieName){
            //向服务器发送数据
            if(type=="play"){
              var text ='class=IntellixlUse&method=SetPlayFilm&params={"deviceid":"'+deviceId+'","id":"'+movieId+'","file_name":"'+movieName+'","class":"0","data":{}}';
            }else if(type=="stop"){
              var text ='class=IntellixlUse&method=SetStopFilm&params={"deviceid":"'+deviceId+'","id":"'+movieId+'","file_name":"'+movieName+'","class":"0","data":{}}';
            }else{
              var text ='class=IntellixlUse&method=SetPlayList&params={"deviceid":"'+deviceId+'","data":{"count":"'+movieId+'","data_list":'+movieName+'}}';
            }
            
            websocket.send(text);
        }


    
