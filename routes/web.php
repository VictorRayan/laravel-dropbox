<?php

use App\Http\Controllers\FileManager;
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

Route::get('/', function () {
    return view('file_manager');
});
Route::post('/file/upload', [FileManager::class, 'uploadFile']);
Route::post('/file/delete', [FileManager::class, 'deleteFile']);
Route::post('/file/access', [FileManager::class, 'getAccessFile']);

