<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::get('/test', function () { 
    return Inertia::render('Classrooms/Index');
            })->name('tester');

Route::get('/test02', function () { 
    return Inertia::render('test02');
            })->name('test02');

Route::get('/Recognition', function () { 
                return Inertia::render('Recognition/index');
                        })->name('test02');

Route::post('/Students/getDescriptors', [  App\Http\Controllers\StudentController::class,'getDescriptors']);

//Route::get('/classroomDescriptor', 'App\Http\Controllers\classroomDescriptorController@update');
            
Route::resource('students', App\Http\Controllers\StudentController::class);
Route::resource('attendances', App\Http\Controllers\AttendanceController::class);
Route::resource('classrooms', App\Http\Controllers\ClassroomController::class);
Route::resource('recognition', App\Http\Controllers\PhotoController::class);
Route::resource('studentClassrooms', App\Http\Controllers\StudentClassroomController::class);
Route::resource('classroomDescriptor', App\Http\Controllers\ClassroomDescriptorController::class);