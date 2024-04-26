<?php

use App\Http\Controllers\JobsController;
use App\Models\Employer;
use App\Models\Job;
use App\Models\User;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;


Route::get('/', function () {
    return view('jobs',
        [
            'jobs' => Job::with("employer")->orderByDesc(column: 'updated_at')->paginate(20)
        ]);
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

Route::get('/jobs', [JobsController::class, 'index'])->name("jobs.index");

Route::get('/jobs/create', [JobsController::class, 'create'])->name("jobs.create");

Route::post('/jobs/store', [JobsController::class, 'store'])->name("jobs.store");

Route::patch('/jobs/{job}', [JobsController::class, 'update'])->name("jobs.update");

Route::delete('/jobs/{job}', [JobsController::class, 'destroy'])->name("jobs.destroy");

Route::get('jobs/{job}', [JobsController::class, 'show'])->name('jobs.show');

Route::get('jobs/{job}/edit', [JobsController::class, 'edit'])->name('jobs.edit');
