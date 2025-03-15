<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
    public function test_configuration()
    {
        $firstName = config('contoh.author.first');
        $lastName = config('contoh.author.last');
        $age = config('contoh.age');
        $email = config('contoh.email');
        $web = config('contoh.web');

        self::assertEquals('John', $firstName);
        self::assertEquals('Doe', $lastName);
        self::assertEquals(30, $age);
        self::assertEquals('3mBx0@example.com', $email);
        self::assertEquals('https://example.com', $web);
    }
}
