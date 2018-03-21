<?php

use PHPUnit\Framework\TestCase;

final class MathTest extends TestCase
{
    public function testSum() : void
    {
        $this->assertEquals(Math::sum(5, 5), 10);
    }
}