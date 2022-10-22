<?php

namespace Database\Seeders;

use App\Models\QuizType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\QuizCategory;

class QuizCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuizCategory::factory()->create([
            'name' => 'Geography',
        ]);

        QuizCategory::factory()->create([
            'name' => 'Entertainment',
        ]);

        QuizCategory::factory()->create([
            'name' => 'Science',
        ]);

        QuizCategory::factory()->create([
            'name' => 'History',
        ]);

        QuizCategory::factory()->create([
            'name' => 'Literature',
        ]);

        QuizCategory::factory()->create([
            'name' => 'Sports',
        ]);

        QuizCategory::factory()->create([
            'name' => 'Language',
        ]);

        QuizCategory::factory()->create([
            'name' => 'Just For Fun',
        ]);

        QuizCategory::factory()->create([
            'name' => 'Religion',
        ]);

        QuizCategory::factory()->create([
            'name' => 'Movies',
        ]);

        QuizCategory::factory()->create([
            'name' => 'Television',
        ]);

        QuizCategory::factory()->create([
            'name' => 'Music',
        ]);

        QuizCategory::factory()->create([
            'name' => 'Gaming',
        ]);

        QuizCategory::factory()->create([
            'name' => 'Miscellaneous',
        ]);

        QuizCategory::factory()->create([
            'name' => 'Holiday',
        ]);
    }
}
