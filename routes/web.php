<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
 use App\Http\Controllers\LendingController;


/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| LOGIN PROCESS
|--------------------------------------------------------------------------
*/
Route::post('/login', function (Request $request) {

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {

        $request->session()->regenerate();

        $role = Auth::user()->role;

        if ($role === 'admin') {
            return redirect('/admin/dashboard');
        }

        if ($role === 'operator') {
            return redirect('/operator/dashboard');
        }

        Auth::logout();

        return redirect('/')->withErrors([
            'email' => 'Role tidak valid',
        ]);
    }

    return back()->withErrors([
        'email' => 'Email atau password salah',
    ]);
});

/*
|--------------------------------------------------------------------------
| OPERATOR DASHBOARD
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| ADMIN PREFIX ROUTE (INI YANG BENAR)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware('role:admin')->group(function () {
    Route::get('/dashboard', function () {return view('admin.dashboard');})->name('admin.dashboard');

    //categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('admin.categories.show');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

    //item
    Route::get('/items', [ItemController::class, 'index'])->name('admin.items.index');
    Route::get('/items/create', [ItemController::class, 'create'])->name('admin.items.create');
    Route::post('/items', [ItemController::class, 'store'])->name('admin.items.store');
    Route::get('/items/{id}', [ItemController::class, 'show'])->name('admin.items.show');
    Route::get('/items/{id}/edit', [ItemController::class, 'edit'])->name('admin.items.edit');
    Route::put('/items/{id}', [ItemController::class, 'update'])->name('admin.items.update');
    Route::delete('/items/{id}', [ItemController::class, 'destroy'])->name('admin.items.destroy');
});

Route::prefix('operator')->middleware('role:operator')->group(function () {
    Route::get('/dashboard', function () {return view('operator.dashboard');})->name('operator.dashboard');
    
    Route::get('/lendings', [LendingController::class, 'index'])->name('lendings.index');
    Route::get('/lendings/create', [LendingController::class, 'create'])->name('lendings.create');
    Route::post('/lendings', [LendingController::class, 'store'])->name('lendings.store');

    Route::get('/lendings/{id}/edit', [LendingController::class, 'edit'])->name('lendings.edit');
    Route::put('/lendings/{id}', [LendingController::class, 'update'])->name('lendings.update');

    Route::delete('/lendings/{id}', [LendingController::class, 'destroy'])->name('lendings.destroy');

    Route::post('/lendings/{id}/return', [LendingController::class, 'return'])
        ->name('lendings.return');
});

Route::prefix('users')->group(function () {

    // USER MANAGEMENT (admin & operator bisa akses)
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::post('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->name('logout');