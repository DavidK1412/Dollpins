<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordRecoveryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

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
Route::get('/dashboard/employee/{id}/cellphone', [EmployeeController::class, 'showEmployeeCellphones'])->name('employee.phone')->middleware(
    ['auth', RoleMiddleware::class.':ADMIN']);

Route::get('/dashboard/employee/{id}/edit', [EmployeeController::class, 'showEditForm'])->name('employee.edit')->middleware(
    ['auth', RoleMiddleware::class.':ADMIN']
);
Route::post('/dashboard/employee/{id}/edit', [EmployeeController::class, 'editEmployee'])->name('employee.update')->middleware(
    ['auth', RoleMiddleware::class.':ADMIN']
);
Route::post('/dashboard/employee/{id}/cellphone', [EmployeeController::class, 'storeCellphone'])->name('employee.phone.store')->middleware(
    ['auth', RoleMiddleware::class.':ADMIN']);

Route::put('/dashboard/employee/{id}/cellphone', [EmployeeController::class, 'updateCellphone'])->name('employee.phone.update')->middleware(
     ['auth', RoleMiddleware::class.':ADMIN']);

Route::get('/dashboard/employee/{id}/delete', [EmployeeController::class, 'deleteEmployee'])->name('employee.delete')->middleware(
    ['auth', RoleMiddleware::class.':ADMIN']
);
Route::get('/dashboard', function () {
    return view('panels.default');
})->middleware(['auth'])->name('dashboard');

Route::delete('/dashboard/employee/{id}/cellphone', [EmployeeController::class, 'deleteCellphone'])
    ->name('employee.phone.delete')
    ->middleware(['auth', RoleMiddleware::class.':ADMIN']);

Route::get('/dashboard/clients', [ClientController::class, 'showClients'])
    ->name('clients.index')
    ->middleware(['auth', RoleMiddleware::class.':ADMIN,SALES']);

Route::post('/dashboard/clients/new', [ClientController::class, 'createClient'])
    ->name('clients.store')
    ->middleware(['auth', RoleMiddleware::class.':ADMIN,SALES']);

Route::get('/dashboard/clients/new', [ClientController::class, 'showCreateForm'])
    ->name('clients.new')
    ->middleware(['auth', RoleMiddleware::class.':ADMIN,SALES']);

Route::get('/dashboard/clients/{id}', [ClientController::class, 'showClient'])
    ->name('clients.show')
    ->middleware(['auth', RoleMiddleware::class.':ADMIN,SALES']);

Route::get('/dashboard/clients/{id}/edit', [ClientController::class, 'showEditForm'])
    ->name('clients.edit')
    ->middleware(['auth', RoleMiddleware::class.':ADMIN,SALES']);

Route::post('/dashboard/clients/{id}/edit', [ClientController::class, 'updateClient'])
    ->name('clients.update')
    ->middleware(['auth', RoleMiddleware::class.':ADMIN,SALES']);

Route::delete('/dashboard/clients', [ClientController::class, 'deleteClient'])
    ->name('clients.delete')
    ->middleware(['auth', RoleMiddleware::class.':ADMIN,SALES']);

Route::get('/dashboard/products', [ProductController::class, 'showProducts'])
    ->name('products.index')
    ->middleware(['auth', RoleMiddleware::class.':ADMIN,STOCK,SALES']);

Route::post('/dashboard/products/new', [ProductController::class, 'createProduct'])
    ->name('products.store')
    ->middleware(['auth', RoleMiddleware::class.':ADMIN,STOCK']);

Route::get('/dashboard/products/new', [ProductController::class, 'showCreateForm'])
    ->name('products.new')
    ->middleware(['auth', RoleMiddleware::class.':ADMIN,STOCK']);


Route::get('/dashboard/products/{id}', [ProductController::class, 'showProduct'])
    ->name('products.show')
    ->middleware(['auth', RoleMiddleware::class.':ADMIN,STOCK,SALES']);

Route::get('/dashboard/products/{id}/edit', [ProductController::class, 'showEditForm'])
    ->name('products.edit')
    ->middleware(['auth', RoleMiddleware::class.':ADMIN,STOCK']);

Route::post('/dashboard/products/{id}/edit', [ProductController::class, 'updateProduct'])
    ->name('products.update')
    ->middleware(['auth', RoleMiddleware::class.':ADMIN,STOCK']);

Route::delete('/dashboard/products', [ProductController::class, 'deleteProduct'])
    ->name('products.delete')
    ->middleware(['auth', RoleMiddleware::class.':ADMIN,STOCK']);

Route::get('/dashboard/orders/table/{filter}', [OrderController::class, 'index'])
    ->name('orders.index')
    ->middleware(['auth', RoleMiddleware::class.':ADMIN,SALES']);

Route::get('/dashboard/orders/new', [OrderController::class, 'showCreateForm'])
    ->name('orders.new')
    ->middleware(['auth', RoleMiddleware::class.':ADMIN,SALES']);

Route::post('/dashboard/orders/new', [OrderController::class, 'createFirstStep'])
    ->name('orders.create.first')
    ->middleware(['auth', RoleMiddleware::class.':ADMIN,SALES']);

Route::get('/dashboard/orders/{order}', [OrderController::class, 'showSecondStep'])
    ->name('orders.create.second')
    ->middleware(['auth', RoleMiddleware::class.':ADMIN,SALES']);

Route::post('/dashboard/orders/{order}', [OrderController::class, 'mutateSecondStep'])
    ->name('orders.create.secondPost')
    ->middleware(['auth', RoleMiddleware::class.':ADMIN,SALES']);

Route::get('/dashboard/orders/{order}/lastStep', [OrderController::class, 'showFinalStep'])
    ->name('orders.create.last')
    ->middleware(['auth', RoleMiddleware::class.':ADMIN,SALES']);

Route::post('/dashboard/orders/{order}/lastStep', [OrderController::class, 'saveOrder'])
    ->name('orders.create.Post')
    ->middleware(['auth', RoleMiddleware::class.':ADMIN,SALES']);

Route::get('/track/{order}', [OrderController::class, 'trackOrder'])
    ->name('orders.track');

Route::get('/dashboard/orders/{id}/detail', [OrderController::class, 'showOrder'])
    ->name('orders.show')
    ->middleware(['auth', RoleMiddleware::class.':ADMIN,SALES']);

Route::get('/dashboard/orders/{order}/uprade', [OrderController::class, 'upgradeOrderStatus'])
    ->name('orders.upgrade')
    ->middleware(['auth', RoleMiddleware::class.':ADMIN,SALES']);
