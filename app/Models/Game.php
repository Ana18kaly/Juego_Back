<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_1',
        'user_2',
        'start_at',
        'is_active',
        'won',
        'turn',
        'board1',
        'board2',
        'hits1',
        'hits2'
    ];

    // Relaciones
    public function user1()
    {
        return $this->belongsTo(User::class, 'user_1');
    }

    public function user2()
    {
        return $this->belongsTo(User::class, 'user_2');
    }

    public function shots()
    {
        return $this->hasMany(GameShot::class, 'game_id');
    }
}
