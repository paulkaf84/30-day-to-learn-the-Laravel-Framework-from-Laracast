<?php

namespace App\Models;

use Illuminate\Support\Arr;

class Job {
    public static function all(): array
    {
        return [
            (object) [
                'id' => 0,
                'title' => 'Programmer',
                'salary' => 1_200
            ],
            (object) [
                'id' => 1,
                'title' => 'Manager',
                'salary' => 3_200
            ],
            (object) [
                'id' => 2,
                'title' => 'Sportif',
                'salary' => 10_200
            ],
        ];
    }

    public static function find(int $id): object
    {
        return Arr::first(Job::all(), fn($job) => $job->id == $id) ?? abort(404);
    }
}
