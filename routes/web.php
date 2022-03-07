<?php

use App\Http\Controllers\BrowserSessionManager;
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
require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('logged-in-session', [BrowserSessionManager::class, 'getSessionsProperty'])->name('logged-in-session');
    Route::post('logout-other-browser', [BrowserSessionManager::class, 'logoutOtherBrowserSessions'])->name('logout-other-browser');
    Route::get('logout-single-browser/{device_id}', [BrowserSessionManager::class, 'logoutSingleSessionDevice'])->name('logout-single-browser');
});

