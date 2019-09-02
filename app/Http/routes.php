<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index')->middleware('checkReader');

Route::get('/category','CategoryController@index')->middleware('checkAdmin');
Route::get('/category/show/{id}','CategoryController@show')->middleware('checkAdmin');
Route::get('/category/delete/{id}','CategoryController@destroy')->middleware('checkAdmin');
Route::get('/category/add','CategoryController@create')->middleware('checkAdmin');
Route::post('/category/add','CategoryController@store')->middleware('checkAdmin');
Route::get('/category/edit/{id}','CategoryController@edit')->middleware('checkAdmin');
Route::post('/category/edit/{id}','CategoryController@update')->middleware('checkAdmin');

Route::get('/book','BookController@index');
Route::get('/book/add','BookController@create')->middleware('checkPublisher');
Route::post('/book/add','BookController@store');
Route::get('/book/edit/{id}','BookController@edit');
Route::post('/book/edit/{id}','BookController@update')->middleware('checkPublisher');
Route::get('/book/show/{id}','BookController@show');
Route::get('/book/delete/{id}','BookController@destroy')->middleware('checkPublisher');
Route::get('/book/{id}/download','BookController@downloadBook')->name("book.download");
Route::get('/book/{id}/review','BookController@reviewBook')->name("book.review");

Route::post('/book/comment/add','BookCommentController@store');
Route::post('/book/comment/edit','BookCommentController@update');
Route::get('/book/comment/delete/{id}','BookCommentController@destroy');


Route::get('/admin/book','AdminController@showBooks')->middleware('checkAdmin');
//Route::get('/admin/reader_book','AdminController@showReaderBooks')->middleware('checkAdmin');
Route::post('/admin/book','AdminController@approvedBooks')->middleware('checkAdmin');
Route::get('/admin','AdminController@index')->middleware('checkAdmin');
Route::get('/user',"UserController@index")->middleware('checkAdmin');
Route::get('/user/show/{id}',"UserController@show")->middleware('checkAdmin');
Route::get('/user/delete/{id}',"UserController@destroy")->middleware('checkAdmin');
//Route::post('/admin/reader_book','AdminController@approvedReaderBooks')->middleware('checkAdmin');


Route::get("/publisher",'PublisherController@index');
Route::get("/publisher/show/{id}",'PublisherController@index');

Route::get('/reader','ReaderController@index');
Route::get('/reader/profile','ReaderController@profile');
Route::post('/reader/profile','ReaderController@update_profile');
//Route::post('/reader/book/add','BookReaderController@store');
//Route::get('/reader/profile','BookReaderController@index');
//Route::get('/reader/book/{id}/download','BookReaderController@downloadBook')->name("bookReader.download");
//Route::get('/reader/book/{id}/review','BookReaderController@reviewBook')->name("bookReader.review");


//Route::get('/post','PostController@index');
Route::post('/post/add','PostController@store');
Route::get('/post/delete/{id}','PostController@destroy');
Route::post('/post/edit','PostController@update');

Route::post("/comment/add","CommentController@store");
Route::get("/comment/delete/{id}","CommentController@destroy");
Route::post("/comment/edit","CommentController@update");


Route::post('/rate/add','RateController@store');


Route::post('/search','SearchController@index');
Route::get('/search','ReaderController@index@index');

Route::post('/book/{id}/review','BookReviewController@store');
Route::post('/book/{id}/download','BookDownloadController@store');


Route::get('/user/profile/{id}','ReaderController@userProfile');

Route::get('/message','MessageController@index');
Route::post('/message/add','MessageController@store');