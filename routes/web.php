<?php

use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;


Route::get('/', function () {
    return view('welcome');
})->name("home");

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

//LARACAST LEARNING PATH

Route::get('/about', function() {
    return view('about');
})->name("about");

Route::get('/job', function() {
    return view(
        'contact',
        [
            'jobs' => Job::with("employer")->paginate(20)
        ]
    );
})->name("job");

Route::get('job/{id}', function ($id) {
    $job = Job::find($id);

    return view('jobs.show', ['job' => $job]);
})->name('job.show');
