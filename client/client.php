<?php
/**
 * client
 */

function writeMsg($message = "Hello Everybody")
{
    $host = "127.0.0.1";
    $port = 9300;
    // $client = new Swoole\Client(SWOOLE_TCP | SWOOLE_ASYNC | SWOOLE_SSL);
    $client = new \swoole_client(SWOOLE_SOCK_TCP);
    // 连接远程服务器：bool $swoole_client->connect(string $host, int $port, float $timeout = 0.1, int $flag = 0)
    if (!$client->connect($host, $port, 1)) {
        echo "Error: {$client->errMsg}[{$client->errCode}]\n";
    }
    // 转码发送发送给服务端
    $client->send($message);

    // 从服务器接收数据
    $data = $client->recv();
    if (!$data) {
        die("recv failed.");
    }
    echo $data;
    // 关闭连接
    $client->close();
}

writeMsg();
