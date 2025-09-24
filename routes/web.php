<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\StatController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Data\MemberController;

use App\Http\Controllers\Data\WorkerController;
use App\Http\Controllers\Admin\SliderController;

use App\Http\Controllers\AgendaMemberController;

use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Admin\PracticeAreaController;
use App\Http\Controllers\Data\AgendaParticipantController;

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['id', 'en'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
});


Route::get('/', [App\Http\Controllers\FrontendController::class, 'index']);
Route::get('/media', [App\Http\Controllers\FrontendController::class, 'media']);
Route::get('/media/{id}', [App\Http\Controllers\FrontendController::class, 'media_detail']);
Route::get('/about', [App\Http\Controllers\FrontendController::class, 'about']);
Route::get('/our_member', [App\Http\Controllers\FrontendController::class, 'our_member']);
Route::get('/contact', [App\Http\Controllers\FrontendController::class, 'contact']);
Route::post('/send_kontak', [App\Http\Controllers\FrontendController::class, 'send_kontak']);

Auth::routes(['verify' => true]);

// Remove the auth middleware from these routes
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->name('verification.verify');
Route::get('/email/verify', [VerificationController::class, 'show'])
    ->name('verification.notice');
Route::post('/email/resend', [VerificationController::class, 'resend'])
    ->name('verification.resend');
Route::get('/email/verified-success', function () {
    return view('auth.verified-success');
})->name('verification.success');

Route::group(['middleware' => 'auth', 'approved', 'verified'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');

    // CRUD Home
    Route::get('/content', [ContentController::class, 'index'])->name('content.index');
    Route::post('/content/store', [ContentController::class, 'storeContent'])->name('content.store');
    Route::put('/content/update/{id}', [ContentController::class, 'updateContent'])->name('content.update');

    // CRUD Stats
    Route::get('/stat', [StatController::class, 'index'])->name('stats.index');
    Route::post('/stat/store', [StatController::class, 'storeStat'])->name('stats.store');
    Route::put('/stat/update/{id}', [StatController::class, 'updateStat'])->name('stats.update');
    Route::delete('/stat/delete/{id}', [StatController::class, 'deleteStat'])->name('stats.delete');



    Route::prefix('admin')
        ->name('admin.')
        ->middleware('role:superadmin')
        ->group(function () {
            Route::resource('news', NewsController::class);
            Route::resource('category', CategoryController::class);
            Route::resource('service', ServiceController::class);
            Route::resource('practice-area', PracticeAreaController::class);
            Route::resource('team', TeamController::class);
            Route::resource('slider', SliderController::class);
        });

    Route::get('/profil', [App\Http\Controllers\HomeController::class, 'profil'])->name('profil');
    Route::post('/update_profil', [App\Http\Controllers\HomeController::class, 'update_profil'])->name('update_profil');
    Route::get('/media/{slug}', [App\Http\Controllers\HomeController::class, 'media_detail'])->name('media.detail');
    Route::post('/send_order', [App\Http\Controllers\HomeController::class, 'send_order'])->name('send_order');

    Route::resource('/data/kategori', App\Http\Controllers\Data\KategoriController::class)->middleware('role:superadmin');
    Route::resource('/data/bank', App\Http\Controllers\Data\BankController::class)->middleware('role:superadmin');
    Route::resource('/data/testimoni', App\Http\Controllers\Data\TestimoniController::class)->middleware('role:superadmin');
    Route::put('/data/worker/{id}', [WorkerController::class, 'update'])->name('worker.update');
    Route::put('/data/member/{id}', [MemberController::class, 'update'])->name('member.update');
    Route::get('/data/kontak', [App\Http\Controllers\HomeController::class, 'kontak']);
    Route::resource('/data/member', App\Http\Controllers\Data\MemberController::class)->middleware('role:superadmin');
    Route::get('/member/create', [MemberController::class, 'create'])->name('member.create');

    Route::resource('/data/worker', App\Http\Controllers\Data\WorkerController::class)->middleware('role:superadmin');
    Route::get('worker/create', [WorkerController::class, 'create'])->name('worker.create');
    Route::resource('/data/admin', App\Http\Controllers\Data\AdminController::class)->middleware('role:superadmin');
    Route::get('workers/{id}', [WorkerController::class, 'show'])->name('worker.show');
    Route::get('members/{id}', [MemberController::class, 'show'])->name('member.show');
    Route::get('/data/order/{id}/success_order', [App\Http\Controllers\Data\OrderController::class, 'success_order']);
    Route::get('/data/order/{id}/konfirmasi', [App\Http\Controllers\Data\OrderController::class, 'konfirmasi']);
    Route::post('/data/order/{id}/send_konfirmasi', [App\Http\Controllers\Data\OrderController::class, 'send_konfirmasi']);
    Route::get('/data/order/{id}/bayar_diterima', [App\Http\Controllers\Data\OrderController::class, 'bayar_diterima']);
    Route::get('/data/order/{id}/bayar_ditolak', [App\Http\Controllers\Data\OrderController::class, 'bayar_ditolak']);
    Route::get('/data/order/{id}/terima_pekerjaan', [App\Http\Controllers\Data\OrderController::class, 'terima_pekerjaan']);
    Route::get('/data/order/{id}/selesai_pekerjaan', [App\Http\Controllers\Data\OrderController::class, 'selesai_pekerjaan']);
    Route::get('/data/order/{id}/upload-proof', [App\Http\Controllers\Data\OrderController::class, 'uploadProof'])->name('order.upload_proof');
    Route::post('/data/order/{id}/upload-proof', [App\Http\Controllers\Data\OrderController::class, 'uploadProof'])->name('order.upload_proof');
    Route::post('/data/order/{id}/submit-description', [App\Http\Controllers\Data\OrderController::class, 'submitDescription'])->name('order.submit_description');
    Route::resource('/data/order', App\Http\Controllers\Data\OrderController::class);

    Route::get('/data/withdraw/{id}/diproses', [App\Http\Controllers\Data\WithdrawController::class, 'diproses'])->middleware('role:superadmin');
    Route::get('/data/withdraw/{id}/selesai', [App\Http\Controllers\Data\WithdrawController::class, 'selesai'])->middleware('role:superadmin');
    Route::get('/data/withdraw/{id}/ditolak', [App\Http\Controllers\Data\WithdrawController::class, 'tolak'])->middleware('role:superadmin');
    Route::resource('/data/withdraw', App\Http\Controllers\Data\WithdrawController::class)->middleware('role:superadmin|worker');

    // In your routes file (web.php or routes.php)
    // For approved members
    Route::get('data/member', [MemberController::class, 'index'])->name('data.member.index');

    // For pending members 
    Route::get('pending-members', [MemberController::class, 'pending'])->name('pending-members.index');

    // For approval and rejection actions
    Route::put('data/member/{id}/approve', [MemberController::class, 'approve'])->name('member.approve')->middleware('role:superadmin');
    Route::put('data/member/{id}/reject', [MemberController::class, 'reject'])->name('member.reject')->middleware('role:superadmin');

    // Add this route to your web.php file
    Route::get('/admin/category-count', [App\Http\Controllers\HomeController::class, 'getCategoryCount'])
        ->name('admin.category-count')
        ->middleware(['auth', 'verified', 'role:superadmin']);
});

