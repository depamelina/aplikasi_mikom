<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MentorController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/profile', [AuthController::class, 'profile']);
Route::get('/teach/profile',[AuthController::class,'teachProfile']);

Route::get('/admin/divisi',[AdminController::class,'divisi'])->name('admin-divisi');
Route::post('/admin/divisi', [AdminController::class, 'addDivisi']);
Route::get('/admin/divisi/{id}', [AdminController::class, 'divisiById']);
Route::post('/admin/divisi/{id}', [AdminController::class, 'updateDivisi']);
Route::delete('/admin/divisi/{id}', [AdminController::class, 'deleteDivisi']);

Route::get('/admin/jamkerja',[AdminController::class,'jamkerja']);
Route::post('/admin/jamkerja', [AdminController::class, 'addJam']);
Route::get('/admin/jamkerja/{id}', [AdminController::class, 'jamById']);
Route::post('/admin/jamkerja/{id}', [AdminController::class, 'updateJam']);
Route::delete('/admin/jamkerja/{id}', [AdminController::class, 'deleteJam']);

Route::get('/admin/level',[AdminController::class,'level']);
Route::post('/admin/level', [AdminController::class, 'addLevel']);
Route::get('/admin/level/{id}', [AdminController::class, 'levelById']);
Route::post('/admin/level/{id}', [AdminController::class, 'updateLevel']);
Route::delete('/admin/level/{id}', [AdminController::class, 'deleteLevel']);

Route::get('/admin/users',[AdminController::class,'users']);
Route::get('/admin/data-user/{username}', [AdminController::class, 'dataUser']);
Route::get('/admin/users/{id}', [AdminController::class, 'usersById']);
Route::post('/admin/users', [AdminController::class, 'addUsers']);
Route::post('/admin/users/{username}', [AdminController::class, 'updateUsers']);
Route::delete('/admin/users/{username}', [AdminController::class, 'deleteUsers']);
Route::get('/admin/profile/{username}', [AdminController::class, 'profileUser']);
Route::get('/admin/proyek/{username}', [AdminController::class, 'proyekUser']);

Route::get('/admin/teach',[AdminController::class,'teach']);
Route::get('/admin/teach-dash',[AdminController::class,'teachDash']);
Route::get('/admin/teach-dashboard',[AdminController::class,'teachDashboard']);
Route::post('/admin/teach', [AdminController::class, 'addTeach']);
Route::get('/admin/teach/{id}', [AdminController::class, 'teachById']);
Route::post('/admin/teach/{id}', [AdminController::class, 'updateTeach']);
Route::delete('/admin/teach/{id}', [AdminController::class, 'deleteTeach']);

Route::get('/teach/users',[MentorController::class,'users']);
Route::post('/teach/tugas',[MentorController::class,'addTugas']);
Route::get('/teach/tugas',[MentorController::class,'tugas']);
Route::get('/teach/tugas/{id}',[MentorController::class,'tugasById']);
Route::post('/teach/tugas/{id}',[MentorController::class,'updateTugas']);
Route::delete('/teach/tugas/{id}',[MentorController::class,'deleteTugas']);
Route::get('/teach/absen',[MentorController::class,'absen']);
Route::get('/teach/absen/{id}',[MentorController::class,'absenById']);
Route::post('/teach/absen/{id}',[MentorController::class,'validAbsen']);

Route::post('/save-presensi', [PresensiController::class, 'savePresensi']);
Route::get('/history-presensi-search', [PresensiController::class, 'historyPresensiSearch']);
Route::get('/kegharian-search', [PresensiController::class, 'kegHarianSearch']);
Route::post('/presensi-out', [PresensiController::class, 'presensiOut']);
Route::post('/pengajuan-absen', [PresensiController::class, 'addAbsen']);


Route::get('/user/dashboard', [UserController::class, 'index']);
Route::get('/user/history', [UserController::class, 'history']);
Route::get('/user/kegharian', [UserController::class, 'kegharian']);
Route::get('/user-dash', [UserController::class, 'userDash']);
Route::get('/user/teach-bio',[UserController::class,'teachBio']);
Route::get('/user/nilai',[UserController::class,'nilai']);
Route::get('/user/tugas',[UserController::class,'tugas']);
Route::get('/user/absen',[UserController::class,'absen']);
Route::get('/user/absen/{id}',[UserController::class,'absenById']);
Route::get('/tugas/user',[UserController::class,'tugasTampil']);
Route::post('/user/tugas/{id}',[UserController::class,'addTugas']);
Route::get('/user/tugas/{id}',[UserController::class,'tugasById']);
Route::post('/user/proyek',[UserController::class,'addPro']);
Route::get('/user/proyek',[UserController::class,'proyek']);


Route::post('/user/kriteria',[UserController::class,'addKriteria']);
Route::get('/user/kriteria/{id}', [UserController::class, 'kriteriaById']);
Route::post('/user/kriteria/{id}', [UserController::class, 'updateKriteria']);
Route::delete('/user/kriteria/{id}', [UserController::class, 'deleteKriteria']);
Route::post('/user/form-nilai', [UserController::class, 'formNilai']);

Route::get('/nilai-search', [AdminController::class, 'nilaiSearch']);
Route::post('/report-all', [AdminController::class, 'reportAll']);
Route::get('/admin/rules', [AdminController::class, 'rules']);
Route::post('/user/nilai/{id}',[AdminController::class,'addNilai']);



