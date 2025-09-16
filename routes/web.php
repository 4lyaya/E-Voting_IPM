<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VotingController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CandidateController;

// Halaman utama untuk memasukkan NIS
Route::get('/', [VotingController::class, 'index'])->name('voting.index');

// Verifikasi NIS dan redirect ke halaman voting
Route::post('/verify-nis', [VotingController::class, 'verifyNis'])->name('voting.verifyNis');

// Proses voting
Route::post('/vote', [VotingController::class, 'vote'])->name('voting.vote');

// Students Routes - hanya CRUD dasar
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::resource('students', StudentController::class)->except(['show']);
    Route::resource('candidates', CandidateController::class)->except(['show']);
});

// Halaman admin untuk melihat hasil
Route::get('/admin/results', [AdminController::class, 'results'])->name('admin.results');

// Login admin
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');