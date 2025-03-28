<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FacadeTest extends TestCase
{
    public function testFacade()
    {
        $fisrtName = config('contoh.author.first');
        $fisrtName2 = Config::get('contoh.author.first');

        self::assertEquals($fisrtName, $fisrtName2);

        var_dump(Config::all());
    }
    public function testConfigDependency()
    {
        $config = $this->app->make('config');
        $firstName3 = $config->get('contoh.author.first');

        $firstName = config('contoh.author.first');
        $firstName2 = Config::get('contoh.author.first');

        self::assertEquals($firstName, $firstName2);
        self::assertEquals($firstName, $firstName3);

        var_dump(Config::all());
    }
}
