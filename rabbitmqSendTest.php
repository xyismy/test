<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/30
 * Time: 22:55
 */

include 'vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

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
//设置交换机并且配置信息
$channel->exchange_declare('test','direct',false,true);
//设置队列并且配置信息
$channel->queue_declare('test',false,true);
//生成消息
$msg = new AMQPMessage('test',array('delivery_mode' => AMQPMessage :: DELIVERY_MODE_PERSISTENT));
//推送到队列
$channel->basic_publish($msg,'','test');
$channel->basic_qos(null,1,null);
//关闭频道
$channel->close();
//关闭连接
$connection->close();
