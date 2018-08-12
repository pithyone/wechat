<?php

namespace WeWork\Tests;

use ReflectionClass;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @param object $object
     * @param string $name
     * @param array $args
     * @return \ReflectionMethod
     * @throws \ReflectionException
     */
    protected function callMethod($object, string $name, array $args = [])
    {
        $class = new ReflectionClass($object);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $args);
    }

    /**
     * @inheritdoc
     */
    protected function tearDown()
    {
        parent::tearDown();

        \Mockery::close();
    }
}
