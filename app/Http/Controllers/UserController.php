<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(): Response
    {
        return response()
            ->view('user.login', [
                "title" => "Login Management"
            ]);
    }

    public function logAct(Request $request)
    {
        $user = $request->input('user');
        $password = $request->input('password');

        if(empty($user) || empty($password)){
            return response()
                ->view('user.login', [
                    'title' => 'Login Management',
                    'error' => 'User dan password tidak boleh kosong !'
                ]);
        }

        if($this->userService->login($user, $password)){
            $request->session()->put('user', $user);
            return response()
                ->view('/');
        }

        return response()
            ->view('user.login', [
                'title' => 'Login Management',
                'error' => 'Password / Password Salah !'
            ]);
    }

    public function logout()
    {

    }
}
