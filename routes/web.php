<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\PracticeMatchController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::post('/otp/send', [OtpController::class, 'send'])->name('otp.send');

Route::get('/otp/verify', [OtpController::class, 'show'])
    ->name('otp.verify.form');

Route::post('/otp/verify', [OtpController::class, 'verify'])
    ->name('otp.verify');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
        Route::resource('students', StudentController::class);
        Route::resource('coaches', CoachController::class);
        Route::resource('teams', TeamController::class);
        Route::resource('courses', CourseController::class);
        Route::resource('enrollments', EnrollmentController::class);
        Route::view('/api-demo', 'api-demo')
    ->middleware('auth')
    ->name('api.demo');
    Route::resource('practice-matches', PracticeMatchController::class);
    
});

require __DIR__.'/auth.php';