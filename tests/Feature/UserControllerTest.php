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

    public function testLoginPageForMember()
    {
        $this->withSession([
            'user' => 'irfanem'
        ])->get('/login')
            ->assertRedirect('/');
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
            ->assertSeeText('Username atau Password Salah !');
    }

    public function testLoginSuccess(){
        $this->post("/login", [
            'user' => 'irfanem',
            'password' => 'irfan2711'
        ])
            ->assertSessionHas('user', 'irfanem');
    }

    public function testLoginForAlreadyLogin(){
        $this->withSession([
            'user' => 'irfanem'
        ])->post("/login", [
            'user' => 'irfanem',
            'password' => 'irfan2711'
        ])
            ->assertRedirect('/');
    }

    public function testLogout(){
        $this->withSession([
            'user' => 'irfanem'
        ])
            ->post('/logout')
            ->assertRedirect('/')
            ->assertSessionMissing('user');
    }
}
