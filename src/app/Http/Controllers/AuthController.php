<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function register()
    {
    return view('auth.register');
    }

        public function store(RegisterRequest $request)
    {
    return redirect('/');
    }

    public function login()
    {
    return view('auth.login');
    }
}
