<?php

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


Auth::routes();

Route::middleware('CheckSuper')->prefix('super')->group(function(){
    Route::get('/', 'SuperController@panel');

    Route::put('/metadata','MetadataController@update');
});


Route::middleware('CheckAdmin')->prefix('admin')->group(function(){

    Route::get('/','AdminController@tableView');
    Route::get('/cotizador','AdminController@cotizador');


    Route::post('/product','ProductController@create');
    Route::put('/product','ProductController@update');
    Route::delete('/product/{id}','ProductController@destroy');
    
    Route::post('/variant','VariantController@create');
    Route::put('/variant','VariantController@update');
    Route::delete('/variant/{id}','VariantController@destroy');

    Route::post('/product/image','ProductController@changeImage')->middleware('OptimizeImages');
    Route::post('/variant/image','VariantImageController@create')->middleware('OptimizeImages');
    Route::delete('/variant/image/{id}','VariantImageController@destroy');

    Route::put('/order','OrderController@edit');
    Route::get('/ordenes','AdminController@orders');
    Route::get('/getOrders','OrderController@getOrders');

    Route::put('/config','ConfigController@update');

    Route::get('/pdf/{order}','OrderController@toPDF');
});

Route::get('/pdf/{order}','OrderController@toPDF');

Route::get('/config','ConfigController@get');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', function(){return redirect('/');});

Route::get('/cotizador','HomeController@cotizer');

Route::get('/sucursales','HomeController@sucursales');
Route::get('/contacto','HomeController@contacto');
Route::post('/contacto','MailController@contacto');
Route::get('/buscar','ProductController@searchResults');

Route::get('/logout',function(){
    Auth::logout();
    return redirect('/');
});
Auth::routes();


Route::get('/getUser','HomeController@getUser');

Route::post('/cotizer/send','OrderController@create');

Route::get('/lista-de-precios','PdfController@prices');

Route::post('/suscription','SuscriptionController@create');

/* ESTAS RUTAS SIEMPRE AL FINAL */



Route::get('/{product}','ProductController@detail');