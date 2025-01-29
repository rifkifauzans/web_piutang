<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LandingPagesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\KontrakController;
use App\Http\Controllers\BidangController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\KompensansiController;
use App\Http\Controllers\ContractPartnerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\BayarController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landingpages.landingpages');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route untuk halaman admin
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.home'); // File admin.master.blade.php
    })->name('admin');
});

// Route untuk halaman user
Route::middleware(['auth'])->group(function () {
    Route::get('/user', function () {
        return view('user.user'); // File user.user.blade.php
    })->name('user');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/', [App\Http\Controllers\LandingPagesController::class, 'landingpages'])->name('landingpages');
Route::get('/partnerPages', [App\Http\Controllers\LandingPagesController::class, 'partnerPages'])->name('partnerPages');
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'admin'])->name('admin');
Route::get('/users/contracts', [ContractPartnerController::class, 'index'])->name('contractPartner');
Route::get('/contract/{id}', [ContractPartnerController::class, 'show'])->name('detail');

// Users Routes
Route::get('/users', [UsersController::class, 'index'])->name('listUsers');
Route::get('/users/edit/{id}', [UsersController::class, 'edit'])->name('editUsers');
Route::put('/users/edit/{id}', [UsersController::class, 'update'])->name('updateUsers');
Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('deleteUsers');
Route::get('/users/trash', [UsersController::class, 'trash'])->name('trashUsers');
Route::put('/users/restore/{id}', [UsersController::class, 'restore'])->name('restoreUsers');
Route::patch('users/restore/{id}', [UsersController::class, 'restore'])->name('users.restore');
Route::delete('/users/force-delete/{id}', [UsersController::class, 'forceDelete'])->name('forceDeleteUsers');

// Employees Routes
Route::get('/employees', [EmployeesController::class, 'index'])->name('listEmployees');
Route::get('/employees/create', [EmployeesController::class, 'create'])->name('createEmployees');
Route::post('/employees', [EmployeesController::class, 'store'])->name('storeEmployees');
Route::get('/employees/edit/{id}', [EmployeesController::class, 'edit'])->name('editEmployees');
Route::put('/employees/edit/{id}', [EmployeesController::class, 'update'])->name('updateEmployees');
Route::delete('/employees/{id}', [EmployeesController::class, 'destroy'])->name('deleteEmployees');
Route::get('/employees/trash', [EmployeesController::class, 'trash'])->name('trashEmployees');
Route::put('/employees/restore/{id}', [EmployeesController::class, 'restore'])->name('restoreEmployees');
Route::patch('employees/restore/{id}', [EmployeesController::class, 'restore'])->name('employees.restore');
Route::delete('/employees/force-delete/{id}', [EmployeesController::class, 'forceDelete'])->name('forceDeleteEmployees');

// Fields Routes
Route::get('/fields', [BidangController::class, 'index'])->name('listFields');
Route::get('/fields/create', [BidangController::class, 'create'])->name('createFields');
Route::post('/fields', [BidangController::class, 'store'])->name('storeFields');
Route::get('/fields/edit/{id}', [BidangController::class, 'edit'])->name('editFields');
Route::put('/fields/edit/{id}', [BidangController::class, 'update'])->name('updateFields');
Route::delete('/fields/{id}', [BidangController::class, 'destroy'])->name('deleteFields');
Route::get('/fields/trash', [BidangController::class, 'trash'])->name('trashFields');
Route::put('/fields/restore/{id}', [BidangController::class, 'restore'])->name('restoreFields');
Route::patch('fields/restore/{id}', [BidangController::class, 'restore'])->name('fields.restore');
Route::delete('/fields/force-delete/{id}', [BidangController::class, 'forceDelete'])->name('forceDeleteFields');

// Regions Routes
Route::get('/regions', [RegionController::class, 'index'])->name('listRegions');
Route::get('/regions/create', [RegionController::class, 'create'])->name('createRegions');
Route::post('/regions', [RegionController::class, 'store'])->name('storeRegions');
Route::get('/regions/edit/{id}', [RegionController::class, 'edit'])->name('editRegions');
Route::put('/regions/edit/{id}', [RegionController::class, 'update'])->name('updateRegions');
Route::delete('/regions/{id}', [RegionController::class, 'destroy'])->name('deleteRegions');
Route::get('/regions/trash', [RegionController::class, 'trash'])->name('trashRegions');
Route::put('/regions/restore/{id}', [RegionController::class, 'restore'])->name('restoreRegions');
Route::patch('regions/restore/{id}', [RegionController::class, 'restore'])->name('regions.restore');
Route::delete('/regions/force-delete/{id}', [RegionController::class, 'forceDelete'])->name('forceDeleteRegions');

