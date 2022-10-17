<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
        'type',
    ];

    public function userRoom()
    {
        return $this->hasOne(userRoom::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
