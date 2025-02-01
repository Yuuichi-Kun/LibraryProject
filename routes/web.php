<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RakController;
use App\Http\Controllers\DDCController;
use App\Http\Controllers\FormatController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\PengarangController;
use App\Http\Controllers\JenisAnggotaController;
use App\Http\Controllers\PerpustakaanController;
use App\Http\Controllers\PustakaController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AdminAnggotaController;
use App\Http\Controllers\AdminTransaksiController;
use App\Http\Controllers\ProfileController;

Auth::routes(['verify' => true]);  // Ini akan menambahkan semua route autentikasi termasuk login, register, reset password, dan verifikasi email

// Public routes (tidak perlu login)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/book/{id}', [HomeController::class, 'showBook'])->name('book.show');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/anggota/register', [AnggotaController::class, 'create'])->name('anggota.create');
Route::post('/anggota/store', [AnggotaController::class, 'store'])->name('anggota.store');

// Protected routes (perlu login)
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // Route user yang membutuhkan auth bisa ditambahkan di sini

    Route::prefix('profile')->group(function () {
        Route::get('/profile', [UserProfileController::class, 'edit'])->name('profileUser.edit');
        Route::patch('/profile', [UserProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [UserProfileController::class, 'destroy'])->name('profile.destroy');
        Route::post('/profile', [UserProfileController::class, 'store'])->name('user.profile.store');

        // Password Reset Routes - Fix the duplicate and conflicting route
    Route::put('/profile/password', [App\Http\Controllers\Auth\UserPasswordController::class, 'update'])
    ->name('password.update');
    });
});
  
// Admin routes
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    
    // Rak Routes
    Route::resource('rak', RakController::class);
    
    // DDC Routes
    Route::resource('ddc', DDCController::class);
    
    // New routes
    Route::resource('format', FormatController::class);
    Route::resource('penerbit', PenerbitController::class);
    Route::resource('pengarang', PengarangController::class);
    Route::resource('jenis-anggota', JenisAnggotaController::class);
    
    // Perpustakaan routes
    Route::get('perpustakaan/edit', [PerpustakaanController::class, 'edit'])->name('perpustakaan.edit');
    Route::put('perpustakaan/update', [PerpustakaanController::class, 'update'])->name('perpustakaan.update');
    
    // Pustaka routes
    Route::resource('pustaka', PustakaController::class);

    // Password Reset Routes
    Route::put('admin/password', [App\Http\Controllers\Auth\AdminPasswordController::class, 'update'])
        ->name('admin.password.update');

    Route::get('/admin/anggota', [AdminAnggotaController::class, 'index'])->name('admin.anggota.index');
    Route::post('/admin/anggota/{id}/activate', [AdminAnggotaController::class, 'activate'])->name('admin.anggota.activate');

    Route::get('/admin/transaksi', [AdminTransaksiController::class, 'index'])->name('admin.transaksi.index');
    Route::post('/admin/transaksi/{id}/approve', [AdminTransaksiController::class, 'approve'])->name('admin.transaksi.approve');
    Route::post('/admin/transaksi/{id}/reject', [AdminTransaksiController::class, 'reject'])->name('admin.transaksi.reject');

    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/admin/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/admin/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/admin/profile', [ProfileController::class, 'store'])->name('admin.profile.store');
});

// Email Verification Routes
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Transaksi routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/create/{id_pustaka}', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/transaksi/history', [TransaksiController::class, 'history'])->name('transaksi.history');
    Route::patch('/transaksi/{id}/return', [TransaksiController::class, 'returnBook'])->name('transaksi.return');
});

Route::get('/books', [PustakaController::class, 'userIndex'])->name('books.index');
