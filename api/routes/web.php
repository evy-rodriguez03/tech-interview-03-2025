<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ProjectController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{any}', function () {
    return view('app'); 
})->where('any', '.*');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::post('/tasks/{task}/comments', [CommentsController::class, 'store'])->name('tasks.addComment');
    Route::patch('/tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');
});


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/{project}/tasks', [TaskController::class, 'index'])->name('projects.tasks');
});
