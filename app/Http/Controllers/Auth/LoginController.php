<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        // Validasi input dasar
        $this->validate($request, [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Proses login
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // Jika gagal login
        return $this->sendFailedLoginResponse($request);
    }

    protected function attemptLogin(Request $request)
    {
        // Login tanpa cek status dan tanpa captcha
        return $this->guard()->attempt(
            $this->credentials($request),
            $request->boolean('remember')
        );
    }
}
