<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\RedirectResponse;

class HomeControllerTest extends TestCase
{
    public function testMemberLogin()
    {
        $this->withSession([
            'user' => 'irfanem'
        ])->get('/')
            ->assertRedirect('/todolist');
    }

    public function testGuestLogin()
    {
        $this->get('/')
            ->assertRedirect('/login');
    }
}
