<?php
/**
 * This file is part of `lemonphp/container` project.
 *
 * (c) 2015-2016 LemonPHP Team
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Lemon\Container\Tests;

use Lemon\Container\Container;
use Lemon\Container\Exception\ContainerException;
use Lemon\Container\Exception\NotFoundException;

class ContainerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Lemon\Container\Container;
     */
    protected $container;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->container = new Container([
            'foo' => 'bar',
            'null' => null,
            'int' => 1,
            'factory' => function () {
                return new \stdClass();
            }
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        $this->container = null;

        parent::tearDown();
    }

    /**
     * Test `get()` method
     */
    public function testGet()
    {
        $now = new \DateTime();
        $this->container['now'] = $now;

        $this->assertSame('bar', $this->container->get('foo'));
        $this->assertSame(1, $this->container->get('int'));
        $this->assertSame(null, $this->container->get('null'));
        $this->assertSame($now, $this->container->get('now'));
        $this->assertInstanceOf('\stdClass', $this->container->get('factory'));
    }

    /**
     * Test `get()` method with case: value not found in container
     */
    public function testGetWithNotFoundError()
    {
        $this->setExpectedException('\Lemon\Container\Exception\NotFoundException');

        $this->container->get('doesnt-exist');
    }

    /**
     * Test `get()` method with case: factory closure throw an exception, that is value not found in container
     */
    public function testGetWithNotFoundErrorThrownByFactoryClosure()
    {
        $this->container['foo'] = function () {
            throw new NotFoundException();
        };
        $this->setExpectedException('\Lemon\Container\Exception\ContainerException');

        $this->container->get('foo');
    }

    /**
     * Test `get()` method with case: factory closure throw an exception, that is error in container
     */
    public function testGetWithContainerErrorThrownByFactoryClosure()
    {
        $this->container['foo'] = function () {
            throw new ContainerException();
        };
        $this->setExpectedException('\Lemon\Container\Exception\ContainerException');

        $this->container->get('foo');
    }

    /**
     * Test `get()` method with case: factory closure throw an exception, that isn't container exception
     */
    public function testGetWithOtherErrorThrownByFactoryClosure()
    {
        $this->container['foo'] = function () {
            throw new \UnexpectedValueException();
        };
        $this->setExpectedException('\UnexpectedValueException');

        $this->container->get('foo');
    }

    /**
     * Test `has()` method
     */
    public function testHas()
    {
        $this->assertTrue($this->container->has('foo'));
        $this->assertTrue($this->container->has('int'));
        $this->assertTrue($this->container->has('null'));
        $this->assertTrue($this->container->has('factory'));
        $this->assertFalse($this->container->has('doesnt-exist'));
    }
}
