<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Question;

class QuizQuestion extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /* Japanese Starter Phrases Quiz */

        Quiz::factory()->create([
            'id' => 8,
            'name' => 'Hiragana First Words',
            'description' => 'Starter Phrases',
            'type_id' => 1,
            'category_id' => 5,
            'h_name' => 'Japanese Phrase',
            'h_value' => 'English Phrase',
            'timer' => 3,
         ]);

        Question::factory()->create([
            'id' => 95,
            'quiz_id' => 8,
            'question' => 'こんにちは',
            'type' => '',
            'correct_answer' => 'Hello',
        ]);
        Question::factory()->create([
            'id' => 96,
            'quiz_id' => 8,
            'question' => 'はい',
            'type' => '',
            'correct_answer' => 'Yes',
        ]);
        Question::factory()->create([
            'id' => 97,
            'quiz_id' => 8,
            'question' => 'はい お願いします',
            'type' => '',
            'correct_answer' => 'Yes please',
        ]);
        Question::factory()->create([
            'id' => 98,
            'quiz_id' => 8,
            'question' => 'いいえ',
            'type' => '',
            'correct_answer' => 'No',
        ]);
        Question::factory()->create([
            'id' => 99,
            'quiz_id' => 8,
            'question' => '結構 です',
            'type' => '',
            'correct_answer' => 'No thanks',
        ]);
        Question::factory()->create([
            'id' => 100,
            'quiz_id' => 8,
            'question' => 'お願いします',
            'type' => '',
            'correct_answer' => 'Please',
        ]);
        Question::factory()->create([
            'id' => 101,
            'quiz_id' => 8,
            'question' => 'ありがとうございます',
            'type' => '',
            'correct_answer' => 'Thank you',
        ]);

        Question::factory()->create([
            'id' => 102,
            'quiz_id' => 8,
            'question' => 'どうもありがとうございます',
            'type' => '',
            'correct_answer' => 'Thank you very much',
        ]);
        Question::factory()->create([
            'id' => 103,
            'quiz_id' => 8,
            'question' => 'どういたしまして',
            'type' => '',
            'correct_answer' => "You're welcome",
        ]);
        Question::factory()->create([
            'id' => 104,
            'quiz_id' => 8,
            'question' => '一',
            'type' => '',
            'correct_answer' => 'One',
        ]);
        Question::factory()->create([
            'id' => 105,
            'quiz_id' => 8,
            'question' => '二',
            'type' => '',
            'correct_answer' => 'Two',
        ]);
        Question::factory()->create([
            'id' => 106,
            'quiz_id' => 8,
            'question' => '三',
            'type' => '',
            'correct_answer' => 'Three',
        ]);
        Question::factory()->create([
            'id' => 107,
            'quiz_id' => 8,
            'question' => 'コーヒーを下さい',
            'type' => '',
            'correct_answer' => "I'd like a coffe please",
        ]);
        Question::factory()->create([
            'id' => 108,
            'quiz_id' => 8,
            'question' => 'ビールを二つ下さい',
            'type' => '',
            'correct_answer' => 'Two beers please',
        ]);
        Question::factory()->create([
            'id' => 109,
            'quiz_id' => 8,
            'question' => 'バス',
            'type' => '',
            'correct_answer' => 'Bus',
        ]);
        Question::factory()->create([
            'id' => 110,
            'quiz_id' => 8,
            'question' => '車',
            'type' => '',
            'correct_answer' => 'Car',
        ]);
        Question::factory()->create([
            'id' => 111,
            'quiz_id' => 8,
            'question' => 'タクシー',
            'type' => '',
            'correct_answer' => 'Taxi',
        ]);
        Question::factory()->create([
            'id' => 112,
            'quiz_id' => 8,
            'question' => '電車',
            'type' => '',
            'correct_answer' => 'Train',
        ]);
        Question::factory()->create([
            'id' => 113,
            'quiz_id' => 8,
            'question' => '駅',
            'type' => '',
            'correct_answer' => 'Railway station',
        ]);
        Question::factory()->create([
            'id' => 114,
            'quiz_id' => 8,
            'question' => '空港',
            'type' => '',
            'correct_answer' => 'Airport',
        ]);
        Question::factory()->create([
            'id' => 115,
            'quiz_id' => 8,
            'question' => 'ホテル',
            'type' => '',
            'correct_answer' => 'Hotel',
        ]);
        Question::factory()->create([
            'id' => 116,
            'quiz_id' => 8,
            'question' => 'パスポート',
            'type' => '',
            'correct_answer' => 'Passport',
        ]);
        Question::factory()->create([
            'id' => 117,
            'quiz_id' => 8,
            'question' => '電話',
            'type' => '',
            'correct_answer' => 'Telephone',
        ]);
        Question::factory()->create([
            'id' => 118,
            'quiz_id' => 8,
            'question' => 'すみません',
            'type' => '',
            'correct_answer' => 'Excuse me',
        ]);
        Question::factory()->create([
            'id' => 119,
            'quiz_id' => 8,
            'question' => '何時 ですか',
            'type' => '',
            'correct_answer' => 'What time is it',
        ]);
        Question::factory()->create([
            'id' => 120,
            'quiz_id' => 8,
            'question' => 'もう一度言って くれますか',
            'type' => '',
            'correct_answer' => 'Can you repeat that please',
        ]);
        Question::factory()->create([
            'id' => 121,
            'quiz_id' => 8,
            'question' => 'もう少しゆっくり話してください',
            'type' => '',
            'correct_answer' => 'Please speak more slowly',
        ]);
        Question::factory()->create([
            'id' => 122,
            'quiz_id' => 8,
            'question' => '分かりません',
            'type' => '',
            'correct_answer' => "I don't understand",
        ]);
        Question::factory()->create([
            'id' => 123,
            'quiz_id' => 8,
            'question' => 'ごめんなさい',
            'type' => '',
            'correct_answer' => 'Sorry',
        ]);
        Question::factory()->create([
            'id' => 124,
            'quiz_id' => 8,
            'question' => 'トイレはどこですか',
            'type' => '',
            'correct_answer' => 'Where are the toilets',
        ]);
        Question::factory()->create([
            'id' => 125,
            'quiz_id' => 8,
            'question' => '女子トイレ',
            'type' => '',
            'correct_answer' => 'Ladies Toilet',
        ]);
        Question::factory()->create([
            'id' => 126,
            'quiz_id' => 8,
            'question' => '男子トイレ',
            'type' => '',
            'correct_answer' => "Gents Toilet, Men's restroom",
        ]);
        Question::factory()->create([
            'id' => 127,
            'quiz_id' => 8,
            'question' => '海岸はどこですか',
            'type' => '',
            'correct_answer' => 'Where is the beach',
        ]);
        Question::factory()->create([
            'id' => 128,
            'quiz_id' => 8,
            'question' => '銀行はどこですか',
            'type' => '',
            'correct_answer' => 'Where is the bank',
        ]);
        Question::factory()->create([
            'id' => 129,
            'quiz_id' => 8,
            'question' => 'これかいくらですか',
            'type' => '',
            'correct_answer' => 'How much does this cost',
        ]);
        Question::factory()->create([
            'id' => 130,
            'quiz_id' => 8,
            'question' => 'クレジットカード',
            'type' => '',
            'correct_answer' => 'Credit card',
        ]);
        Question::factory()->create([
            'id' => 131,
            'quiz_id' => 8,
            'question' => 'ATM',
            'type' => '',
            'correct_answer' => 'Cash machine',
        ]);
        Question::factory()->create([
            'id' => 132,
            'quiz_id' => 8,
            'question' => '左様なら',
            'type' => '',
            'correct_answer' => 'Goodbye',
        ]);
        Question::factory()->create([
            'id' => 133,
            'quiz_id' => 8,
            'question' => '鎮痛剤',
            'type' => '',
            'correct_answer' => 'Paracetamol',
        ]);
        Question::factory()->create([
            'id' => 134,
            'quiz_id' => 8,
            'question' => '鍵',
            'type' => '',
            'correct_answer' => 'Keys',
        ]);
        Question::factory()->create([
            'id' => 135,
            'quiz_id' => 8,
            'question' => '地図',
            'type' => '',
            'correct_answer' => 'Map',
        ]);
        Question::factory()->create([
            'id' => 136,
            'quiz_id' => 8,
            'question' => '左',
            'type' => '',
            'correct_answer' => 'Left',
        ]);
        Question::factory()->create([
            'id' => 137,
            'quiz_id' => 8,
            'question' => '右',
            'type' => '',
            'correct_answer' => 'Right',
        ]);

    }
}
