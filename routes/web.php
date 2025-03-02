<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

Route::get('/change-language/{language}', [ProjectController::class, 'changeLanguage'])->name('change.language');
Route::get('/', [ProjectController::class, 'index'])->name('project.index');
Route::get('/detail/{id_project}', [ProjectController::class, 'show'])->name('project.show');
Route::get('/coba', function () {
    return view('coba');
});
