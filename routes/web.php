<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\MemberAuthController;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/berita', [HomeController::class, 'news_page']);
Route::get('/berita/{slug}', [HomeController::class, 'news_detail'])->name('news.detail');
Route::get('/panduan', [HomeController::class, 'instruction_page']);
Route::get('/kontak', [HomeController::class, 'contact_page']);

Route::middleware('guest.member')->controller(MemberAuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'loginStore')->name('login.store');
    Route::get('/registrasi', 'register')->name('register');
    Route::post('/registrasi', 'registerStore')->name('register.store');
});

Route::middleware('auth.member')->group(function () {
    Route::get('/submission', [SubmissionController::class, 'index'])->name('submission.index');

    Route::post('/submission/ta', [SubmissionController::class, 'store_ta'])->name('submission.store.ta');
    Route::post('/submission/non-ta', [SubmissionController::class, 'store_non_ta'])->name('submission.store.nonta');
    Route::post('/submission/instansi', [SubmissionController::class, 'store_instansi'])->name('submission.store.instansi');

    Route::get('/submission/{uuid}/edit', [SubmissionController::class, 'edit_submission'])->name('submission.edit');
    Route::put('/submission/ta/{uuid}', [SubmissionController::class, 'update_ta'])->name('submission.update.ta');
    Route::put('/submission/nonta/{uuid}', [SubmissionController::class, 'update_nonta'])->name('submission.update.nonta');
    Route::put('/submission/instansi/{uuid}', [SubmissionController::class, 'update_instansi'])->name('submission.update.instansi');

    Route::post('/restart-machine/{id}', [SubmissionController::class, 'restart'])->name('machine.restart');

    Route::get('/status-submission', [SubmissionController::class, 'status_submission'])->name('submission.status');;
    Route::get('/list-machine', [SubmissionController::class, 'list_machine'])->name('machine.list');
    Route::get('/list-procedure', [SubmissionController::class, 'list_procedure'])->name('procedure.list');
    Route::post('/logout', [MemberAuthController::class, 'logout'])->name('logout');
});