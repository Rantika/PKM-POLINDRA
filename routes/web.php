<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Lecturer\DashboardController as LecturerDashboard;
use App\Http\Controllers\Student\DashboardController as StudentDashboard;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\LandingPage\LandingPageController;
use App\Http\Controllers\Lecturer\RoleReviewerController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\Lecturer\RoleLecturerController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\ProdyController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\ReviewerController;
use App\Http\Controllers\SchemeController;
use App\Http\Controllers\Student\BimbinganStudentController;
use App\Http\Controllers\Student\RoleStudentController;
use App\Http\Controllers\KirimEmailController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ViewConfController;
use App\Http\Controllers\ForumController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
|                           Landing Page
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingPageController::class, 'index'])->name('home');
Route::get('/news/detail/{id?}', [LandingPageController::class, 'detail'])->name('home.detail');

/*
|--------------------------------------------------------------------------
|                           Forum
|--------------------------------------------------------------------------
*/
Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
Route::post('/forum/create', [ForumController::class, 'create'])->name('forum.create');
Route::get('/forum/{forum}/view', [ForumController::class, 'view'])->name('forum.view');
Route::post('/forum/{forum}/view', [ForumController::class, 'postkomentar'])->name('forum.view');
/*
|--------------------------------------------------------------------------
|                           Login, Register, Logout
|--------------------------------------------------------------------------
*/

Route::get("/kirimemail", [KirimEmailController::class, "index"]);

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/orders', 'authenticate')->name('login.process');

    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'creating')->name('register.process');

    Route::get('/logout', 'logout')->name('logout');
});

/*
|--------------------------------------------------------------------------
|                           Notification Routes
|--------------------------------------------------------------------------
*/
Route::get('/get-notification/{user_id?}', [NotificationController::class, 'get'])->name('get.notif');
Route::get('/get-notification-all/{user_id?}', [NotificationController::class, 'getAll'])->name('get.notif-all');
Route::get('/update-notification/{user_id?}', [NotificationController::class, 'updateRead'])->name('update.notif');

