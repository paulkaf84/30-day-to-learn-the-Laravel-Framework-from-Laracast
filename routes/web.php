<?php

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

Route::get('/about', function() {
    return view('about');
})->name("about");

Route::get('/jobs', function() {
    return view(
        'jobs',
        [
            'jobs' => Job::with("employer")->orderByDesc(column: 'updated_at')->paginate(20)
        ]
    );
})->name("jobs.index");

Route::get('/jobs/create', function () {
    return view('jobs.create');
})->name("jobs.create");

Route::post('/jobs/store', function (\App\Http\Requests\JobRequest $jobRequest) {
    $job = $jobRequest->validated();

    Job::create([
        'title' => $job['title'],
        'salary' => $job['salary'],
        'employer_id' => Employer::firstOrCreate()->id,
    ]);
    return redirect(\route('jobs.index'));
})/*->middleware([HandlePrecognitiveRequests::class])*/
->name("jobs.store");

Route::patch('/jobs/{id}', function (\App\Http\Requests\JobRequest $jobRequest, $id) {
    $job = $jobRequest->validated();


    Job::findOrFail($id)->update([
        'title' => $job['title'],
        'salary' => $job['salary'],
    ]);
    return redirect(route('jobs.show', ['id' => $id]));
})/*->middleware([HandlePrecognitiveRequests::class])*/
->name("jobs.update");


Route::delete('/jobs/{id}', function ($id) {
    Job::findOrFail($id)->delete();
    return redirect(route('jobs.index'));
})
->name("jobs.destroy");

Route::get('job/{id}', function ($id) {
    $job = Job::find($id);
//    dd($job);

    return view('jobs.show', ['job' => $job]);
})->name('jobs.show');

Route::get('job/{id}/edit', function ($id) {
    $job = Job::find($id);

    return view('jobs.edit', ['job' => $job]);
})->name('jobs.edit');
