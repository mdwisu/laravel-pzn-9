<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Env;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    public function test_environment()
    {
        $youtube = env('YOUTUBE');

        self::assertEquals('PZN', $youtube);
    }

    public function testDefaultEnvironment()
    {
        $author = Env::get('AUTHOR', "Dwi");
        self::assertEquals('Dwi', $author);
    }
}
