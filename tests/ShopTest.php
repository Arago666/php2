<?php

namespace app\tests;

use PHPUnit\Framework\TestCase;

class ShopTest extends TestCase
{
    public function testAdd(){
        $x = 1;
        $y = 2;
        $this->assertEquals(3, $x + $y);
    }

    public function testArr(){
        $this->assertIsArray([]);
    }

}