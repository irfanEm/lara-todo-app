<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginView()
    {
        $this->get('/login')
            ->assertSeeText('Login');
    }

    public function testUserPasswordKosong(){
        $this->post('/login', [])
            ->assertSeeText('User dan password tidak boleh kosong !');
    }

    public function testUserPasswordSalah()
    {
        $this->post('/login', [
            'user' => 'Salah',
            'password' => 'Salah'
        ])
            ->assertSeeText('Password / Password Salah !');
    }
}
