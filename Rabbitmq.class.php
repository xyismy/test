<?php
/**
 * Created by PhpStorm.
 * User: Xy
 * Date: 2017/11/30
 * Time: 16:24
 */

namespace test;
require_once 'vendor/autoload.php';

class Rabbitmq
{

    /*
     * 连接属性
     */
    public $host = '127.0.0.1';
    public $vhost = '/';
    public $user = 'guest';
    public $password = 'guest';
    public $exchanges = 'dafault';
    public $queue = 'dafault';
    public $Routekey = 'dafault';

    /**
     * 自动连接rabbitmq
     */
    private function __construct(){
        $this->connect();
    }
    
    public function connect($host,$vhost,$user,$password,$exchanges,$queue,$Routekey){

    }
}