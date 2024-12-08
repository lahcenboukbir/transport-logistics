<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomizationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EquipmentNameController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PortController;
use App\Http\Controllers\ProspectController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SetupController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Auth;
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

// Authentication
Auth::routes();

// Dashboard
Route::controller(DashboardController::class)->group(function () {
    Route::get('/', 'index')->name('dashboard.index');
});

// Users
Route::controller(UserController::class)->group(function () {
    Route::get('users', 'index')->name('users.index');
    Route::get('users/create', 'create')->name('users.create');
    Route::post('users', 'store')->name('users.store');
    Route::get('users/{id}', 'show')->name('users.show');
    Route::get('users/{id}/edit', 'edit')->name('users.edit');
    Route::put('users/{id}/edit', 'update')->name('users.update');
    Route::delete('users/{id}', 'destroy')->name('users.destroy');
    Route::post('users/{id}/activation', 'activation')->name('users.activation');
});


// Roles
Route::controller(RoleController::class)->group(function () {
    Route::get('roles', 'index')->name('roles.index');
    Route::get('roles/create', 'create')->name('roles.create');
    Route::post('roles', 'store')->name('roles.store');
    Route::get('roles/{id}', 'show')->name('roles.show');
    Route::get('roles/{id}/edit', 'edit')->name('roles.edit');
    Route::put('roles/{id}/edit', 'update')->name('roles.update');
    Route::delete('roles/{id}', 'destroy')->name('roles.destroy');
});

// Prospects
Route::controller(ProspectController::class)->group(function () {
    Route::get('prospects', 'index')->name('prospects.index');
    Route::get('prospects/create', 'create')->name('prospects.create');
    Route::post('prospects', 'store')->name('prospects.store');
    Route::get('prospects/{id}', 'show')->name('prospects.show');
    Route::get('prospects/{id}/edit', 'edit')->name('prospects.edit');
    Route::put('prospects{id}/edit', 'update')->name('prospects.update');
    Route::delete('prospects/{id}', 'destroy')->name('prospects.destroy');
    Route::put('prospects/{id}/status', 'status')->name('prospects.status');
});

// Customers
Route::controller(CustomerController::class)->group(function () {
    Route::get('customers', 'index')->name('customers.index');
    Route::post('customers', 'store')->name('customers.store');
    Route::get('customers/{id}', 'show')->name('customers.show');
    Route::delete('customers/{id}', 'destroy')->name('customers.destroy');
});

// Appointments
Route::controller(AppointmentController::class)->group(function () {
    Route::get('appointments', 'index')->name('appointments.index');
    Route::get('appointments/create', 'create')->name('appointments.create');
    Route::post('appointments', 'store')->name('appointments.store');
    Route::get('appointments/{id}', 'show')->name('appointments.show');
    Route::get('appointments/{id}/edit', 'edit')->name('appointments.edit');
    Route::put('appointments{id}/edit', 'update')->name('appointments.update');
    Route::delete('appointments/{id}', 'destroy')->name('appointments.destroy');
});

// Consultations
Route::controller(ConsultationController::class)->group(function () {
    Route::get('consultations', 'index')->name('consultations.index');
    Route::get('consultations/create', 'create')->name('consultations.create');
    Route::post('consultations', 'store')->name('consultations.store');
    Route::get('consultations/{id}', 'show')->name('consultations.show');
    Route::get('consultations/{id}/edit', 'edit')->name('consultations.edit');
    Route::put('consultations{id}/edit', 'update')->name('consultations.update');
    Route::delete('consultations/{id}', 'destroy')->name('consultations.destroy');
    Route::put('consultations/{id}/confirm', 'confirm')->name('consultations.confirm');
    Route::put('consultations/{id}/unconfirm', 'unconfirm')->name('consultations.unconfirm');
    Route::put('consultations/{id}/notes', 'notes')->name('consultations.notes');
    Route::put('consultations/{id}/concretisation', 'concretisation')->name('consultations.concretisation');
});

// shipments
Route::controller(ShipmentController::class)->group(function () {
    Route::get('shipments', 'index')->name('shipments.index');
    Route::put('shipments{id}/status', 'status')->name('shipments.status');
    Route::put('shipments{id}/delayed', 'delayed')->name('shipments.delayed');
});

