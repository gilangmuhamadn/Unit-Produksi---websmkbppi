<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
// use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\EkskulController;
use App\Http\Controllers\EkskulPhotoController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\AdminRegisterController;
use App\Http\Controllers\CKEditorController;







Route::delete('ekskul-photo/{photo}', [EkskulController::class, 'destroyPhoto'])->name('ekskul.photo.destroy');
Route::get('/ekskul', [EkskulController::class, 'index'])->name('ekskul.index');
Route::get('/ekskul/{id}', [EkskulController::class, 'show'])->name('ekskul.show');


Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan.index');
Route::get('/jurusan/{id}', [JurusanController::class, 'show'])->name('jurusan.show');




Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');


Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
Route::get('/staff/{id}', [StaffController::class, 'show'])->name('staff.show');



Route::get('/', function () {
    return redirect('/home');
});


Route::get('/home', function () {
    return view('welcome');
})->name('home')->middleware('auth');




Route::get('news', [NewsController::class, 'index'])->name('news.index');
Route::get('news/{news}', [NewsController::class, 'show'])->name('news.show');




Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('/faq', FAQController::class);
    Route::get('/faq', [FAQController::class, 'index'])->name('faq.index');
});

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('/gallery', GalleryController::class);
    Route::get('/admin/gallery', [GalleryController::class, 'index'])->name('admin.gallery.index');
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::resource('/admin/testimonial', TestimonialController::class);
    Route::get('/admin/testimonial', [TestimonialController::class, 'index'])->name('admin.testimonial.index');
    Route::post('/ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('admin/register', [AdminRegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/admin/register', [AdminRegisterController::class, 'register'])->name('register.submit');
});


Route::middleware('auth', 'is_admin')->group(function () {
    Route::get('/admin/ekskul', [EkskulController::class, 'index'])->name('admin.ekskul.index');
    Route::get('/admin/ekskul/create', [EkskulController::class, 'create'])->name('admin.ekskul.create');
    Route::post('/admin/ekskul', [EkskulController::class, 'store'])->name('admin.ekskul.store');
    Route::get('/admin/ekskul/{id}/edit', [EkskulController::class, 'edit'])->name('admin.ekskul.edit'); // PERBAIKAN DI SINI
    Route::put('/admin/ekskul/{id}', [EkskulController::class, 'update'])->name('admin.ekskul.update');
    Route::delete('/admin/ekskul/photo/{photo}', [EkskulPhotoController::class, 'destroyphoto'])
    ->name('admin.ekskul.photo.destroy');    
    Route::delete('/admin/ekskul/{id}', [EkskulController::class, 'destroy'])->name('admin.ekskul.destroy');
});

Route::middleware('auth', 'is_admin')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('jurusan', JurusanController::class);
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/staff', [StaffController::class, 'index'])->name('admin.staff.index');
    Route::get('/admin/staff/create', [StaffController::class, 'create'])->name('admin.staff.create');
    
    Route::post('/admin/staff', [StaffController::class, 'store'])->name('admin.staff.store');
    Route::get('/admin/{staff}/edit', [StaffController::class, 'edit'])->name('admin.staff.edit');
    Route::put('/admin/staff/{staff}', [StaffController::class, 'update'])->name('admin.staff.update');
    Route::delete('/admin/staff/{staff}', [StaffController::class, 'destroy'])->name('admin.staff.destroy');
    
});



Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/news', [NewsController::class, 'index'])->name('admin.news.index');
    Route::get('/admin/news/create', [NewsController::class, 'create'])->name('admin.news.create');
    Route::post('/admin/news', [NewsController::class, 'store'])->name('admin.news.store');
    Route::get('/admin/news/{id}/edit', [NewsController::class, 'edit'])->name('admin.news.edit');
    Route::put('/admin/news/{id}', [NewsController::class, 'update'])->name('admin.news.update');
    Route::delete('/admin/news/{id}', [NewsController::class, 'destroy'])->name('admin.news.destroy');
});


Route::middleware(['auth', 'is_admin'])->group(function ()  {
    Route::get('/admin/articles', [ArticleController::class, 'index'])->name('admin.articles.index');
    Route::get('/admin/articles/create', [ArticleController::class, 'create'])->name('admin.articles.create');
    Route::post('/admin/articles', [ArticleController::class, 'store'])->name('admin.articles.store');
    Route::get('/admin/articles/{id}/edit', [ArticleController::class, 'edit'])->name('admin.articles.edit');
    Route::put('/admin/articles/{id}', [ArticleController::class, 'update'])->name('admin.articles.update');
    Route::delete('/admin/articles/{id}', [ArticleController::class, 'destroy'])->name('admin.articles.destroy');
    Route::post('/upload-image', [ArticleController::class, 'uploadImage'])->name('articles.upload-image');

});



Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth')->name('dashboard');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



