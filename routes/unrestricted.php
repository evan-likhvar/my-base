<?php
/**
 * Route::middleware(['web','set.locale'])
 *->namespace($this->namespace.'\Unrestricted')
 *->group(base_path('routes/unrestricted.php'));
 */
use Illuminate\Support\Facades\Route;

Route::get('/{locale?}', 'PublicController@index');
Route::get('/category/{category}/{locale?}', 'PublicController@index')->name('category.index');

Route::get('/note/{note}/{locale?}', 'PublicController@show')->name('note.show');



Route::post('/change-locale','SiteLocaleController@changeLocale')->name('change-locale');