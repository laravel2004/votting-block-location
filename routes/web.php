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

Route::get('/404', function (Request $request) {
    return view('layouts.main');
});

Route::get('/location', function (Request $request) {
    return $request->host();
});

Route::resource('/', CandidateController::class)->only(['index'])->names([
    'index' => 'candidates.index'
]);

Route::prefix('/')->group(function () {
    Route::resource('/candidate', CandidateController::class)->except(['index']);
    Route::get('/candidate/{id}', [CandidateController::class, 'detail'])
        ->name('candidates.detail');
    Route::post('vote/location', [VoteController::class, 'checkLocation'])->name('vote.location');
});
Route::resource('/vote', VoteController::class);
// Route::middleware([IPChecker::class])->group(function () {
// });
