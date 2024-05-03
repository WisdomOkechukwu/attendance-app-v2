<?php

namespace Database\Seeders;

use App\Models\DiscipleshipClassHistory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MemberClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $times = 1;

        for ($i=0; $i < $times; $i++) {
            $data =  [
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'phone' => fake()->phoneNumber(),
                'wa_phone' => fake()->phoneNumber(),
                'address' => fake()->address(),
                'password' => Hash::make('password'),
                'service_unit_id' => fake()->numberBetween(null, 7),
                'discipleship_class_id' => fake()->numberBetween(1, 5),
                'role' => 1,
                'remember_token' => Str::random(10),
            ];
            $user = User::create($data);

            $discipleshipLog = new DiscipleshipClassHistory();
            $discipleshipLog->discipleship_class_id = $data['discipleship_class_id'];
            $discipleshipLog->user_id = $user->id;
            $discipleshipLog->save();
        }
    }
}
