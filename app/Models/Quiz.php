<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type_id',
        'category_id',
        'h_name',
        'h_value',
        'timer',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function type()
    {
        return $this->belongsTo(QuizType::class);
    }

    public function category()
    {
        return $this->belongsTo(QuizCategory::class);
    }

    public function scopeSearchQuiz($query, $search)
    {
        return $query->where('name', 'LIKE', '%' . $search . '%');
    }
}
