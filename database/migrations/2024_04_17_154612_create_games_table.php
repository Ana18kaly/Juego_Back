<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_1');
            $table->foreign('user_1')->references('id')->on('users');
            $table->integer('boad1')->default(5);
            $table->integer('hits1')->default(0); 
            $table->unsignedBigInteger('user_2')->nullable();
            $table->foreign('user_2')->references('id')->on('users');
            $table->integer('boad2')->default(5);
            $table->integer('hits2')->default(0);
            $table->boolean("is_active")->default(false);
            $table->date('start_at')->nullable();
            $table->string('won')->nullable();            
            $table->integer("turn")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('games')->insert([
            [
                'user_1' => 1,
                'user_2' => 2,
                'boad1' => 5,
                'boad2' => 5,
                'is_active' => true,
                'start_at' => now(),
                'won' => null,
                'turn' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_1' => 2,
                'user_2' => 1,
                'boad1' => 3,
                'boad2' => 4,
                'is_active' => false,
                'start_at' => now(),
                'won' => 'Usuario 2',
                'turn' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_1' => 1,
                'user_2' => null,
                'boad1' => 5,
                'boad2' => 5,
                'is_active' => false,
                'start_at' => null,
                'won' => null,
                'turn' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
};