/*
|--------------------------------------------------------------------------
|                           Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/ajax', [DashboardController::class, 'ajax'])->name('dashboard.ajax');
Route::get('/dashboard/ajax-lolos', [DashboardController::class, 'ajaxLolos'])->name('dashboard.ajax-lolos');

Route::prefix('meta')->middleware(['role:admin'])->group( function () { // prefix : prefix adalah sebuah awal untuk pembeda antara field di satu table dengan table lainnya.
    Route::prefix('group')->controller(GroupController::class)->group(function () {
        Route::get('/', 'index')->name('meta.group.index');
        Route::get('/create', 'create')->name('meta.group.create');
        Route::post('/store', 'store')->name('meta.group.store');
        Route::get('/{id?}', 'show')->name('meta.group.show');
        Route::post('/update/{id?}', 'update')->name('meta.group.update');
        Route::get('/delete/{id?}', 'delete')->name('meta.group.delete');
    });

    Route::prefix('prody')->controller(ProdyController::class)->group(function () {
        Route::get('/', 'index')->name('meta.prody.index');
        Route::get('/create', 'create')->name('meta.prody.create');
        Route::post('/store', 'store')->name('meta.prody.store');
        Route::get('/{id?}', 'show')->name('meta.prody.show');
        Route::post('/update/{id?}', 'update')->name('meta.prody.update');
        Route::get('/delete/{id?}', 'delete')->name('meta.prody.delete');
    });

    Route::prefix('scheme')->controller(SchemeController::class)->group(function () {
        Route::get('/', 'index')->name('meta.scheme.index');
        Route::get('/create', 'create')->name('meta.scheme.create');
        Route::post('/store', 'store')->name('meta.scheme.store');
        Route::get('/{id?}', 'show')->name('meta.scheme.show');
        Route::post('/update/{id?}', 'update')->name('meta.scheme.update');
        Route::get('/delete/{id?}', 'delete')->name('meta.scheme.delete');
    });

    Route::prefix('reviewer')->controller(ReviewerController::class)->group(function () {
        Route::get('/', 'index')->name('meta.reviewer.index');
        Route::get('/create', 'create')->name('meta.reviewer.create');
        Route::post('/store', 'store')->name('meta.reviewer.store');
        Route::get('/{id?}', 'show')->name('meta.reviewer.show');
        Route::post('/update/{id?}', 'update')->name('meta.reviewer.update');
        Route::get('/delete/{id?}', 'delete')->name('meta.reviewer.delete');
    });
});

Route::prefix('setting')->middleware(['role:admin'])->group( function () {
    Route::prefix('view')->controller(ViewConfController::class)->group(function () {
        Route::get('/', 'index')->name('setting.view.index');
        Route::get('/create', 'create')->name('setting.view.create');
        Route::post('/store', 'store')->name('setting.view.store');
        Route::post('/store-logo', 'storeLogo')->name('setting.view.store-logo');
        Route::get('/{id?}', 'show')->name('setting.view.show');
        Route::get('/delete/{id?}', 'delete')->name('setting.view.delete');
    });

    Route::prefix('period')->controller(PeriodController::class)->group(function () {
        Route::get('/', 'index')->name('setting.period.index');
        Route::get('/create', 'create')->name('setting.period.create');
        Route::post('/store', 'store')->name('setting.period.store');
        Route::get('/{id?}', 'show')->name('setting.period.show');
        Route::post('/update/{id?}', 'update')->name('setting.period.update');
        Route::post('/update-status/{id?}', 'updateStatus')->name('setting.period.update-status');
        Route::get('/delete/{id?}', 'delete')->name('setting.period.delete');
    });
});


Route::prefix('account')->middleware(['role:admin'])->group( function () {
    Route::prefix('admin')->controller(AdminController::class)->group(function () {
        Route::get('/', 'index')->name('account.admin.index');
        Route::get('/create', 'create')->name('account.admin.create');
        Route::post('/store', 'store')->name('account.admin.store');
        Route::get('/{id?}', 'show')->name('account.admin.show');
        Route::post('/update/{id?}', 'update')->name('account.admin.update');
        Route::get('/delete/{id?}', 'delete')->name('account.admin.delete');
    });

    Route::prefix('lecturer')->controller(LecturerController::class)->group(function () {
        Route::get('/', 'index')->name('account.lecturer.index');
        Route::get('/create', 'create')->name('account.lecturer.create');
        Route::post('/store', 'store')->name('account.lecturer.store');
        Route::get('/{id?}', 'show')->name('account.lecturer.show');
        Route::post('/update/{id?}', 'update')->name('account.lecturer.update');
        Route::get('/delete/{id?}', 'delete')->name('account.lecturer.delete');

        Route::post('/store-simbelmawa/{id?}', 'updateSimbelmawa')->name('account.lecturer.simbelmawa.store');
    });

    Route::prefix('team')->controller(StudentController::class)->group(function () {
        Route::get('/', 'index')->name('account.student.index');
        Route::get('/create', 'create')->name('account.student.create');
        Route::post('/store', 'store')->name('account.student.store');
        Route::get('/{id?}', 'show')->name('account.student.show');
        Route::post('/update/{id?}', 'update')->name('account.student.update');
        Route::get('/delete/{id?}', 'delete')->name('account.student.delete');

        Route::post('/store-simbelmawa/{id?}', 'updateSimbelmawa')->name('account.student.simbelmawa.store');
    });
});


Route::prefix('team-data')->middleware(['role:admin'])->controller(ProposalController::class)->group( function () {
    Route::get('/', 'index')->name('proposal.index');
    Route::get('/create', 'create')->name('proposal.create');
    Route::post('/store', 'store')->name('proposal.store');
    Route::get('/{id?}', 'show')->name('proposal.show');
    Route::post('/update/{id?}', 'update')->name('proposal.update');
    Route::get('/pass/{id?}', 'lolos')->name('proposal.lolos');
    Route::get('/delete/{id?}', 'delete')->name('proposal.delete');

    Route::get('/get-bimbingan/{user_id?}', 'showBimbingan')->name('proposal.show-bimbingan');
});

Route::prefix('information')->middleware(['role:admin'])->controller(InformationController::class)->group( function () {
    Route::get('/', 'index')->name('information.index');
    Route::get('/create', 'create')->name('information.create');
    Route::post('/store', 'store')->name('information.store');
    Route::get('/{id?}', 'show')->name('information.show');
    Route::post('/update/{id?}', 'update')->name('information.update');
    Route::get('/delete/{id?}', 'delete')->name('information.delete');
});

Route::prefix('news')->middleware(['role:admin'])->controller(NewsController::class)->group( function () {
    Route::get('/', 'index')->name('news.index');
    Route::get('/create', 'create')->name('news.create');
    Route::post('/store', 'store')->name('news.store');
    Route::get('/{id?}', 'show')->name('news.show');
    Route::post('/update/{id?}', 'update')->name('news.update');
    Route::get('/delete/{id?}', 'delete')->name('news.delete');
});

/*
|--------------------------------------------------------------------------
|                           Dosbing Routes
|--------------------------------------------------------------------------
*/
Route::get('/lecturer', [LecturerDashboard::class, 'index'])->name('lecturer.index');

