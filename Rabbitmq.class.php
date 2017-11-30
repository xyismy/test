<?php
/**
 * Created by PhpStorm.
 * User: Xy
 * Date: 2017/11/30
 * Time: 16:24
 */

namespace test;
require_once 'vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Rabbitmq
{

    /*
     * 连接属性
     */
    private $host = '127.0.0.1';
    private $port = '5672';
    private $vhost = '/';
    private $user = 'guest';
    private $password = 'guest';

    /*
     * 交换机，队列，路由设置
     */
    private $exchanges = 'dafault';
    private $queue = 'dafault';
    private $routekey = 'dafault';

    /**
     * 构造函数
     */
    private function __construct( $rabbitmqConfig ){

    }

    private function set_config(){

    }

    private function connect(){

    }




}