<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DependecyInjectionTest extends TestCase
{
    public function test_dependency_injection()
    {
        $foo = new Foo();
        $bar = new Bar($foo); //constructor
        // $bar->setFoo($foo); //dengan function
        // $bar->foo = $foo; //dengan attribute property

        self::assertEquals('foo and Bar', $bar->bar());
    }
}
