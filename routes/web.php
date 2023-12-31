<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\VoteController;
use App\Http\Middleware\IPChecker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Stevebauman\Location\Facades\Location;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::resource('/', CandidateController::class)->only(['index'])->names([
    'index' => 'candidates.index'
]);

Route::prefix('/')->group(function () {
    Route::resource('/candidate', CandidateController::class)->except(['index']);
    Route::get('/candidate/{id}', [CandidateController::class, 'detail'])
        ->name('candidates.detail');
    Route::post('vote/location', [VoteController::class, 'checkLocation'])->name('vote.location');
    Route::get('vote/ip', [VoteController::class, 'checkIP'])->name('vote.ip');
});
Route::resource('/vote', VoteController::class);
