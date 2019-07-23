<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::get('/home', function () {
    return view(config('site-settings.theme-views-personal-area').'.index.index');
})->middleware('auth')->name('home');


Route::get('/stream', function () {

    $page = file_get_contents('https://3dnews.ru/989432');

    $pattern = '/<div class="js-mediator-article".*?script/is';
    preg_match($pattern, $page,$result);
    $prepare = preg_replace("/[\n\r\t]/","", $result[0]);
    $prepare = str_replace('<center><script','',$prepare);

    $dom = new DOMDocument;
    $dom->loadHTML('<?xml encoding="utf-8" ?>' .$prepare);
    echo $dom->saveHTML();
    dd($dom,$prepare,$result);

});

/****************/
Broadcast::routes();

Route::get('/broadcast', 'Broadcast\BroadcastController@index')->name('broadcast');
Route::post('/broadcast/push-something-to-public-chanel', 'Broadcast\BroadcastController@pushSomethingToPublicChanel');
Route::post('/broadcast/push-something-to-private-chanel', 'Broadcast\BroadcastController@pushSomethingToPrivateChanel');
Route::post('/broadcast/push-something-to-presence-chanel', 'Broadcast\BroadcastController@pushSomethingToPresenceChanel');
Route::post('/broadcast/set-connection', 'Broadcast\BroadcastController@getWSToken');

/****************/

Route::get('/token', 'Token\TokenController@index')->name('token');
Route::post('/token/post-form', 'Token\TokenController@post')->name('token-post');
Route::post('/token/post-form-json', 'Token\TokenController@postJson')->name('token-post-json');
Route::post('/token/post-form-json2', 'Token\TokenController@postJson2')->name('token-post-json2');

