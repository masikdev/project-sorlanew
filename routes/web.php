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

// Page by Category
Route::get('/category/hospitality', [ProjectController::class, 'hospitality'])->name('project.hospitality');
Route::get('/category/residential', [ProjectController::class, 'residential'])->name('project.residential');
Route::get('/category/interior', [ProjectController::class, 'interior'])->name('project.interior');
Route::get('/category/commercial', [ProjectController::class, 'commercial'])->name('project.commercial');
Route::get('/category/cultural', [ProjectController::class, 'cultural'])->name('project.cultural');
Route::get('/category/recreational', [ProjectController::class, 'recreational'])->name('project.recreational');

