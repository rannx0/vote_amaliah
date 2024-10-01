<?php

use App\Http\Controllers\CandidateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\DataUserController;

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

Route::get('/home', function () {
    return view('home');
})->name('home');



Route::get('/already_vote', function () {
    return view('already_vote');
})->name('already_vote');


// Route::get('/candidate', [CandidateController::class, 'index'])->name('candidate.index');
// Route::post('/candidate/store', [CandidateController::class, 'store'])->name('candidate.store');
// Route::put('/candidate/{candidate}/update', [CandidateController::class, 'update'])->name('candidate.update');
// Route::delete('/candidate/{id}/destroy', [CandidateController::class, 'destroy'])->name('candidate.destroy');
// Route::get('/dashboard', function () {
//     return view('admin/dashboard');
// });

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/candidate', [CandidateController::class, 'index'])->name('candidate.index');
    Route::post('/candidate/store', [CandidateController::class, 'store'])->name('candidate.store');
    Route::put('/candidate/{candidate}/update', [CandidateController::class, 'update'])->name('candidate.update');
    Route::delete('/candidate/{id}/destroy', [CandidateController::class, 'destroy'])->name('candidate.destroy');

    Route::get('/datauser', [DataUserController::class, 'index'])->name('datauser.index');
    Route::get('/datauser/create', [DataUserController::class, 'store'])->name('datauser.store');
    Route::put('/datauser/{id}', [DataUserController::class, 'update'])->name('user.update');
    Route::delete('/datauser/{id}', [DataUserController::class, 'destroy'])->name('user.destroy');
});



Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::get('/{id}/vote', [VoteController::class, 'index'])->name('vote');
Route::post('/vote/store', [VoteController::class, 'store'])->name('vote.store');
Route::get('/end', [VoteController::class, 'endindex'])->name('end');
