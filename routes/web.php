<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\OAuthDropBoxAccessToken;

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
    return view('welcome');
});

Route::get('/dropbox', function(){

    (new OAuthDropBoxAccessToken)->requestToken();
    

    $disk = Storage::build([
        'driver' => 'dropbox',
        'authorization_token' => $_ENV["DROPBOX_ACCESS_TOKEN"],
    ]);

    if($disk->makeDirectory('Amicao_FileSystem')){
        dd('directory created');
    }
    else{
        dd('Oh fuck! More Problems!!!');
    }

    dd($_ENV["DROPBOX_ACCESS_TOKEN"]);
});
