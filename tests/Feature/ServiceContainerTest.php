<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
    public function testDependecy()
    {
        // $foo = new Foo();
        $foo1 = $this->app->make(Foo::class); // new Foo()
        $foo2 = $this->app->make(Foo::class); // new Foo()

        self::assertEquals('foo', $foo1->foo());
        self::assertEquals('foo', $foo2->foo());
        self::assertNotSame($foo1, $foo2);
    }

    public function testBind()
    {
        $this->app->bind(Person::class, function () {
            return new Person('John', 'Doe');
        });
        $person1 = $this->app->make(Person::class); // closure() // new Person('John', 'Doe')
        $person2 = $this->app->make(Person::class); // closure() // new Person('John', 'Doe')

        self::assertEquals('John', $person1->firstName);
        self::assertEquals('John', $person2->firstName);
        self::assertNotSame($person1, $person2);
    }

    public function testSingleton()
    {
        $this->app->singleton(Person::class, function () {
            return new Person('John', 'Doe');
        });
        $person1 = $this->app->make(Person::class); // new Person('John', 'Doe')
        $person2 = $this->app->make(Person::class); // return existing

        self::assertEquals('John', $person1->firstName);
        self::assertEquals('John', $person2->firstName);
        self::assertSame($person1, $person2);
    }
    public function testInstance()
    {
        $person = new Person('John', 'Doe');
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class); // $person
        $person2 = $this->app->make(Person::class); // $person

        self::assertEquals('John', $person1->firstName);
        self::assertEquals('John', $person2->firstName);
        self::assertSame($person1, $person2);
    }

    public function testDependecyInjection()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });
        $this->app->singleton(Bar::class, function ($app) {
            return new Bar($app->make(Foo::class));
        });

        $foo = $this->app->make(Foo::class); // new Foo()
        $bar = $this->app->make(Bar::class); // new Bar(new Foo())
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($foo, $bar->foo);
        self::assertSame($bar, $bar2);
    }

    public function testInterfaceToClass()
    {
        // $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);
        $this->app->singleton(HelloService::class, function ($app) {
            return new HelloServiceIndonesia();
        });
        
        $helloService = $this->app->make(HelloService::class);

        self::assertEquals('Halo Dwi', $helloService->hello('Dwi'));
    }
}
