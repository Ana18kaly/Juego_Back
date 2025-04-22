<?php

use App\Http\Controllers\api\ActivationController;
use App\Http\Controllers\api\GameController;
use App\Http\Controllers\api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
 
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('user')->group(function (){
    Route::get('/activate', [UserController::class, 'activarCuenta'])->name('activate.account')->middleware('signed');
    Route::get('/activate-account', [ActivationController::class, 'activate'])->name('activation.confirm');
    Route::post('/code', [UserController::class, 'codeGenerate']); //Recibe correo y contraseña
    Route::post('/login', [UserController::class, 'login']); //Recibe correo y código
    Route::post('/register', [UserController::class, 'store']); // Recibe name, email y password
});      

Route::get('/prueba', function () {
    return 1;
});

//Recibe token en header, se mandará como Authorization y en value ira Bearer {token}
Route::middleware(['auth:sanctum', 'verificarCuentaActiva'])->group(function () {
    //RUD de usuarios
    Route::prefix('user')->group(function (){
        Route::middleware(['auth:sanctum', 'verificarCuentaActiva'])->group(function () {
            Route::get('/userinfo', [UserController::class, 'userInfo']);
            // más rutas protegidas...
        });
        
        Route::get('/search/{id}', [UserController::class, 'search'])->where('id', '[0-9]+');
        Route::put('/update', [UserController::class, 'update']); // Puede recibir name, email y password 

        Route::post('/logout', [UserController::class, 'logout']); 
        Route::delete('/delete', [UserController::class, 'destroy']);
        Route::get('/history', [UserController::class, 'historial']); // Changed from /historial to /history
    });
    Route::prefix('game')->group(function (){
        Route::post('/create', [GameController::class, 'store']);
        Route::get('/info/{id}', [GameController::class, 'index'])->where('id', '[0-9]+');
        Route::get('/games', [GameController::class, 'games']);
        Route::put('/start/{id}', [GameController::class, 'start'])->where('id', '[0-9]+');
        Route::delete('/cancel/{id}', [GameController::class, 'cancel'])->where('id', '[0-9]+');
        Route::delete('/cancel', [GameController::class, 'cancelAll']);
        Route::put('/win/{id}', [GameController::class, 'win'])->where('id', '[0-9]+');
        Route::put('/turn/{id}', [GameController::class, 'turn'])->where('id', '[0-9]+');
        Route::put('/board/{id}', [GameController::class, 'board'])->where('id', '[0-9]+');
        Route::post('games/{id}/shot', [GameController::class, 'shot'])->middleware('auth:sanctum');
    });
});


