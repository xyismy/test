<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/30
 * Time: 22:55
 * 生产者模式
 */

include 'vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * 连接rabbitmq配置
 * $host 主机
 * $port 端口
 * $user 用户
 * $pawd 密码
 */
$host = 'localhost';
$port = '5672';
$user = 'guest';
$pawd = 'guest';

//连接rabbitmq
$connection = new AMQPStreamConnection( $host,$port,$user,$pawd );

//设置频道
$channel = $connection->channel();

/*
 * 设置交换机并且配置信息
 * exchange 交换机名称
 * type 交换机类型：direct(直连)，fanout(扇形)，topic(主题)，headers(首部)
 * passive
 * durable 交换机持久化
 */
$channel->exchange_declare('test','direct',false,true);

/*
 * 设置队列并且配置信息
 * queue 队列名称
 * passive
 * durable 队列持久化
 */
$channel->queue_declare('test',false,true);

/*
 * 生成消息
 * body 消息内容
 * delivery_mode 设置为AMQPMessage :: DELIVERY_MODE_PERSISTENT等于持久化，默认不持久化
 */
$msg = new AMQPMessage('test',array('delivery_mode' => 2 ));

/*
 * 推送到队列
 * $msg 消息
 * exchange 频道
 * roting_key 路由Key
 */
$channel->basic_publish($msg,'','test');

/*
 * 设置处理完一条消息再推送下一条
 */
$channel->basic_qos(null,1,null);

/*
 * 关闭频道
 */
$channel->close();

/*
 * 关闭连接
 */
$connection->close();
