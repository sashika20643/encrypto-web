<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;

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


    return view('welcome');
});
Route::prefix('admin/dash')->middleware('auth','isAdmin')->group(function(){
    Route::get('/', function () {
        return view('Admin.dash');
    })->name('dash');
    Route::get('/users',[Admin::class, 'Users'])->name('users');

    Route::get('/encrypt', function () {
        return view('Admin.encrypt');
    })->name('encrypt');


    Route::get('/users/add', function () {
        return view('Admin.addUser');
    })->name('addUsers');

    Route::post('controller/user/add',[Admin::class, 'addUser'])->name('adduserController');
// Route::post('dash/controller/file/upload',[Admin::class, 'Uploadfile'])->name('fileuploadController');

    // Route::get('/controller/file/view/{id}',[Admin::class, 'fileView'])->name('fileview');


});


Route::middleware(['auth'])->group(function () {
    Route::get('dash/files', function () {
        $user_id=Auth::user()->id;
        $files=App\Models\file::where('user_name',$user_id)->get();

        return view('Admin.files')->with('files',$files);
    })->name('files');
    Route::post('dash/controller/file/upload',[Admin::class, 'Uploadfile'])->name('fileuploadController');
    Route::post('dash/controller/access/add',[Admin::class, 'addAccess'])->name('addAccess');
    Route::get('dash/controller/file/view/{id}',[Admin::class, 'fileView'])->name('fileview');
    Route::get('/dash/controller/access/remove/{id}',[Admin::class, 'removeAccess'])->name('removeAccess');
    Route::get('dash/controller/file/download/{id}',[Admin::class, 'fileDownload'])->name('fileDownload');


});

Route::prefix('user')->middleware('auth')->group(function(){
    Route::get('/dash', function () {
        return view('Admin.dash');
    });


});


Route::get('/signup', function () {
    return view('auth.signup');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