// Ports
Route::controller(PortController::class)->group(function () {
    Route::get('ports', 'index')->name('ports.index');
    Route::get('ports/create', 'create')->name('ports.create');
    Route::post('ports', 'store')->name('ports.store');
    Route::get('ports/{id}/edit', 'edit')->name('ports.edit');
    Route::put('ports{id}/edit', 'update')->name('ports.update');
    Route::delete('ports/{id}', 'destroy')->name('ports.destroy');
});

// Equipment
Route::controller(EquipmentNameController::class)->group(function () {
    Route::get('equipments', 'index')->name('equipments.index');
    Route::get('equipments/create', 'create')->name('equipments.create');
    Route::post('equipments', 'store')->name('equipments.store');
    Route::get('equipments/{id}/edit', 'edit')->name('equipments.edit');
    Route::put('equipments/{id}/edit', 'update')->name('equipments.update');
    Route::delete('equipments/{id}', 'destroy')->name('equipments.destroy');
});

// Report
Route::controller(ReportController::class)->group(function () {
    Route::get('report/pdf', 'pdf')->name('reports.pdf');
    Route::get('report/excel', 'excel')->name('reports.excel');
    Route::get('report/analytics', 'analytics')->name('reports.analytics');
});

// PDF
Route::controller(PDFController::class)->group(function () {
    Route::get('report/pdf/users/list', 'usersList')->name('users.list.pdf');
    Route::get('report/pdf/users/statistics', 'usersStatistics')->name('users.statistics.pdf');

    Route::get('report/pdf/prospects/list', 'prospectsList')->name('prospects.list.pdf');
    Route::get('report/pdf/prospects/statistics', 'prospectsStatistics')->name('prospects.statistics.pdf');

    Route::get('report/pdf/customers/list', 'customersList')->name('customers.list.pdf');
    Route::get('report/pdf/customers/statistics', 'customersStatistics')->name('customers.statistics.pdf');

    Route::get('report/pdf/appointments/list', 'appointmentsList')->name('appointments.list.pdf');
    Route::get('report/pdf/appointments/statistics', 'appointmentsStatistics')->name('appointments.statistics.pdf');

    Route::get('report/pdf/consultations/list', 'consultationsList')->name('consultations.list.pdf');
    Route::get('report/pdf/consultations/statistics', 'consultationsStatistics')->name('consultations.statistics.pdf');

    Route::get('report/pdf/shipments/list', 'shipmentsList')->name('shipments.list.pdf');

    Route::get('report/pdf/ports/list', 'portsList')->name('ports.list.pdf');

    Route::get('report/pdf/equipments/list', 'equipmentsList')->name('equipments.list.pdf');
});

// Excel
Route::controller(ExcelController::class)->group(function () {
    Route::get('report/excel/users/list', 'usersList')->name("users.list.excel");
    Route::get('report/excel/prospects/list', 'prospectsList')->name("prospects.list.excel");
    Route::get('report/excel/customers/list', 'customersList')->name("customers.list.excel");
    Route::get('report/excel/appointments/list', 'appointmentsList')->name("appointments.list.excel");
    Route::get('report/excel/consultations/list', 'consultationsList')->name("consultations.list.excel");
    Route::get('report/excel/shipments/list', 'shipmentsList')->name("shipments.list.excel");
    Route::get('report/excel/ports/list', 'portsList')->name("ports.list.excel");
    Route::get('report/excel/equipments/list', 'equipmentsList')->name("equipments.list.excel");
});

// Customizations
Route::controller(CustomizationController::class)->group(function () {
    Route::get('customizations/logo', 'logo')->name('logo');
    Route::put('customizations/logo', 'logoUpdate')->name('logo.update');

    Route::get('customizations/name', 'name')->name('name');
    Route::put('customizations/name', 'nameUpdate')->name('name.update');
});

// User Profile
Route::controller(UserProfileController::class)->group(function () {
    Route::get('profile', 'show')->name('profile.show');
    Route::get('profile/settings', 'edit')->name('profile.edit');
    Route::put('profile/settings/details', 'details')->name('profile.details');
    Route::put('profile/settings/password', 'password')->name('profile.password');
    Route::delete('profile/settings', 'destroy')->name('profile.destroy');
});
