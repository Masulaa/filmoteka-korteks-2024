<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ];
    }

    public function specificUser()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Test',
                'email' => 'test@test.com',
                'password' => bcrypt('password'),
            ];
        });
    }
}
