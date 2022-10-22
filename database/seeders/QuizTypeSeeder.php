<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\QuizType;

class QuizTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuizType::factory()->create([
            'name' => 'Classic',
        ]);

        QuizType::factory()->create([
            'name' => 'Clickable',
        ]);

        QuizType::factory()->create([
            'name' => 'Grid',
        ]);

        QuizType::factory()->create([
            'name' => 'Map',
        ]);

        QuizType::factory()->create([
            'name' => 'Multiple Choice',
        ]);

        QuizType::factory()->create([
            'name' => 'Picture Box',
        ]);

        QuizType::factory()->create([
            'name' => 'Picture Click',
        ]);

        QuizType::factory()->create([
            'name' => 'Slideshow',
        ]);
    }
}
