<?php

declare(strict_types=1);

use App\Http\Controllers\IdeaController;
use App\Http\Controllers\IdeaImageController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StepController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/ideas');

Route::get('/ideas', [IdeaController::class, 'index'])->middleware('auth')->name('idea.index');
Route::post('/ideas', [IdeaController::class, 'store'])->middleware('auth')->name('idea.store');
Route::get('/idea/{idea}', [IdeaController::class, 'show'])->middleware('auth')->name('idea.show');
Route::delete('/idea/{idea}', [IdeaController::class, 'destroy'])->middleware('auth')->name('idea.destroy');
Route::patch('/idea/{idea}', [IdeaController::class, 'update'])->middleware('auth')->name('idea.update');

Route::delete('/ideas/{idea}/image', [IdeaImageController::class, 'destroy'])->middleware('auth')->name('idea.image.destroy');

Route::patch('/steps/{step}', [StepController::class, 'update'])->middleware('auth')->name('step.update');

Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');
Route::get('/login', [SessionController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [SessionController::class, 'store'])->middleware('guest');
Route::post('/logout', [SessionController::class, 'destroy'])->middleware('auth');

