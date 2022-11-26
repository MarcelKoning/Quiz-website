<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'user_id',
        'user_room_id',
        'answer',
        'is_correct',
    ];

    public function userRoom()
    {
        return $this->belongsTo(UserRoom::class);
    }
}
