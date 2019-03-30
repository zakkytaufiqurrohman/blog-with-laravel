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

Route::get('/','indexController@index');
Route::get('/blog','indexController@blog');
Route::get('/blog/{data}','indexController@show');

///search
Route::get('/search','indexController@blog_Search');

///comment route
Route::post('/blog/{slug}/comment','indexController@comment')->name('post.comment');

////

Auth::routes();
//admin route
Route::get('/home', 'HomeController@index')->name('home');


///grouping
Route::group(['prefix'=>'admin','as'=>'admin.','middleware'=>'auth'],function(){

    Route::get('/', 'HomeController@index')->name('paijo');
    // route users
    Route::resource('users','UsersController');
    Route::resource('Comment','Comments',['except'=>['create','store']]);

    //end route users
    // route categories
    Route::resource('categories','Categories');
    Route::resource('post','PostController');
    //end route post
    //route setting
    Route::get('setting','settingController@index')->name('setting.index');
    Route::post('setting','settingController@store')->name('setting.store');

});



Route:: get('/blog/category/{slug}','indexController@Category');



//end route categories
//route post

//end route setting
//route comment

Route::group(['middleware'=>'auth'],function(){

    route::get('/api/datatable/comment','Comments@datatable')->name('api.datatable.comment');
    Route::get('/api/datatable/users','UsersController@datatable')->name('api.datatable.users');
    Route::get('/api/datatable/categories','Categories@datatable')->name('api.datatable.categories');
    Route::get('/api/datatable/post','PostController@datatable')->name('api.datatable.post');
//end route
//end admin route
});
