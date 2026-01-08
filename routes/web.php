<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/teacher/apply', function () {
    return view('teacher.apply');
});

Route::get('/student/apply', function () {
    return view('student.apply');
});

Route::get('/student-preview/{pincode}', function ($pincode) {
    return view('student.apply', ['pincode' => $pincode]);
});

Route::get('/admin', function () {
    return view('admin.dashboard');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/admin/notices', function () {
        return view('admin.notices');
    });
    Route::get('/admin/students', function () {
        return view('admin.students');
    });
    Route::get('/admin/gallery', function () {
        return view('admin.gallery');
    });
});

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect('/admin/dashboard');
    }
    return back()->withErrors([
        'email' => 'Invalid credentials',
    ]);
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
});
