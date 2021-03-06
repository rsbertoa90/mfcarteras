<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/catalogo-job','PdfController@dispatchCatalogoJob');
Route::get('/model/{id}','ModelImageController@get');
Route::get('/products','ProductController@getAll');
Route::get('/products-not-paused','ProductController@getNotPaused');
Route::get('/product/{id}','ProductController@get');
Route::get('/categories','CategoryController@getAll');
Route::get('/supercategories','SupercategoryController@getAll');

Route::get('/metadatas','MetadataController@getAll');

Route::get('/states','StateController@get');

Route::get('/city/{id}','StateController@getCity');

