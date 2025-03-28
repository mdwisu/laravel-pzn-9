<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Services\HelloService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FooBarServiceProviderTest extends TestCase
{
    public function test_foo_bar_service_provider()
    {
        $foo1 = $this->app->make(Foo::class); // new Foo()
        $foo2 = $this->app->make(Foo::class); // new Foo()

        self::assertSame($foo1, $foo2);

        $bar1 = $this->app->make(Bar::class); // new Bar(new Foo())
        $bar2 = $this->app->make(Bar::class); // new Bar(new Foo())

        self::assertSame($bar1, $bar2);
    }

    public function testPropertySingleton()
    {
        $helloService1 = $this->app->make(HelloService::class);
        $helloService2 = $this->app->make(HelloService::class);

        self::assertSame($helloService1, $helloService2);

        self::assertEquals('Halo Dwi', $helloService1->hello('Dwi'));
    }
}
