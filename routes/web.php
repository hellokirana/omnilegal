<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\StatController;
use App\Http\Controllers\Admin\TeamController;

use App\Http\Controllers\Data\MemberController;
use App\Http\Controllers\Data\WorkerController;

use App\Http\Controllers\Admin\SliderController;

use App\Http\Controllers\AgendaMemberController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\WebsiteController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DisclaimerController;
use App\Http\Controllers\Admin\DescriptionController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Admin\PracticeAreaController;
use App\Http\Controllers\Data\AgendaParticipantController;

Route::get('/', function () {
    return redirect('/en');
});

Route::prefix('{locale}')
    ->where(['locale' => 'id|en'])
    ->group(function () {
        Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
        Route::get('/news', [FrontendController::class, 'news'])->name('frontend.news');
        Route::get('/news/{id}', [FrontendController::class, 'news-detail'])->name('frontend.news-detail');
        Route::get('/about', [FrontendController::class, 'about'])->name('frontend.about');
        Route::get('/career', [FrontendController::class, 'our_member'])->name('frontend.career');
        Route::get('/contact', [FrontendController::class, 'contact'])->name('frontend.contact');
        Route::post('/send-contact', [FrontendController::class, 'send-contact'])->name('frontend.send-contact');
    });
Auth::routes(['verify' => true]);

Route::group(['middleware' => 'auth', 'approved', 'verified'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');

    // CRUD Home
    Route::get('/content', [ContentController::class, 'index'])->name('content.index');
    Route::post('/content/store', [ContentController::class, 'storeContent'])->name('content.store');
    Route::put('/content/update/{id}', [ContentController::class, 'updateContent'])->name('content.update');
    Route::prefix('admin')
        ->name('admin.')
        ->middleware('role:superadmin')
        ->group(function () {
            Route::resource('stat', StatController::class);
            Route::resource('news', NewsController::class);
            Route::resource('category', CategoryController::class);
            Route::resource('service', ServiceController::class);
            Route::resource('practice-area', PracticeAreaController::class);
            Route::resource('team', TeamController::class);
            Route::resource('website', WebsiteController::class);
            Route::resource('inbox', ContactController::class);
            Route::resource('slider', SliderController::class);
            Route::resource('disclaimer', DisclaimerController::class);
            Route::resource('description', DescriptionController::class);
        });


});

