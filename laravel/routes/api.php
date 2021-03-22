<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/article', 'Api\ArticleController@comment');
Route::get('/article', 'Api\ArticleController@index');
Route::get('/article/search', 'Api\ArticleController@search');
Route::get('/article/latest', 'Api\ArticleController@latest');
Route::get('/article/{slug}', 'Api\ArticleController@detail');

Route::get('/article/category/{slug}', 'Api\CategoryController@article');
Route::get('/donation/category/{slug}', 'Api\CategoryController@donation');

Route::post('/donation', 'Api\DonationController@donation');
Route::get('/donation', 'Api\DonationController@index');
Route::get('/donation/danger', 'Api\DonationController@danger');
Route::get('/donation/{slug}', 'Api\DonationController@detail');

Route::get('/event', 'Api\EventController@index');
Route::get('/event/search', 'Api\EventController@search');
Route::get('/event/{slug}', 'Api\EventController@detail');

Route::get('/profile/{slug}', 'Api\ProfileController@index');
Route::get('/profile/article/{slug}', 'Api\ProfileController@article');
Route::get('/profile/donation/{slug}', 'Api\ProfileController@donation');
Route::get('/profile/event/{slug}', 'Api\ProfileController@event');

Route::get('provinces', 'Api\LocationController@provinces');
Route::get('regencies/{province_id}', 'Api\LocationController@regencies');

Route::post('/logout', 'Api\LoginController@logout');
Route::post('/login', 'Api\LoginController@index');
Route::post('/register', 'Api\RegisterController@index');

Route::get('/authorize/{provider}/redirect', 'Api\SocialAuthController@redirectToProvider');
Route::get('/authorize/{provider}/callback', 'Api\SocialAuthController@handleProviderCallback');

Route::post('/email-verification', 'Api\VerificationController@verify');
Route::get('/verify/{token}', 'Api\VerificationController@confirm');

Route::get('/reset/{token}', 'Api\ForgotPasswordController@getDataUser');
Route::post('/reset-password', 'Api\ForgotPasswordController@sendPasswordResetLink');
Route::post('/reset/password', 'Api\ForgotPasswordController@callResetPassword');
