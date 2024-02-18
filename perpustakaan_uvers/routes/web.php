<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\WebController;
use App\Models\Book;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::prefix('login')->group(function () {
    Route::get('/', [WebController::class, 'login']);
    Route::post('/', [WebController::class, 'action_login'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [WebController::class, 'action_logout']);

    Route::get('/', [WebController::class, 'dashboard']);
    Route::get('/dashboard', [WebController::class, 'dashboard']);

    Route::prefix('bibliography')->group(function () {
        Route::get('/', [WebController::class, 'bibliography']);
        Route::get('/create', [WebController::class, 'bibliography_create']);
        Route::post('/store', [WebController::class, 'action_bibliography_create']);
        Route::get('/edit/{id}', [WebController::class, 'bibliography_edit']);
        Route::post('/edit/{id}', [WebController::class, 'bibliography_update']);
        Route::post('/delete/{id}', [WebController::class, 'bibliography_destroy']);
    });

    Route::get('borrowing_history', [WebController::class, 'borrowing_history']);

    Route::prefix('member')->group(function () {
        Route::get('/', [WebController::class, 'member'] );
        Route::get('/create', [WebController::class, 'member_create'] );
        Route::post('/store', [WebController::class, 'member_store'] );
        Route::get('/edit/{id}', [WebController::class, 'member_edit'] );
        Route::post('/edit/{id}', [WebController::class, 'member_update'] );
        Route::post('/delete/{id}', [WebController::class, 'member_destroy']);
    });

});

Route::middleware(['verifyDownloadSignature'])->group(function () {
    Route::get('/download/book/{book}', [BookController::class, 'download'])->name('download.book');
});

Route::get('/test', function () {
    $book = Book::first();
    $book->getRateAttribute;
});