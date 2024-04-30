<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function create()
    {
        return view('auth-v1.register');
    }

    public function register(UserRegisterRequest $userRegisterRequest)
    {
        $request = $userRegisterRequest->validated();

        User::factory()->create($request);

        if (! Auth::attempt([
            'email' => $request['email'],
            'password' => $request['password'],
        ])) {
            dd('unauthorized');
        }

        $userRegisterRequest->session()->regenerate();

        return redirect()->intended();
    }

    public function login(UserLoginRequest $userLoginRequest)
    {
        $request = $userLoginRequest->validated();

        if (Auth::attempt([
            'email' => $request['email'],
            'password' => $request['password'],
        ])) {
            $userLoginRequest->session()->regenerate();
            return redirect()->intended();
        }

        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }

    public function destroy()
    {
        Auth::logout();
        return redirect()->intended();
    }
}
