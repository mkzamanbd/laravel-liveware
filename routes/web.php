<?php

use App\Http\Controllers\LoggedInSessionManager;
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
require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('logged-in-session', [LoggedInSessionManager::class, 'index'])->name('logged-in-session');
    Route::post('logout-other-browser', [LoggedInSessionManager::class, 'logoutOtherBrowser'])->name('logout-other-browser');
    Route::get('logout-single-browser/{device_id}', [LoggedInSessionManager::class, 'logoutDevice'])->name('logout-single-browser');
});

