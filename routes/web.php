<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;

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

// Route::get('/', function () {
//     // $a = DB::connection('sqlsrv1')->table('_Char')->where('CharID', 18);
//     // dd($a->get());
//     return view('welcome');
// });

Route::get('/' ,[Controller::class, 'index'])->name('home');
Route::get('getLang/{lang}', [Controller::class, 'getLang'])->name('getLang');
Route::get('register', [Controller::class, 'register'])->name('register');
Route::post('postRegister', [Controller::class, 'postRegister'])->name('post-register');
Route::get('account', [Controller::class, 'account'])->name('login');
Route::post('login', [Controller::class, 'login'])->name('post-login');
Route::get('logout', [Controller::class, 'logout'])->name('logout');

Route::get('password', [Controller::class, 'changePass'])->name('change-pass');
Route::post('post-password', [Controller::class, 'postPass'])->name('post-pass');

Route::get('email', [Controller::class, 'changeEmail'])->name('change-email');
Route::post('post-email', [Controller::class, 'postEmail'])->name('post-email');

Route::get('phone', [Controller::class, 'changePhone'])->name('change-phone');
Route::post('post-phone', [Controller::class, 'postPhone'])->name('post-phone');

Route::get('stuck-char', [Controller::class, 'stuckChar'])->name('stuck-char');
Route::post('post-stuck', [Controller::class, 'postStuck'])->name('post-stuck');

Route::get('ranking', [Controller::class, 'ranking'])->name('rank');
Route::get('card', [Controller::class, 'card'])->name('card');
Route::post('post-card', [Controller::class, 'postCard'])->name('post-card');

Route::get('member-sup/{id}', [Controller::class, 'supMember'])->name('sup-member');
Route::get('download', [Controller::class, 'download'])->name('download');

Route::get('forget', [Controller::class, 'fogetPass'])->name('forget');
Route::post('saveforget', [Controller::class, 'postForgetEmail'])->name('post-forget-email');
Route::get('pwd-reset/{name}/{token}', [Controller::class, 'pwdReset'])->name('pwdReset');
Route::post('pwd-reset/save', [Controller::class, 'forGotpass'])->name('reset-save-pass');

//admin

Route::group(['middleware' =>[ 'auth', 'role']], function (){
    Route::get('admin_cp', [AdminController::class, 'index'])->name('admin-cp');

    Route::get('admin_cp/download', [AdminController::class, 'download'])->name('download-cp');
    Route::get('admin_cp/download/add', [AdminController::class, 'downloadAdd'])->name('add-download');
    Route::post('admin_cp/download/save', [AdminController::class, 'downloadAddSave'])->name('save-download');
    Route::get('admin_cp/download/edit/{id}', [AdminController::class, 'downloadEdit'])->name('edit-download');
    Route::post('admin_cp/download/edit/save', [AdminController::class, 'downloadEditSave'])->name('editsave-download');
    Route::get('admin_cp/download/delete/{id}', [AdminController::class, 'downloadDelete'])->name('delete-download');

    Route::get('admin_cp/card', [AdminController::class, 'card'])->name('card-cp');
    Route::get('admin_cp/card/add', [AdminController::class, 'cardAdd'])->name('add-card');
    Route::post('admin_cp/card/save', [AdminController::class, 'cardAddSave'])->name('save-card');
    Route::get('admin_cp/card/edit/{id}', [AdminController::class, 'cardEdit'])->name('edit-card');
    Route::post('admin_cp/card/edit/save', [AdminController::class, 'cardEditSave'])->name('editsave-card');
    Route::get('admin_cp/card/delete/{id}', [AdminController::class, 'cardDelete'])->name('delete-card');

    Route::get('admin_cp/card-log', [AdminController::class, 'cardLog'])->name('card-log-cp');
    Route::get('admin_cp/card-log/{id}', [AdminController::class, 'deleteCardLog'])->name('deletecard-log-cp');

    Route::get('admin_cp/pay', [AdminController::class, 'pay'])->name('pay-cp');
    Route::get('admin_cp/pay/add', [AdminController::class, 'payAdd'])->name('add-pay');
    Route::post('admin_cp/pay/save', [AdminController::class, 'payAddSave'])->name('save-pay');
    Route::get('admin_cp/pay/edit/{id}', [AdminController::class, 'payEdit'])->name('edit-pay');
    Route::post('admin_cp/pay/edit/save', [AdminController::class, 'payEditSave'])->name('editsave-pay');
    Route::get('admin_cp/pay/delete/{id}', [AdminController::class, 'payDelete'])->name('delete-pay');

    Route::get('admin_cp/support', [AdminController::class, 'support'])->name('support-cp');
    Route::get('admin_cp/support/add', [AdminController::class, 'supportAdd'])->name('add-support');
    Route::post('admin_cp/support/save', [AdminController::class, 'supportAddSave'])->name('save-support');
    Route::get('admin_cp/support/edit/{id}', [AdminController::class, 'supportEdit'])->name('edit-support');
    Route::post('admin_cp/support/edit/save', [AdminController::class, 'supportEditSave'])->name('editsave-support');
    Route::get('admin_cp/support/delete/{id}', [AdminController::class, 'supportDelete'])->name('delete-support');

    Route::get('admin_cp/config', [AdminController::class, 'config'])->name('config-cp');
    Route::get('admin_cp/config/add', [AdminController::class, 'configAdd'])->name('add-config');
    Route::post('admin_cp/config/save', [AdminController::class, 'configAddSave'])->name('save-config');
    Route::get('admin_cp/config/edit/{id}', [AdminController::class, 'configEdit'])->name('edit-config');
    Route::post('admin_cp/config/edit/save', [AdminController::class, 'configEditSave'])->name('editsave-config');
    Route::get('admin_cp/config/delete/{id}', [AdminController::class, 'configDelete'])->name('delete-config');

    Route::get('admin_cp/baner', [AdminController::class, 'baner'])->name('baner-cp');
    Route::get('admin_cp/baner/add', [AdminController::class, 'banerAdd'])->name('add-baner');
    Route::post('admin_cp/baner/save', [AdminController::class, 'banerAddSave'])->name('save-baner');
    Route::get('admin_cp/baner/edit/{id}', [AdminController::class, 'banerEdit'])->name('edit-baner');
    Route::post('admin_cp/baner/edit/save', [AdminController::class, 'banerEditSave'])->name('editsave-baner');
    Route::get('admin_cp/baner/delete/{id}', [AdminController::class, 'banerDelete'])->name('delete-baner');

    Route::get('image-create', [AdminController::class, 'createImg'])->name('create-img');
    Route::get('image-create/add', [AdminController::class, 'addImg'])->name('create-add');
    Route::post('image-create/save', [AdminController::class, 'saveImg'])->name('create-save');
    Route::get('image-create/edit/{id}', [AdminController::class, 'editImg'])->name('create-edit');
    Route::post('image-create/edit/save', [AdminController::class, 'saveUpdateImg'])->name('create-save-edit');
    Route::get('image-create/delete/{id}', [AdminController::class, 'deleteImg'])->name('create-delete');

});
