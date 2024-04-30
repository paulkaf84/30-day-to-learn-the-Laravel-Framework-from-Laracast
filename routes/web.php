<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobsController;
use App\Http\Requests\UserRegisterRequest;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::view('/', 'jobs',
    [
        'jobs' => Job::with('employer')->orderByDesc(column: 'updated_at')->paginate(20),
    ]
)->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/auth/{provider}/redirect', function ($provider) {
    return Socialite::driver($provider)->redirect();
});

Route::get('/auth/{provider}/callback', function ($provider) {
    $socialiteUser = Socialite::driver($provider)->user();

    $user = User::firstOrCreate(
        [
            'email' => $socialiteUser->getEmail(),
        ],
        [
            'name' => $socialiteUser->getName(),
            'email' => $socialiteUser->getEmail(),
            'provider_id' => $socialiteUser->getId(),
            'profile_photo_path' => $socialiteUser->getAvatar(),
        ]
    );

    auth()->login($user);

    return redirect('/dashboard');
});

Route::resource('jobs', JobsController::class);


// CUSTOM AUTH

Route::prefix('auth-v1')->group(function () {
    Route::view('login', 'auth-v1.login')->name('auth-v1.login-view');
    Route::post('login', [AuthController::class, 'login'])->name('auth-v1.login');

    Route::view('register', 'auth-v1.register')->name('auth-v1.register-view');
    Route::post('register', [AuthController::class, 'register'])->name('auth-v1.register');

    Route::post('logout', [AuthController::class, 'destroy'])->name('auth-v1.logout');
});
