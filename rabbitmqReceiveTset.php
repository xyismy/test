<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/1
 * Time: 0:08
 */

include 'vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

/**
 * 连接rabbitmq配置
 */
$host = 'localhost';
$port = '5672';
$user = 'guest';
$pawd = 'guest';

//连接rabbitmq
$connection = new AMQPStreamConnection( $host,$port,$user,$pawd );
//设置频道
$channel = $connection->channel();
//设置队列并且配置信息
$channel->queue_declare('hello',false,true);

$callback = function( $msg ){
    var_dump( $msg->body );
};

$channel->basic_consume('hello','', false, true, false, false, $callback);

while(count($channel->callbacks)) {
    $channel->wait();
}



