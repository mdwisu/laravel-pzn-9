<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testGet()
    {
        $this->get('/dashboard')->assertStatus(200)->assertSeeText('Dashboard');
    }
    public function testRedirect()
    {
        $this->get('/redirect')->assertRedirect('/dashboard');
    }
    public function testFallback()
    {
        $this->get('/tidak-ada')->assertSeeText(404);
    }
}
