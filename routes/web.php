<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/users', [App\Http\Controllers\HomeController::class, 'users'])->name('users');
Route::get('success', function(){
    return response()->json(['message' => 'success']);
})->name('success');

Route::get('/insert-users', function () {

    $users = [];

    for ($i = 1; $i <= 100; $i++) {
        $users[] = [
            'name' => "User {$i}",
            'email' => "user{$i}@example.com",
            'password' => Illuminate\Support\Facades\Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    App\Models\User::insert($users);

    return '100 users inserted successfully';
});
