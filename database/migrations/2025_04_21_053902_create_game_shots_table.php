<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateGameShotsTable extends Migration
{
    public function up()
    {
        Schema::create('game_shots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id');
            $table->unsignedBigInteger('player_id');
            $table->integer('shot_number');
            $table->boolean('is_correct');
            $table->timestamps();

            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->foreign('player_id')->references('id')->on('users')->onDelete('cascade');
        });

        DB::table('game_shots')->insert([
            [
                'game_id' => 1,
                'player_id' => 1,
                'shot_number' => 1,
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'game_id' => 1,
                'player_id' => 2,
                'shot_number' => 2,
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'game_id' => 1,
                'player_id' => 1,
                'shot_number' => 3,
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('game_shots')->insert([
            [
                'game_id' => 2,
                'player_id' => 2,
                'shot_number' => 1,
                'is_correct' => true,
                'created_at' => now()->subMinutes(30),
                'updated_at' => now()->subMinutes(30)
            ],
            [
                'game_id' => 2,
                'player_id' => 1,
                'shot_number' => 2,
                'is_correct' => false,
                'created_at' => now()->subMinutes(25),
                'updated_at' => now()->subMinutes(25)
            ],
            [
                'game_id' => 2,
                'player_id' => 2,
                'shot_number' => 3,
                'is_correct' => true,
                'created_at' => now()->subMinutes(20),
                'updated_at' => now()->subMinutes(20)
            ],
            [
                'game_id' => 2,
                'player_id' => 1,
                'shot_number' => 4,
                'is_correct' => false,
                'created_at' => now()->subMinutes(15),
                'updated_at' => now()->subMinutes(15)
            ],
            [
                'game_id' => 2,
                'player_id' => 2,
                'shot_number' => 5,
                'is_correct' => true,
                'created_at' => now()->subMinutes(10),
                'updated_at' => now()->subMinutes(10)
            ]
        ]);



    }

    public function down()
    {
        Schema::dropIfExists('game_shots');
    }
}
