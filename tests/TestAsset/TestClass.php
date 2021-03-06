<?php

namespace Pop\Utils\Test\TestAsset;

class TestClass
{
    protected $foo = null;

    public function __construct($foo = null)
    {
        if (null !== $foo) {
            $this->foo = $foo;
        }
    }

    public function setFoo($foo)
    {
        $this->foo = $foo;
        return $this;
    }

    public function addFoo($foo)
    {
        $this->foo .= $foo;
        return $this;
    }

    public function getFoo()
    {
        return $this->foo;
    }

    public function printFoo()
    {
        return $this->foo;
    }

    public static function sayHello($name)
    {
        return 'Hello, ' . $name;
    }
}
