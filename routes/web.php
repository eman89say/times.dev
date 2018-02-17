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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');


Route::namespace('Admin')->group(function(){
    Route::get('/verify/{token}','VerifyController@verify')->name('verify');

     Route::get('/dashboard/articles','ArticlesController@index');

     Route::get('/dashboard/articles/getArticles','ArticlesController@getArticles');

     Route::post('/dashboard/articles/postArticles','ArticlesController@postArticle');

     Route::get('/dashboard/articles/fetchArticle','ArticlesController@fetchArticle');

     Route::get('/dashboard/articles/deleteArticle','ArticlesController@deleteArticle');
    
     Route::get('/dashboard/articles/deleteMultipleArticles','ArticlesController@deleteMultipleArticles');
     
     Route::get('/dashboard/articles/fetchTagsOfthisArticle','ArticlesController@fetchTagsOfthisArticle');

     Route::get('/dashboard/articles/checkSlugUnique','ArticlesController@ckeckSlugUnique');

     Route::get('/dashboard/articles/{article_id}','ArticlesController@show');

    

///////////////////////////////////////////////////////////////////////////////////////////////////////
    Route::get('/dashboard/categories','CategoryController@index');

    Route::post('/dashboard/categories','CategoryController@store');

    Route::get('/dashboard/categories/show','CategoryController@show');

    Route::get('/dashboard/categories/fetchCategories','CategoryController@fetchCategories');
    
     Route::get('/dashboard/categories/checkUnique','CategoryController@checkUnique');

     Route::get('/dashboard/categories/getCategories','CategoryController@getCategories');


  //////////////////////////////////////////////////////////////////////////////////////////////////////   

    Route::get('/dashboard/userProfile','ProfileController@index');

    Route::post('/dashboard/userProfile','ProfileController@update');

    Route::post('/dashboard/userProfile/uploadProfileImg','ProfileController@uploadProfileImg');

 ////////////////////////////////////////////////////////////////////////////////////////////////////////   
    Route::get('/dashboard/tags/getTags','TagController@getTags');

    Route::get('/dashboard/tags','TagController@index');

    Route::post('/dashboard/tags','TagController@store');

    Route::get('/dashboard/tags/show','TagController@show');

    Route::get('/dashboard/tags/fetchTags','TagController@fetchTags');
 
    Route::get('/dashboard/tags/checkUnique','TagController@checkUnique');

    Route::get('/dashboard/tags/deleteTag','TagController@deleteTag');
//////////////////////////////////////////////////////////////////////////////////////////////////////////
    Route::get('/dashboard/articles/{id}/comments/getComments','CommentsController@getComments');


    Route::get('/dashboard/comments/fetchComment','CommentsController@fetchComment');

    Route::get('/dashboard/comments/publish','CommentsController@publish');

});


 