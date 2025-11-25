<?php

use App\Http\Controllers\BagianpklController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\PembimbingpklController;
use App\Http\Controllers\PembimbingsekolahController;
use App\Http\Controllers\PenempatanpklController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\User\JurusanUserController;
use App\Http\Controllers\User\SekolahUserController;
use App\Http\Controllers\User\BagianpklUserController;
use App\Http\Controllers\User\SiswaUserController;
use App\Http\Controllers\User\PembimbingsekolahUserController;
use App\Http\Controllers\User\PembimbingpklUserController;
use App\Http\Controllers\User\PenempatanpklUserController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\VerifyEmailController;

// ➕ Tambahkan ini
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;

use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Auth: Login / Logout
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Register
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

// Reset Password (Breeze)
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->name('password.store');

// OTP (tidak pakai auth middleware karena user belum login)
Route::get('/verify-code', [RegisteredUserController::class, 'showVerifyForm'])->name('verify.otp');
Route::post('/verify-code', [RegisteredUserController::class, 'verifyCode'])->name('verify.code');
Route::post('/resend-otp', [RegisteredUserController::class, 'resendOtp'])->name('resend.otp');

// Email verification (setelah login)
Route::middleware(['auth'])->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed'])
        ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware(['throttle:6,1'])
        ->name('verification.send');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Admin Routes
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::resource('jurusan', JurusanController::class);
    Route::resource('sekolah', SekolahController::class);
    Route::resource('bagianpkl', BagianpklController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('pembimbingsekolah', PembimbingsekolahController::class);
    Route::resource('pembimbingpkl', PembimbingpklController::class);
    Route::resource('penempatanpkl', PenempatanpklController::class);

    Route::get('/penempatanpkl/{id}', [PenempatanpklController::class, 'show'])
        ->name('penempatanpkl.show');
});

// User Routes
Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    Route::get('/lihat/jurusan', [JurusanUserController::class, 'index'])->name('user.jurusan.index');
    Route::get('/lihat/sekolah', [SekolahUserController::class, 'index'])->name('user.sekolah.index');
    Route::get('/lihat/bagianpkl', [BagianpklUserController::class, 'index'])->name('user.bagianpkl.index');
    Route::get('/lihat/siswa', [SiswaUserController::class, 'index'])->name('user.siswa.index');
    Route::get('/lihat/pembimbingsekolah', [PembimbingsekolahUserController::class, 'index'])->name('user.pembimbingsekolah.index');
    Route::get('/lihat/pembimbingpkl', [PembimbingpklUserController::class, 'index'])->name('user.pembimbingpkl.index');
    Route::get('/lihat/penempatanpkl', [PenempatanpklUserController::class, 'index'])->name('user.penempatanpkl.index');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
