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


Route::get('/', 'SlugController@getHomepage');


Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/admin/dashboard', 'DashboardController@index')->name('dashboard');

Auth::routes();

//Settings

Route::get('/admin/settings', 'SettingsController@index');
Route::post('/admin/settings', 'SettingsController@save');

//Profit Tracker

Route::get('/admin/profit_tracker', 'ProfitTrackerController@index');
Route::post('/admin/profit_tracker', 'ProfitTrackerController@ajax');


//Pages

Route::get('/admin/pages/all', 'PagesController@all');
Route::get('/admin/pages/add', 'PagesController@add');
Route::get('/admin/pages/edit/{object_id}', 'PagesController@edit');
Route::get('/admin/pages/delete/{object_id}', 'PagesController@delete');
Route::post('/admin/pages/add', 'PagesController@create');
Route::post('/admin/pages/edit/{object_id}', 'PagesController@save');

//Posts

Route::get('/admin/posts/all', 'PostsController@all');
Route::get('/admin/posts/add', 'PostsController@add');
Route::get('/admin/posts/edit/{object_id}', 'PostsController@edit');
Route::get('/admin/posts/delete/{object_id}', 'PostsController@delete');
Route::post('/admin/posts/add', 'PostsController@create');
Route::post('/admin/posts/edit/{object_id}', 'PostsController@save');

//File Manager

Route::get('/admin/file_manager_add', 'FileManagerController@add_view');
Route::get('/admin/file_manager_all', 'FileManagerController@all_view');

Route::post('/admin/file_manager/add', 'FileManagerController@add');
Route::post('/admin/file_manager/update', 'FileManagerController@update');
Route::post('/admin/file_manager/delete', 'FileManagerController@delete');

Route::get('/admin/users/all', 'UserController@all');

//Favorties

Route::get('/admin/favourites', 'FavouritesController@set');
Route::post('/admin/favourites/save', 'FavouritesController@save');
Route::post('/admin/favourites/twitterAjax', 'FavouritesController@twitterAjax');
Route::post('/admin/favourites/ordersAjax', 'FavouritesController@ordersAjax');

//News


//News Settings

Route::get('/admin/news_settings', 'NewsSettingsController@index');
Route::post('/admin/news_settings', 'NewsSettingsController@update');

//orders
Route::post('/admin/payments/callback', [
   'uses' => 'PaymentController@callback',
   'nocsrf' => true,
]);

Route::get('/admin/cart', 'PaymentController@cart');
Route::get('/admin/orders', 'PaymentController@orders');
Route::post('/admin/payment/{amount}', 'PaymentController@index');
Route::get('/admin/orders/add', 'PaymentController@add');
Route::post('/admin/free_trial', 'PaymentController@freeTrial');



//Cron

Route::get('/admin/cron_job', 'CronController@index');
Route::get('/admin/cron_job_payment_days', 'CronController@paymentDays');

//Tests 

Route::get('/admin/test', 'TestController@index');
Route::get('/admin/websocket', 'TestController@index');

//Slugs

Route::get('{slug}', [
    'uses' => 'SlugController@get' 
])->where('slug', '([A-Za-z0-9\-\/]+)');


