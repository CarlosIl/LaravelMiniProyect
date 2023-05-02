<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriaTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_get_register(){
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function test_post_register(){
        $response = $this->post('/register',[
            'username' => 'Carlos',
            'email' => 'carlosi.alertas@gmail.com',
            'password' =>'12345678',
            'password_confirmation' => '12345678',
        ]);

        $response->assertStatus(200);
    }
}
