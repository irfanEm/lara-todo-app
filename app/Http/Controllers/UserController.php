<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
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
                    'title' => 'Login | Lara Todo App',
                    'error' => 'User dan password tidak boleh kosong !'
                ]);
        }

        if($this->userService->login($user, $password)){
            $request->session()->put('user', $user);
            return redirect('/');
        }

        return response()
            ->view('user.login', [
                'title' => 'Login | Lara Todo App',
                'error' => 'Username atau Password Salah !'
            ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget('user');
        return redirect('/');
    }
}
