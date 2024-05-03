<?php

namespace Database\Factories;

use App\Models\DiscipleshipClassHistory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [];
        // $data =  [
        //     'name' => fake()->name(),
        //     'email' => fake()->unique()->safeEmail(),
        //     'email_verified_at' => now(),
        //     'phone' => fake()->phoneNumber(),
        //     'wa_phone' => fake()->phoneNumber(),
        //     'address' => fake()->address(),
        //     'location' => 'Port Harcourt',
        //     'password' => Hash::make('password'),
        //     'service_unit_id' => fake()->numberBetween(1, 7),
        //     'discipleship_class_id' => fake()->numberBetween(1, 5),
        //     'role' => 1,
        //     'remember_token' => Str::random(10),
        // ];

        // $discipleshipLog = new DiscipleshipClassHistory();
        // $discipleshipLog->discipleship_class_id = $data['discipleship_class_id'];
        // $discipleshipLog->user_id = $user->id;
        // $discipleshipLog->save();

        // return $data;
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
