<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[ProjectController::class, 'index'])->name('project.index');
Route::get('/detail/{id_project}',[ProjectController::class, 'show'])->name('project.show');
