<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RandomUserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserWithText()
    {
        $response = $this->get('/random_user/abce');

        $response->assertStatus(400);
    }

    public function testUserWithNoParameters()
    {
        $response = $this->get('/random_user/');

        $response->assertStatus(200);
    }

    public function testUserWithNumbers()
    {
        $response = $this->get('/random_user/5');

        $response->assertStatus(200);
    }

    public function testUserWithNegativeeNumbers()
    {
        $response = $this->get('/random_user/-5');

        $response->assertStatus(200);
    }

    public function testUserWithZero()
    {
        $response = $this->get('/random_user/0');

        $response->assertStatus(200);
    }


}
