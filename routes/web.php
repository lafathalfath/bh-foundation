<?php

use App\Http\Controllers\admin\AppSettingsController;
use App\Http\Controllers\admin\FrontPageController;
use App\Http\Controllers\admin\ManageContactController;
use App\Http\Controllers\admin\ManageIdeasController;
use App\Http\Controllers\public\AboutController;
use App\Http\Controllers\public\homeController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ManageAboutController;
use App\Http\Controllers\admin\ManageCategoryController;
use App\Http\Controllers\admin\ManageProgramController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\public\IdeasController;
use App\Http\Controllers\public\ContactController;
use App\Http\Controllers\public\AllnewsController;
use App\Http\Controllers\public\ArticleController;
use App\Http\Middleware\AuthenticateMiddleware;
use App\Http\Middleware\GuestMiddleware;
use Illuminate\Support\Facades\Route;

// guest
Route::prefix('/auth')->middleware(GuestMiddleware::class)->group(function () {
    Route::get('/manage', [AuthController::class, 'loginView'])->name('auth.login.view');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
});

// authenticated
Route::middleware(AuthenticateMiddleware::class)->group(function () {
    Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::prefix('/manage')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('manage.dashboard');
        Route::prefix('/page')->group(function () {
            Route::get('/about-us', [ManageAboutController::class, 'index'])->name('manage.page.about');
            Route::put('/about-us/update', [ManageAboutController::class, 'update'])->name('manage.page.about.update');
            Route::get('/front-page', [FrontPageController::class, 'index'])->name('manage.page.front_page');
            Route::put('/front-page/update', [FrontPageController::class, 'update'])->name('manage.page.front_page.update');
            Route::get('/contact', [ManageContactController::class, 'index'])->name('manage.page.contact');
            Route::put('/contact/update', [ManageContactController::class, 'update'])->name('manage.page.contact.update');
            Route::get('/ideas', [ManageIdeasController::class, 'index'])->name('manage.page.ideas');
            Route::put('/ideas/update', [ManageIdeasController::class, 'update'])->name('manage.page.ideas.update');

            Route::prefix('/articles')->group(function () {
                Route::get('/', [ManageProgramController::class, 'index'])->name('manage.article');
                Route::get('/{type}/create', [ManageProgramController::class, 'create'])->name('manage.article.create');
                Route::post('/store', [ManageProgramController::class, 'store'])->name('manage.article.store');
                Route::get('/{type}/{id}/edit', [ManageProgramController::class, 'edit'])->name('manage.article.edit');
                Route::put('/{id}/update', [ManageProgramController::class, 'update'])->name('manage.article.update');
                Route::put('/{id}/publish', [ManageProgramController::class, 'publish'])->name('manage.article.publish');
                Route::delete('/{id}/destroy', [ManageProgramController::class, 'destroy'])->name('manage.article.destroy');
            });
        });

        Route::prefix('/master')->group(function () {
            Route::prefix('/categories')->group(function () {
                Route::get('/', [ManageCategoryController::class, 'index'])->name('manage.categories');
                Route::post('/store', [ManageCategoryController::class, 'store'])->name('manage.categories.store');
                Route::put('/{id}/update', [ManageCategoryController::class, 'update'])->name('manage.categories.update');
                Route::delete('/{id}/destroy', [ManageCategoryController::class, 'destroy'])->name('manage.categories.destroy');
            });
        });

        Route::get('/app-settings', [AppSettingsController::class, 'index'])->name('manage.app_settings.view');
        Route::put('/app-settings/update', [AppSettingsController::class, 'update'])->name('manage.app_settings.update');

        Route::post('/members/store', [ManageAboutController::class, 'addMember'])->name('manage.member.store');
        Route::delete('/members/{id}/destroy', [ManageAboutController::class, 'destroyMember'])->name('manage.member.destroy');
        Route::put('/members/{id}/update', [ManageAboutController::class, 'updateMember'])->name('manage.member.update');

        Route::post('/partners/store', [ManageAboutController::class, 'addPartners'])->name('manage.partner.store');
        Route::put('/partners/{id}/update', [ManageAboutController::class, 'updateParters'])->name('manage.partner.update');
        Route::delete('/partners/{id}/destroy', [ManageAboutController::class, 'destroyPartner'])->name('manage.partner.destroy');
    });
});

// public
Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [homeController::class, 'index'])->name('home');
Route::get('/about-us', [AboutController::class, 'index'])->name('about');
Route::get('/our-works', function () {
    return 'OUR WORKS'; })->name('works');
Route::get('/ideas', [IdeasController::class, 'index'])->name('ideas');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/allnews', [AllnewsController::class, 'index'])->name('allnews');
Route::get('/article/{type}/{id}', [ArticleController::class, 'index'])->name('article');