Route::prefix('lecturer')->middleware(['role:lecturer,reviewer'])->controller(RoleLecturerController::class)->group( function () {
    Route::get('/proposal', 'proposal')->name('lecturer.proposal');
    Route::get('/proposal/{id?}', 'confirm')->name('lecturer.confirm');
    Route::get('/proposal-bimbingan/{id?}', 'confirmBimbingan')->name('lecturer.confirm-bimbingan');

    Route::get('/simbelmawa-account', 'getSimbelmawa')->name('lecturer.simbelmawa');
    Route::get('/bimbingan/get/{user_id?}', 'showBimbingan')->name('lecturer.show-bimbingan');
});

/*
|--------------------------------------------------------------------------
|                           Reviewer Routes
|--------------------------------------------------------------------------
*/
Route::get('/reviewer', [LecturerDashboard::class, 'indexReviewer'])->name('reviewer.index');

Route::prefix('reviewer')->middleware(['role:lecturer,reviewer'])->controller(RoleReviewerController::class)->group( function () {
    Route::get('/proposal', 'proposal')->name('reviewer.proposal');
    Route::get('/proposal/{id?}', 'confirm')->name('reviewer.confirm');

    Route::get('/proposal/get-proposal/{id?}', 'getProposal')->name('reviewer.get-proposal');
    Route::post('/proposal/upload-proposal/{id?}', 'upload')->name('reviewer.upload-proposal');

    Route::get('/proposal/belum-review/{id}', 'belum_review');
    Route::post('/proposal/belum-review','proses_belumreview');
    Route::get("/proposal/belum-review/{id}/update-status", 'update_status');
});

/*
|--------------------------------------------------------------------------
|                           Tim PKM Routes
|--------------------------------------------------------------------------
*/
Route::get('/team', [StudentDashboard::class, 'index'])->name('student.index');

Route::prefix('team')->middleware(['role:student'])->controller(RoleStudentController::class)->group( function () {
    Route::get('/proposal', 'proposal')->name('student.proposal');
    Route::post('/proposal', 'uploadProposal')->name('student.upload-proposal');
    Route::post('/proposal-done', 'uploadProposalDone')->name('student.upload-proposal-done');

    Route::post('/profile/update', 'update')->name('student.profile.update');
    Route::post('/profile/change-password', 'changePassword')->name('student.profile.change-password');
});

Route::prefix('team/bimbingan')->middleware(['role:student'])->controller(BimbinganStudentController::class)->group( function () {
    Route::get('/', 'index')->name('student.bimbingan.index');
    Route::post('/store', 'store')->name('student.bimbingan.store');
    Route::get('/{id?}', 'show')->name('student.bimbingan.show');
    Route::post('/update/{id?}', 'update')->name('student.bimbingan.update');
    Route::get('/delete/{id?}', 'delete')->name('student.bimbingan.delete');
});

Route::get('/team/profile', function () {
    return view('tim.profile.index');
})->name('tim.profile');