<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(10)
            ->create()
            ->each(function ($user) {
                $skills = ['PHP', 'JS', 'Golang', 'Java'];
                shuffle($skills);
                $userSkills = array_slice($skills, 0, rand(1, count($skills)));
                $user->description = implode(', ', $userSkills);
                $user->save();
            });
    }
}
