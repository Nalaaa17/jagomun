<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CouncilsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\DelegationForm;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- PUBLIC ROUTES ---
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/councils', [CouncilsController::class, 'index'])->name('councils');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');


// --- REGISTRATION FLOW ROUTES ---
Route::prefix('register')->name('registration.')->group(function () {
    Route::get('/type-selection', [RegistrationController::class, 'chooseType'])->name('chooseType');
    Route::post('/process-type', [RegistrationController::class, 'processType'])->name('processType');
    Route::get('/choose-delegate-type/{type}', [RegistrationController::class, 'chooseDelegateType'])->name('chooseDelegateType');
    Route::post('/process-delegate-type', [RegistrationController::class, 'processDelegateType'])->name('processDelegateType');
    Route::get('/individual-form', [RegistrationController::class, 'showIndividualForm'])->name('individualForm');
    Route::post('/individual-submit', [RegistrationController::class, 'submitIndividualForm'])->name('individualSubmit');
    Route::get('/delegation-form', [RegistrationController::class, 'showDelegationForm'])->name('delegationForm');
    Route::get('/observer-form/{delegate_type}', [RegistrationController::class, 'observerForm'])->name('observerForm');
    Route::post('/observer-submit', [RegistrationController::class, 'submitObserverForm'])->name('observerSubmit');
    Route::get('/success', [RegistrationController::class, 'success'])->name('success');
});

// --- ADMIN AUTHENTICATION ROUTES ---
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminLoginController::class, 'login']);
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');
});

// --- ADMIN DASHBOARD ROUTES (PROTECTED) ---
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/registrations/{registration}', [AdminController::class, 'showRegistrationDetail'])->name('registration.detail');
    Route::get('contacts', [ContactMessageController::class, 'index'])->name('contacts.index');
    Route::delete('contacts/{contact}', [ContactMessageController::class, 'destroy'])->name('contacts.destroy');
    // Mengarah ke AdminController dan fungsi toggleVerification
    Route::post('/registrations/{registration}/toggle-verification', [AdminController::class, 'toggleVerification'])->name('registration.toggleVerification');
});

// Laravel Breeze Authentication Routes (jika masih diperlukan untuk user biasa)
require __DIR__.'/auth.php';

// Dashboard untuk user biasa (jika ada)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
