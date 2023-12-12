<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\PengurusesController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\ProgramStudiController;
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

//Routes Admin
Route::get('admins',[AdminController::class,'index'])->name('admins.index')->middleware('auth.admin');
Route::get('admins/create',[AdminController::class,'create'])->name('admins.create')->middleware('auth.admin');
Route::post('admins',[AdminController::class,'store'])->name('admins.store')->middleware('auth.admin');
Route::get('admins/{id}/edit',[AdminController::class,'edit'])->name('admins.edit')->middleware('auth.admin');
Route::put('admins/{id}',[AdminController::class,'update'])->name('admins.update')->middleware('auth.admin');
Route::delete('admins/{id}',[AdminController::class,'destroy'])->name('admins.destroy')->middleware('auth.admin');

//Routes Pengurus
Route::get('pengurus',[PengurusController::class,'index'])->name('pengurus.index');
Route::get('pengurus/create',[PengurusController::class,'create'])->name('pengurus.create')->middleware('auth.admin');
Route::post('pengurus',[PengurusController::class,'store'])->name('pengurus.store')->middleware('auth.admin');
Route::get('pengurus/{nim}/edit',[PengurusController::class,'edit'])->name('pengurus.edit')->middleware('auth.admin');
Route::put('pengurus/{nim}',[PengurusController::class,'update'])->name('pengurus.update')->middleware('auth.admin');
Route::delete('pengurus/{nim}',[PengurusController::class,'destroy'])->name('pengurus.destroy')->middleware('auth.admin');

//Routes Jabatan
Route::get('jabatans',[JabatanController::class,'index'])->name('jabatans.index')->middleware('auth.admin');
Route::get('jabatans/create',[JabatanController::class,'create'])->name('jabatans.create')->middleware('auth.admin');
Route::post('jabatans',[JabatanController::class,'store'])->name('jabatans.store')->middleware('auth.admin');
Route::get('jabatans/{id}/edit',[JabatanController::class,'edit'])->name('jabatans.edit')->middleware('auth.admin');
Route::put('jabatans/{id}',[JabatanController::class,'update'])->name('jabatans.update')->middleware('auth.admin');
Route::delete('jabatans/{id}',[JabatanController::class,'destroy'])->name('jabatans.destroy')->middleware('auth.admin');

//Routes Divisi
Route::get('divisis',[DivisiController::class,'index'])->name('divisis.index')->middleware('auth.admin');
Route::get('divisis/create',[DivisiController::class,'create'])->name('divisis.create')->middleware('auth.admin');
Route::post('divisis',[DivisiController::class,'store'])->name('divisis.store')->middleware('auth.admin');
Route::get('divisis/{id}/edit',[DivisiController::class,'edit'])->name('divisis.edit')->middleware('auth.admin');
Route::put('divisis/{id}',[DivisiController::class,'update'])->name('divisis.update')->middleware('auth.admin');
Route::delete('divisis/{id}',[DivisiController::class,'destroy'])->name('divisis.destroy')->middleware('auth.admin');

//Routes Organisasi
Route::get('organisasis',[OrganisasiController::class,'index'])->name('organisasis.index')->middleware('auth.admin');
Route::get('organisasis/create',[OrganisasiController::class,'create'])->name('organisasis.create')->middleware('auth.admin');
Route::post('organisasis',[OrganisasiController::class,'store'])->name('organisasis.store')->middleware('auth.admin');
Route::get('organisasis/{id}/edit',[OrganisasiController::class,'edit'])->name('organisasis.edit')->middleware('auth.admin');
Route::put('organisasis/{id}',[OrganisasiController::class,'update'])->name('organisasis.update')->middleware('auth.admin');
Route::delete('organisasis/{id}',[OrganisasiController::class,'destroy'])->name('organisasis.destroy')->middleware('auth.admin');

//Routes Program Studi
Route::get('programStudis',[ProgramStudiController::class,'index'])->name('programStudis.index')->middleware('auth.admin');
Route::get('programStudis/create',[ProgramStudiController::class,'create'])->name('programStudis.create')->middleware('auth.admin');
Route::post('programStudis',[ProgramStudiController::class,'store'])->name('programStudis.store')->middleware('auth.admin');
Route::get('programStudis/{id}/edit',[ProgramStudiController::class,'edit'])->name('programStudis.edit')->middleware('auth.admin');
Route::put('programStudis/{id}',[ProgramStudiController::class,'update'])->name('programStudis.update')->middleware('auth.admin');
Route::delete('programStudis/{id}',[ProgramStudiController::class,'destroy'])->name('programStudis.destroy')->middleware('auth.admin');


//Routes Dashboard
Route::get('dashboard',function(){
    $title = "Dashboard";
    return view ('Dashboard.dashboard',compact('title'));
})->name('Dashboard.dashboard')->middleware('auth.admin');

//Routes Dashboard Pengurus
Route::get('dashboard/pengurus',function(){
    $title = "Dashboard Pengurus";
    return view ('Dashboard.dashboard_pengurus',compact('title'));
})->name('Dashboard.dashboard_pengurus');

Route::get('/', function () {
    return view('auth.login_pengurus');
});

//Routes Login & Logout
Route::get('logins',[AuthController::class,'index'])->name('logins.index')->middleware('logout.admin');
Route::post('logins/Auth',[AuthController::class,'LoginAuth'])->name('logins.auth')->middleware('logout.admin');
Route::get('logout',[AuthController::class,'logout'])->name('logins.logout');
Route::get('login',[AuthController::class,'LoginPengurus'])->name('auth.login_pengurus');
Route::post('Login/Action',[AuthController::class,'LoginPengurusaction'])->name('auth.login_pengurus_action');
Route::get('Register',[AuthController::class,'Pengurus'])->name('auth.register');
Route::post('Create/Pengurus',[AuthController::class,'CreatePengurus'])->name('auth.create_pengurus');
Route::get('logout/pengurus',[AuthController::class,'logoutPengurus'])->name('logins.logoutPengurus');

//Routes Pengurus dan Penilaian
Route::get('Pengurus/Kuisioner/{Nim}',[PengurusesController::class,'kuis'])->name('penguruses.kuisioner');
Route::post('Penilaian/{Nim}',[PengurusesController::class,'store'])->name('penguruses.store');
Route::get('Pengurus/Penilaian',[PengurusesController::class,'penilaian'])->name('penguruses.index');


//Routes Laporan Penilaian
Route::get('Laporan',[LaporanController::class,'index'])->name('laporans.index');
Route::get('Laporan/Pengurus/{Nim}',[LaporanController::class,'detail'])->name('laporans.detail');
Route::get('Laporan/Organisasi',[LaporanController::class,'indexOrg'])->name('laporans.indexOrg');
Route::get('Laporan/Organisasi/{id}',[LaporanController::class,'detailOrg'])->name('laporans.detailOrg');