<?php

namespace Database\Factories;

use App\Models\Employer;
use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    protected $model = Job::class;

    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle(),
            'employer_id' => Employer::factory(),
            'salary' => fake()->randomElement(["$50,000 USD", "$60,000 USD", "$70,000 USD", "$80,000 USD", "$90,000 USD", "$100,000 USD"]),
        ];
    }
}
