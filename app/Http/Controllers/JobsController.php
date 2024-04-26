<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Employer;
use App\Models\Job;

class JobsController extends Controller
{
    public function index()
    {
        return view(
            'jobs',
            [
                'jobs' => Job::with("employer")->orderByDesc(column: 'updated_at')->paginate(20)
            ]
        );
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(JobRequest $request)
    {
        $job = $request->validated();

        Job::create([
            'title' => $job['title'],
            'salary' => $job['salary'],
            'employer_id' => Employer::firstOrCreate()->id,
        ]);
        return redirect(route('jobs.index'));
    }

    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    }

    public function edit(Job $job)
    {
        return view('jobs.edit', compact('job'));
    }

    public function update(JobRequest $request, Job $job)
    {
        $updated = $request->validated();
        $job->update([
            'title' => $updated['title'],
            'salary' => $updated['salary'],
        ]);
        return redirect(route('jobs.show', $job));
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return redirect(route('jobs.index'));
    }
}

