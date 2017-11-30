<?php
/**
 * Created by PhpStorm.
 * User: Xy
 * Date: 2017/11/3
 * Time: 17:11
 */

use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    public function testPushAndPop()
    {
        $stack = [];
        $this->assertEquals(0, count($stack));

        array_push($stack, 'foo');
        $this->assertEquals('foo', $stack[count($stack) - 1]);
        $this->assertEquals(1, count($stack));

        $this->assertEquals('foo', array_pop($stack));
        $this->assertEquals(0, count($stack));

    }
}
