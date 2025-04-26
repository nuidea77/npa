<?php

use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\CustomPageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CustomerLessonController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\LessonController;

Route::get('/lessons/{id}', [LessonController::class, 'view'])->name('lessons.view');


Route::post('/submit-comment', [CommentController::class, 'store'])->name('feedback.store');


Route::get('/set-locale/{lang}', function ($lang) {
    if (in_array($lang, ['en', 'mn'])) {
        Session::put('locale', $lang);
    }
    return redirect()->back();
});



Route::get('/', [HomeController::class, 'index']);
Route::get('/programs', [ProgramController::class, 'index'])->name('programs.index');
Route::get('/program/{id}', [ProgramController::class, 'view']);

Route::get('/posts', [NewsController::class, 'index'])->name('news.index');
Route::get('/post/{id}', [NewsController::class, 'view']);

Route::get('/places', [PlaceController::class, 'index'])->name('place.index');
Route::get('/place/{id}', [PlaceController::class, 'view'])->name('place.view');


Route::get('/about',[PageController::class, 'about']);
Route::get('/faq', [PageController::class, 'faq']);

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::get('/requests', [CustomPageController::class, 'index'])->name('admin.custom.page');

    // Customer Verification Update Route
    Route::get('customers/verify/{id}/{status}', [CustomPageController::class, 'updateVerifyStatus'])
        ->name('admin.customer.verify');
});

Route::get('/customer/lessons/{id}', [CustomerLessoncontroller::class, 'view'])->name('customer.lesson');
Route::get('/customer/register', [CustomerController::class, 'create'])->name('customer.register');
Route::post('customer/register', [CustomerController::class, 'store'])->name('customer.register.submit');
Route::get('customer/signin', [AuthController::class, 'showLoginForm'])->name('customer.signin');
Route::post('customer/signin', [AuthController::class, 'login'])->name('customer.signin.submit');
Route::get('customer/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth.customer')
    ->name('customer.dashboard');


    Route::middleware(['auth.customer'])->group(function () {
        Route::get('customer/dashboard', [DashboardController::class, 'dashboard'])->name('customer.dashboard');
        Route::get('customer/dashboard/edit', [DashboardController::class, 'edit'])->name('customer.edit');
        Route::post('customer/dashboard/update', [DashboardController::class, 'update'])->name('customer.update');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    });
  // Voyager routes should be inside this group
  Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
