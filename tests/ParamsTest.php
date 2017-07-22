<?php

use Slexx\Request\Params;
use PHPUnit\Framework\TestCase;

class ParamsTest extends TestCase
{
    public function testHas()
    {
        $params = new Params(['foo' => 'bar']);
        $this->assertTrue($params->has('foo'));
        $this->assertFalse($params->has('other'));
    }

    public function testGet()
    {
        $params = new Params(['foo' => 'bar']);
        $this->assertEquals('bar', $params->get('foo'));
        $this->assertNull($params->get('other'));
    }

    public function testToArray()
    {
        $this->assertEquals(['foo' => 'bar'], (new Params(['foo' => 'bar']))->toArray());
    }

    public function testToString()
    {
        $this->assertEquals('foo=bar', (string) new Params(['foo' => 'bar']));
    }
}
