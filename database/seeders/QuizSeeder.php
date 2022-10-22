<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Quiz;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Quiz::factory()->create([
            'id' => 6,
            'name' => 'Hiragana',
            'description' => 'Can you name the English syllable that matches the Hiragana character?',
            'type_id' => 1,
            'category_id' => 5,
            'h_name' => 'Hiragana',
            'h_value' => 'English Syllable',
            'timer' => 3,
         ]);

        Quiz::factory()->create([
            'id' => 7,
            'name' => 'Hiragana (Clickable)',
            'description' => 'Can you pick the correct hiragana characters for the rōmaji sounds?',
            'type_id' => 2,
            'category_id' => 5,
            'h_name' => 'Hiragana',
            'h_value' => 'English Syllable',
            'timer' => 5,
        ]);
    }
}
