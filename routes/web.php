<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CouncilsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\DelegationForm; // Impor komponen Livewire
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
| Developed for Jagomun on 16 June 2025.
|
*/

// Landing Page (Home Page)
Route::get('/', function () {
    return view('home'); // Directly return the 'home' view as the landing page
})->name('home');

// About Page
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Councils Page
Route::get('/councils', [CouncilsController::class, 'index'])->name('councils');

// Contact Page
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit'); // For form submission

// --- NEW REGISTRATION FLOW ROUTES ---
Route::prefix('register')->name('registration.')->group(function () {
    // SS 1: Choose Registration Type (Individual, Delegation, Observer)
    Route::get('/type-selection', [RegistrationController::class, 'chooseType'])->name('chooseType');
    Route::post('/process-type', [RegistrationController::class, 'processType'])->name('processType');

    // SS 2: Choose Delegate Type (National, International)
    Route::get('/choose-delegate-type/{type}', [RegistrationController::class, 'chooseDelegateType'])->name('chooseDelegateType');
    Route::post('/process-delegate-type', [RegistrationController::class, 'processDelegateType'])->name('processDelegateType');

    // Individual Delegate Form
    Route::get('/individual-form', [RegistrationController::class, 'showIndividualForm'])->name('individualForm');
    Route::post('/individual-submit', [RegistrationController::class, 'submitIndividualForm'])->name('individualSubmit');

    // Delegation Form (Memuat komponen Livewire)
    Route::get('/delegation-form', [RegistrationController::class, 'showDelegationForm'])->name('delegationForm');

    // Observer Form
    Route::get('/observer-form/{delegate_type}', [RegistrationController::class, 'observerForm'])->name('observerForm');
    Route::post('/observer-submit', [RegistrationController::class, 'submitObserverForm'])->name('observerSubmit'); // Route untuk submit form Observer

    // Success Page
    Route::get('/success', [RegistrationController::class, 'success'])->name('success');
});

// Laravel Breeze Authentication Routes (tetap ada jika diperlukan untuk login user ke dashboard)
require __DIR__.'/auth.php';

// Dashboard route for authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


// --- ADMIN DASHBOARD ROUTES ---
// PERHATIAN: Tidak ada proteksi login. Siapa pun bisa melihat dashboard admin.
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/registrations/{registration}', [AdminController::class, 'showRegistrationDetail'])->name('registration.detail');
});
