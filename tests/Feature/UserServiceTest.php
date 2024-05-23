<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\UserService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    public function setUp(): void
    {
        parent::setUp();

        $this->userService = $this->app->make(UserService::class);
    }

    public function testUserServiceNotNull()
    {
        self::assertNotNull($this->userService);
    }

    public function testLoginSuccess()
    {
        self::assertTrue($this->userService->login("irfanem", "irfan2711"));
    }

    public function testUserNotFound()
    {
        self::assertFalse($this->userService->login("balqis", "farahAnabila"));
    }

    public function testWrongPassword()
    {
        self::assertFalse($this->userService->login("irfanem", "irfan2611"));
    }
}
