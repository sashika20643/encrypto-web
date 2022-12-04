<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\TwoFactorController;


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
Route::get('verify/resend', 'App\Http\Controllers\Auth\TwoFactorController@resend')->name('verify.resend');
Route::resource('verify', 'App\Http\Controllers\Auth\TwoFactorController')->only(['index', 'store']);
// Route::get('verify/index',[TwoFactorController::class, 'index'])->name('verify.index');




Route::get('/', function () {


    return redirect('/login');
});


Route::prefix('admin/dash')->middleware('auth','isAdmin','twofactor')->group(function(){
   

    Route::get('/',[Admin::class, 'dash'])->name('dash');
    Route::get('/users',[Admin::class, 'Users'])->name('users');


    Route::get('/encrypt', function () {
        return view('Admin.encrypt');
    })->name('encrypt');


    Route::get('/users/add', function () {
        return view('Admin.addUser');
    })->name('addUsers');

Route::get('controller/user/delete/{id}',[Admin::class, 'deleteUser'])->name('deleteUserController');
    Route::post('controller/user/add',[Admin::class, 'addUser'])->name('adduserController');
// Route::post('dash/controller/file/upload',[Admin::class, 'Uploadfile'])->name('fileuploadController');

    // Route::get('/controller/file/view/{id}',[Admin::class, 'fileView'])->name('fileview');


});


Route::middleware(['auth','twofactor'])->group(function () {
    Route::get('dash/files', function () {
        $user_id=Auth::user()->id;
        $files=App\Models\file::where('user_name',$user_id)->get();

        return view('Admin.Files')->with('files',$files);
    })->name('files');
    Route::post('dash/controller/file/upload',[CommonController::class, 'Uploadfile'])->name('fileuploadController');
    Route::post('dash/controller/access/add',[CommonController::class, 'addAccess'])->name('addAccess');
    Route::get('dash/controller/file/view/{id}',[CommonController::class, 'fileView'])->name('fileview');
    Route::get('dash/controller/file/delete/{id}',[CommonController::class, 'fileDelete'])->name('fileDelete');
    Route::get('/dash/controller/access/remove/{id}',[CommonController::class, 'removeAccess'])->name('removeAccess');
    Route::post('dash/controller/file/download',[CommonController::class, 'fileDownload'])->name('fileDownload');
    Route::get('dash/recivedfiles',[CommonController::class,'AccessGivenFiles'] )->name('recivedfiles');
    Route::post('dash/controller/file/upload',[CommonController::class, 'Uploadfile'])->name('fileuploadController');

    Route::get('/dash/profile', function () {
        return view('Admin.profile');
    })->name('profile');
    Route::post('/dash/controller/changepw',[CommonController::class, 'changepassword'])->name('changepwcontroller');



});

Route::prefix('user')->middleware('auth')->group(function(){
    Route::get('/dash',[Admin::class, 'dash'])->name('dash');
    Route::get('/',[Admin::class, 'dash'])->name('dash');



});


// Route::get('/signup', function () {
//     return view('auth.signup');
// });


Auth::routes(['verify'=>true]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
