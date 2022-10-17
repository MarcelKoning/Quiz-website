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
        'type',
        'h_name',
        'h_value',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function scopeSearchQuiz($query, $search)
    {
        return $query->where('name', 'LIKE', '%' . $search . '%');
    }
}
