<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
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
    return view('login');
});

Route::get('/admin', function () {
    $jml = DB::table('teach')
        ->count();
    $akt = DB::table('users')
        ->where('id_level','=', 'user')
        ->where('status','=', '1')
        ->count();
    $nonakt = DB::table('users')
        ->where('id_level','=', 'user')
        ->where('status','=', '0')
        ->count();
    $h = DB::table('presensi')
        ->where('tanggal', date('Y-m-d'))
        ->where('status', '=', 'H')
        ->count();
    $th = DB::table('presensi')
        ->where('tanggal', date('Y-m-d'))
        ->where('status', '=', 'I')
        ->count();
    $bp = DB::table('presensi')
        ->select('presensi.username')
        ->where('tanggal', date('Y-m-d'))
        ->where('presensi.username','=', 'Null')
        ->join('users','users.username','presensi.username')
        ->count();
    return view('admin/index',compact('jml','akt','nonakt','h','bp','th'));
});

Route::get('/divisi', function () {
    return view('admin/divisi');
});

Route::get('/jamkerja', function () {
    return view('admin/jamkerja');
});

Route::get('/level', function () {
    return view('admin/level');
});

Route::get('/users', function () {
    return view('admin/user');
});

Route::get('/add-user', function () {
    return view('admin/tambah-user');
});

Route::get('/report', function () {
    return view('admin/report');
});


Route::get('/teach', function () {
    return view('admin/teach');
});

Route::get('/update-users/{username}', function ($username) {
    $data['username']=$username;
    return view('admin/update-users', $data);
});

Route::get('/user', function () {
    $tgs = DB::table('tugas')
        ->where('user_peserta','=', session('username'))
        ->where('status','=', '1')
        ->count();
    $done = DB::table('tugas')
        ->where('user_peserta','=', session('username'))
        ->where('status','=', '2')
        ->count();
    return view('user/index',compact('tgs','done'));
});

Route::get('/user-profile', function () {
    return view('user/profile');
});

Route::get('/profile/{username}', function ($username) {
    $data['username']=$username;
    return view('admin/user-profile', $data);
});

Route::get('/user-history', function () {
    return view('user/history');
});

Route::get('/user-keg', function () {
    return view('user/keg_harian');
});

Route::get('/user-tugas', function () {
    return view('user/tugas');
});

Route::get('/user-nilai', function () {
    return view('user/nilai');
});

Route::get('/user-absen', function () {
    return view('user/pengajuan');
});

Route::get('/mentor', function () {
    $a = DB::table('users')
        ->select('status')
        ->where('status','=', '1')
        ->where('id_mentor','=', session('username'))
        ->count();
    $n = DB::table('users')
        ->select('status')
        ->where('status','!=', '1')
        ->where('id_mentor','=', session('username'))
        ->count();
    $p = DB::table('absen')
        ->select('status')
        ->where('status','=', '1')
        ->where('user_mentor','=', session('username'))
        ->count();
    $h = DB::table('presensi')
        ->where('tanggal', date('Y-m-d'))
        ->where('users.id_mentor','=', session('username'))
        ->where('presensi.status', '=', 'H')
        ->join('users','users.username','presensi.username')
        ->count();
    $th = DB::table('presensi')
        ->where('tanggal', date('Y-m-d'))
        ->where('users.id_mentor','=', session('username'))
        ->where('presensi.status', '!=', 'H')
        ->join('users','users.username','presensi.username')
        ->count();
    return view('mentor/index',compact('a','n','p','h','th'));
});

Route::get('/mentor-profile', function () {
    return view('mentor/profile');
});

Route::get('/mentor-tugas', function () {
    return view('mentor/tugas');
});

Route::get('/mentor-user', function () {
    return view('mentor/user');
});

Route::get('/input-tugas', function () {
    return view('mentor/input-tugas');
});

Route::get('/edit-tugas/{id}', function ($id) {
    $data['id']=$id;
    return view('mentor/edit-tugas',$data);
});

Route::get('/mentor-absen', function () {
    return view('mentor/pengajuan');
});

Route::get('/isi-tugas/{id}', function ($id) {
    $data['id']=$id;
    return view('user/input-tugas',$data);
});

Route::get('/detail-tugas/{id}', function ($id) {
    $data['id']=$id;
    return view('user/detail-tugas',$data);
});

Route::get('/exportexcel/{dari}/{sampai}',[AdminController::class, 'exportexcel'])->name('exportexcel');


// Route::get('/admin/user',[AdminController::class,'user'])->name('admin-user');
// Route::get('/admin/jamker',[AdminController::class,'jamker'])->name('admin-jamker');
// Route::get('/admin/level',[AdminController::class,'level'])->name('admin-level');
// Route::get('/admin/history',[AdminController::class,'history'])->name('admin-history');
// Route::get('/admin/kegharian',[AdminController::class,'kegHarian'])->name('admin-keg');
// Route::get('/admin/nilai',[AdminController::class,'nilai'])->name('admin-nilai');

// Route::get('/mentor/user',[MentorController::class,'user'])->name('mentor-user');
// Route::get('/mentor/history',[MentorController::class,'history'])->name('mentor-history');
// Route::get('/mentor/keg',[MentorController::class,'kegHarian'])->name('mentor-keg');
// Route::get('/mentor/nilai',[MentorController::class,'nilai'])->name('mentor-nilai');


// Route::get('/user/user',[UserController::class,'user'])->name('user-user');
// Route::get('/user/history',[UserController::class,'history'])->name('user-history');
// Route::get('/user/keg',[UserController::class,'kegHarian'])->name('user-keg');
// Route::get('/user/nilai',[UserController::class,'nilai'])->name('user-nilai');

Route::get('/export-teach',[AdminController::class, 'exportTeach']);
Route::get('/export-users',[AdminController::class, 'exportUsers']);