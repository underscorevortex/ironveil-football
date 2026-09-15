<?php

use App\Http\Controllers\Api\AcademyController;
use Illuminate\Support\Facades\Route;

Route::get('/students', [AcademyController::class, 'students']);
Route::get('/teams', [AcademyController::class, 'teams']);
Route::get('/courses', [AcademyController::class, 'courses']);
Route::get('/matches', [AcademyController::class, 'matches']);