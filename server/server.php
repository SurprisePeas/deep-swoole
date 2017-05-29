<?php
/**
 * client
 */

$host = "127.0.0.1";
$port = 9300;

// 创建 server 并监听9300端口
$server = new \swoole_server($host, $port);

//监听连接进入事件
$server->on('connect', function ($server, $fd) {  
    echo "Client: Connect.\n";
});

//监听收到数据事件
$server->on('receive', function ($serv, $fd, $from_id, $data) {
    $serv->send($fd, 'Swoole: '.$data);
    $serv->close($fd);
});

//监听连接关闭事件
$server->on('close', function ($server, $fd) {
    echo "Client: Close.\n";
});

//启动服务器
$server->start(); 