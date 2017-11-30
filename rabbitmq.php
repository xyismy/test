<?php

//phpinfo();

$rabbiltConfig = array(
	'host' => '127.0.0.1',
	'port' => '5672',
	'login'=> 'aibbai',
	'password'=>'d#23g.4qsg!s4',
	'vhost' => 'aibbai',

);
$e_name = 'createaccount_exchange'; //交换机名
$q_name = 'createaccount_queue'; //队列名
$k_route = 'jointpay_key'; //路由key

//创建连接和channel
$conn = new AMQPConnection($rabbiltConfig);

if (!$conn->connect()) {
    die("Cannot connect to the broker!\n");
}

$channel = new AMQPChannel($conn);

//创建交换机
$ex = new AMQPExchange($channel);
$ex->setName($e_name);
$ex->setType(AMQP_EX_TYPE_DIRECT); //direct类型
$ex->setFlags(AMQP_DURABLE); //持久化
echo "Exchange Status:".$ex->declare()."\n";

//创建队列
$q = new AMQPQueue($channel);
$q->setName($q_name);
$q->setFlags(AMQP_DURABLE);
echo "Message Total:".$q->declare()."\n";

echo 'Queue Bind: '.$q->bind($e_name, $k_route)."\n";

echo "Send Message:".$ex->publish("TEST MESSAGE，key_1 by xust" . date('H:i:s', time()),$k_route,AMQP_NOPARAM,array('delivery_mode'=>2)).PHP_EOL;
echo "Send Message:".$ex->publish("TEST MESSAGE，key_1 by xust" . date('H:i:s', time()),$k_route,AMQP_NOPARAM,array('delivery_mode'=>2)).PHP_EOL;