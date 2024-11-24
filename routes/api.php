<?php

use App\Http\Controllers\email\EmailController;
use App\Http\Controllers\email\MailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\user\UserController;
use App\Http\Controllers\user\RolesController;
use App\Http\Controllers\email\verifiEmailController;
use App\Http\Controllers\user\SesionUserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post('/login', [UserController::class, 'login']);

//Route::get('/verify-email/{id}/{hash}', [verifiEmailController::class, 'verify'])->middleware('signed')->name('verification.verify');

Route::get('/verify-email/{id}/{hash}', [EmailController::class, 'verifyEmail'])
    ->middleware('signed')
    ->name('verification.verify');
    

Route::get('/email', [MailController::class, 'enviarCorreo']);

Route::group(['middleware' => ["auth:sanctum"]], function () {
    
    Route::apiResource('/user',UserController::class);
    Route::apiResource('/roles', RolesController::class);
    Route::apiResource('/user/sesion', SesionUserController::class);
    Route::get('/sesion/list',[SesionUserController::class,'index']);
    Route::post('/registrar',[UserController::class,'register']);
    


});
