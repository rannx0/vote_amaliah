<?php

use App\Http\Controllers\CandidateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VoteController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

// Route::get('/login', function () {
//     return view('login');
// });

Route::get('/end', function () {
    return view('end');
});

// Route::get('/vote', function () {
//     return view('vote');
// });

Route::get('/admin', function () {
    return view('admin/dashboard');
});

Route::get('/candidate', [CandidateController::class, 'index'])->name('candidate.index');
Route::post('/candidate/store', [CandidateController::class, 'store'])->name('candidate.store');
Route::put('/candidate/{candidate}/update', [CandidateController::class, 'update'])->name('candidate.update');
Route::delete('/candidate/{id}/destroy', [CandidateController::class, 'destroy'])->name('candidate.destroy');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/{id}/vote', [VoteController::class, 'index'])->name('vote');
Route::post('/vote/store', [VoteController::class, 'store'])->name('vote.store');