// Partners Routes
Route::get('/partners', [PartnerController::class, 'index'])->name('listPartners');
Route::get('/partners/create', [PartnerController::class, 'create'])->name('createPartners');
Route::post('/partners', [PartnerController::class, 'store'])->name('storePartners');
Route::get('/partners/edit/{id}', [PartnerController::class, 'edit'])->name('editPartners');
Route::put('/partners/{id}', [PartnerController::class, 'update'])->name('updatePartners');
Route::delete('/partners/{id}', [PartnerController::class, 'destroy'])->name('deletePartners');
Route::get('/partners/trash', [PartnerController::class, 'trash'])->name('trashPartners');
Route::patch('/partners/{id}/restore', [PartnerController::class, 'restore'])->name('restorePartners');
Route::delete('/partners/{id}/forceDelete', [PartnerController::class, 'forceDelete'])->name('forceDeletePartners');

// Contracts Routes
Route::get('/kontraks', [KontrakController::class, 'index'])->name('listContracts');
Route::get('/kontraks/create', [KontrakController::class, 'create'])->name('createContracts');
Route::post('/kontraks', [KontrakController::class, 'store'])->name('storeContracts');
Route::get('/kontraks/edit/{id}', [KontrakController::class, 'edit'])->name('editContracts');
Route::put('/kontraks/{id}', [KontrakController::class, 'update'])->name('updateContracts');
Route::get('/contracts/{id}', [KontrakController::class, 'show'])->name('contracts.show');
Route::delete('/kontraks/{id}', [KontrakController::class, 'destroy'])->name('deleteContracts');
Route::get('/kontraks/trash', [KontrakController::class, 'trash'])->name('trashContracts');
Route::patch('/kontraks/{id}/restore', [KontrakController::class, 'restore'])->name('restoreContracts');
Route::delete('/kontraks/{id}/forceDelete', [KontrakController::class, 'forceDelete'])->name('forceDeleteContracts');
// Compensations Routes
Route::get('/kontraks/{contractId}/kompensansi', [KompensansiController::class, 'index'])->name('listCompensations');
Route::get('/kontraks/{contractId}/kompensansi/create', [KompensansiController::class, 'create'])->name('createCompensations');
Route::get('/kontraks/{contractId}/kompensansi/createCompen', [KompensansiController::class, 'createCompenshare'])->name('createCompenshare');
Route::post('/kontraks/{contractId}/kompensasi/store', [KompensansiController::class, 'store'])->name('storeCompensations');
Route::post('/kontraks/{contractId}/kompensasi/storeCompen', [KompensansiController::class, 'storeCompenshare'])->name('storeCompenshare');
Route::get('/kontraks/{contractId}/kompensasi/edit/{id}', [KompensansiController::class, 'editCompenshare'])->name('editCompenshare');
Route::put('/kontraks/{contractId}/kompensasi/{id}', [KompensansiController::class, 'updateCompenshare'])->name('updateCompenshare');
Route::delete('/kontraks/{contractId}/kompensasi/{id}', [KompensansiController::class, 'destroyCompenshare'])->name('destroyCompenshare');
Route::get('/kontraks/{contractId}/kompensasi/trashCompenshare', [KompensansiController::class, 'trashCompenshare'])->name('trashCompenshare');
Route::patch('/kontraks/{contractId}/kompensasi/{id}/restore', [KompensansiController::class, 'restoreCompenshare'])->name('restoreCompenshare');
Route::delete('/kontraks/{contractId}/kompensasi/{id}/force', [KompensansiController::class, 'forceDeleteCompenshare'])->name('forceDeleteCompenshare');

// Invoices Routes
Route::get('/kontraks/{contractId}/invoice', [InvoiceController::class, 'index'])->name('listInvoices');
Route::get('/kontraks/{contractId}/invoice/create', [InvoiceController::class, 'create'])->name('createInvoices');
Route::post('/kontraks/{contractId}/invoice/storeInvoice', [InvoiceController::class, 'store'])->name('storeInvoice');
Route::get('/kontraks/{contractId}/invoice/{id}/edit', [InvoiceController::class, 'edit'])->name('editInvoice');
Route::put('/kontraks/{contractId}/invoice/{id}', [InvoiceController::class, 'update'])->name('updateInvoice');
Route::delete('/kontraks/{contractId}/invoice/{id}', [InvoiceController::class, 'destroy'])->name('destroyInvoice');
Route::get('/kontraks/{contractId}/kompensasi/trash', [InvoiceController::class, 'trash'])->name('trashInvoices');
Route::patch('/kontraks/{contractId}/kompensasi/{id}/restore', [InvoiceController::class, 'restore'])->name('restoreInvoices');
Route::delete('/kontraks/{contractId}/kompensasi/{id}/force', [InvoiceController::class, 'forceDelete'])->name('forceDeleteInvoices');

// Payments Routes
Route::get('/kontraks/{contractId}/payments', [BayarController::class, 'index'])->name('listPayments');
Route::get('/kontraks/{contractId}/payments/{id}/editPayments', [BayarController::class, 'edit'])->name('editPayments');
Route::put('/kontraks/{contractId}/payments/{id}/update', [BayarController::class, 'update'])->name('updatePayments');
Route::get('/kontraks/{contractId}/payment/create', [ContractPartnerController::class, 'create'])->name('createPayment');
Route::post('/kontraks/{contractId}/payment/storePayment', [ContractPartnerController::class, 'store'])->name('storePayment');