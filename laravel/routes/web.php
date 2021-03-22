<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth-api']], function () {
    // Admin
    Route::group(['middleware' => ['admin']], function () {
        Route::get("/visitors", "Dashboard\Admin\VisitorController@index")->name("admin.visitors.index");

        Route::get("/admin-list", "Dashboard\Admin\AdminController@adminList")->name("admin.admin.list");
        Route::get("/user-list", "Dashboard\Admin\AdminController@userList")->name("admin.user.list");
        Route::get("/eo-list", "Dashboard\Admin\AdminController@eoList")->name("admin.eo.list");
        Route::get("/black-list", "Dashboard\Admin\AdminController@blackList")->name("admin.blacklist.list");

        Route::get("/verifications/{id}/show", "Dashboard\Eo_VerificationController@show")->name("eo.showVerification");
        Route::get("/verifications/show-all", "Dashboard\Eo_VerificationController@index")->name("eo.indexVerification");
        route::get("/verifications/read-all", "Dashboard\Eo_VerificationController@readAll")->name("eo.readAllVerification");
        Route::get("/verifications/{id}/accept", "Dashboard\Eo_VerificationController@accept")->name("eo.acceptVerification");
        Route::get("/verifications/{id}/decline", "Dashboard\Eo_VerificationController@decline")->name("eo.declineVerification");

        Route::get("/categories", "Dashboard\Admin\CategoryController@index")->name("categories.index");

        Route::get("/banks", "Dashboard\Admin\BankController@index")->name("admin.bank.index");
    });

    Route::get("/donation/transaction", "Dashboard\Admin\DonationController@transaction")->name('donation.transaction');

    // Admin & Event Organizer
    Route::group(['middleware' => ['admin-eo']], function () {
        Route::get("/event", "Dashboard\EventController@index")->name("event.index");
        Route::get("/user-banks", "Dashboard\Admin\BankController@user")->name("admin.bank.user.list");
        Route::get("/donation/details/{id}", "Dashboard\Admin\DonationController@pendonasi")->name("donation.pendonasi");
        Route::resource("/donation", "Dashboard\Admin\DonationController");
    });

    // User
    Route::group(['middleware' => ['user']], function () {
        Route::get("/eo-verification", "Dashboard\Eo_VerificationController@verification")->name("eo.verification");
        Route::post("/eo-verification", "Dashboard\Eo_VerificationController@store")->name("eo.storeVerification");
    });

    // All Roles
    Route::get("/", "Dashboard\DashboardController@index")->name("dashboard.index")->middleware(['checkRole']);

    Route::get("/profile/edit", "Dashboard\ProfileController@edit")->name("profile.edit");
    Route::resource("/articles", "Dashboard\ArticleController");
    Route::get("/articles/comment/{id}", "Dashboard\ArticleController@comment")->name("articles.comment");

    Route::post("/image-upload", "Dashboard\ArticleController@image")->name("articles.upload.image");
    Route::post("/delete-upload", "Dashboard\ArticleController@deleteImage")->name("articles.delete.image");

    Route::resource("/contact-admin", "Dashboard\ChatController");
});
