<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\AuthService;

class AuthController extends Controller
{
    private $AuthService;

    public  function __construct(AuthService $authService)
    {
        $this->AuthService = $authService;
    }

    public function showLogin()
    {
        return view('home');
    }

    public  function login(){

        $email = request('email');
        $password = request('password');

        echo $email;
        if($this->AuthService->login($email, $password)) {

            return view('home');
        }
    }

    public function register()
    {

    }

}
