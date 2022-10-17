<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'time',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
