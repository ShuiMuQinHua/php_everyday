<?php
//socket 客户端
/*
 +-------------------------------
 *    @client链接socket过程
 +-------------------------------
 *    @socket_create
 *    @socket_connect
 *    @socket_write
 *    @socket_read
 *    @socket_close
 +--------------------------------
 */
//设置不超时并打印所以错误
error_reporting(0);
set_time_limit(0);
//地址和端口号
$address = "127.0.0.1";
$port = 10000;
//创建socket链接
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket === false) {
    echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
    die;
} else {
    echo "socket successfully created.\n";
}
//连接到地址和端口号
echo "Attempting to connect to '$address' on port '$port'...\n";
$result = socket_connect($socket, $address, $port);
if ($result === false) {
    echo "socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
    die;
} else {
    echo "successfully connected to $address.\n";
}
//发给 server
$msg ="hello,I'm client\n";
socket_write($socket, $msg, strlen($msg));
echo "send to server: $msg\n";
//接收 server的消息
$buf = socket_read($socket, 8192);
echo "recvice from server: $buf\n";
echo "Closing socket...";
socket_close($socket);