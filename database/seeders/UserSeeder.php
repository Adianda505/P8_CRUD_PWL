<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $npm = $faker->unique()->numerify('##########');

            $user = User::Create([
                'npm' => 123456789,
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'email' => 'mahasiswa12@gmail.com',
                'password' => bcrypt('12345678'),
            ]);
            $user->assignRole('mahasiswa');
    }
}
