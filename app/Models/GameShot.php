<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameShot extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'player_id',
        'shot_number',
        'is_correct'
    ];
    public function game() {
        return $this->belongsTo(Game::class);
    }

    public function player() {
        return $this->belongsTo(User::class, 'player_id');
    }
}

