<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Quiz;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         User::factory(10)->create();

//        User::factory()->create([
//             'name' => 'Admin',
//             'email' => 'test@example.com',
//             'role_id' => 1,
//             'password' => Hash::make('password'),
//         ]);

        // call additional seeders to be executed.
        $this->call([
            QuizTypeSeeder::class,
            QuizCategorySeeder::class,
            QuizSeeder::class,
        ]);

    }
}
