<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordRecoveryController;
use App\Http\Controllers\EmployeeController;

use App\Http\Middleware\RoleMiddleware;


// Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
// Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/forgot', [PasswordRecoveryController::class, 'showRequestForm'])->name('password.request');
Route::post('/forgot', [PasswordRecoveryController::class, 'generateToken'])->name('password.generate');
Route::get('/reset/{token}', [PasswordRecoveryController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset', [PasswordRecoveryController::class, 'changePassword'])->name('password.change');
Route::get('/dashboard/employeees', [EmployeeController::class, 'showEmployees'])->name('employees.show')->middleware(
    ['auth', RoleMiddleware::class.':ADMIN']
);
Route::get('/dashboard/employee/new', [EmployeeController::class, 'showCreateForm'])->name('employee.new')->middleware(
    ['auth', RoleMiddleware::class.':ADMIN']
);
Route::post('/dashboard/employee/new', [EmployeeController::class, 'storeEmployee'])->name('employee.store')->middleware(
    ['auth', RoleMiddleware::class.':ADMIN']
);
Route::get('/dashboard/employee/{id}', [EmployeeController::class, 'showEmployee'])->name('employee.show')->middleware(
    ['auth', RoleMiddleware::class.':ADMIN']
);
Route::get('/dashboard/employee/{id}/edit', [EmployeeController::class, 'showEditForm'])->name('employee.edit')->middleware(
    ['auth', RoleMiddleware::class.':ADMIN']
);
Route::post('/dashboard/employee/{id}/edit', [EmployeeController::class, 'editEmployee'])->name('employee.update')->middleware(
    ['auth', RoleMiddleware::class.':ADMIN']
);
Route::get('/dashboard/employee/{id}/delete', [EmployeeController::class, 'deleteEmployee'])->name('employee.delete')->middleware(
    ['auth', RoleMiddleware::class.':ADMIN']
);
Route::get('/dashboard', function () {
    return view('panels.default');
})->middleware(['auth'])->name('dashboard');
