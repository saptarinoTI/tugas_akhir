<?php

use App\Http\Controllers\Admin\DataDosenController;
use App\Http\Controllers\Admin\DataMahasiswaController;
use App\Http\Controllers\Admin\DataPendadaranController;
use App\Http\Controllers\Admin\DataProposalTAController;
use App\Http\Controllers\Admin\DataSeminarHasilController;
use App\Http\Controllers\Admin\MahasiswaAPIController;
use App\Http\Controllers\Admin\UserLoginController;
use App\Http\Controllers\Dosen\MahasiswaBimbinganController;
use App\Http\Controllers\Dosen\PendadaranController as DosenPendadaranController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Mahasiswa\DataController;
use App\Http\Controllers\Mahasiswa\ProposalTAController;
use App\Http\Controllers\Dosen\ProposalTAMahasiswaController;
use App\Http\Controllers\Dosen\SeminarHasilController as DosenSeminarHasilController;
use App\Http\Controllers\Mahasiswa\PendadaranController;
use App\Http\Controllers\Mahasiswa\SeminarHasilController;
use App\Http\Controllers\SkripsiController;
use App\Http\Controllers\StatusMahasiswaController;
use Illuminate\Support\Facades\Auth;
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
    return redirect()->route('login');
});;

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
});;

/* Guest */
/* Daftar Judul Tugas Akhir */
Route::get('/skripsi', [SkripsiController::class, 'index'])->name('skripsi.index');
Route::get('/skripsi/getdata', [SkripsiController::class, 'getData'])->name('skripsi.getData');
/* End Guest */

/* Dashboard */
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(['auth', 'verified']);
Route::get('/register-email', [HomeController::class, 'registerEmailGet'])->name('register.getEmail')->middleware(['auth']);
Route::post('/register-email', [HomeController::class, 'registerEmailPost'])->name('register.postEmail')->middleware(['auth']);

/* Middleware */
Route::middleware(['auth', 'verified'])->group(function () {
    /* Status Mhs. */
    Route::get('mahasiswa-lulus', [StatusMahasiswaController::class, 'index'])->name('mahasiswa-lulus.index');
    Route::get('mahasiswa-lulus/getdata', [StatusMahasiswaController::class, 'getData'])->name('mahasiswa-lulus.getData');
    Route::get('mahasiswa-lulus/{id}', [StatusMahasiswaController::class, 'show'])->name('mahasiswa-lulus.show');
    /*  Password */
    Route::get('/password/change', [HomeController::class, 'changePasswordGet'])->name('password-change.get');
    Route::patch('/password/change', [HomeController::class, 'changePasswordPost'])->name('password-change.post');
});
/* End Middleware */

/* Admin */
Route::middleware(['auth', 'verified', 'role:admin|superadmin'])->group(function () {
    /* Users */
    /* UserLogin */
    Route::get('user-login', [UserLoginController::class, 'index'])->name('user-login.index');
    Route::post('user-login', [UserLoginController::class, 'store'])->name('user-login.store');
    Route::delete('user-login/{id}', [UserLoginController::class, 'destroy'])->name('user-login.destroy');
    Route::get('user-login/get', [UserLoginController::class, 'getData'])->name('user-login.get');
    Route::post('user-login/import', [UserLoginController::class, 'importData'])->name('user-login.import');
    /* MahasiswaAPI */
    Route::get('mahasiswa-api', [MahasiswaAPIController::class, 'index'])->name('mahasiswa-api.index');
    Route::post('mahasiswa-api', [MahasiswaAPIController::class, 'store'])->name('mahasiswa-api.store');
    Route::get('mahasiswa-api/get', [MahasiswaAPIController::class, 'getData'])->name('mahasiswa-api.get');
    /* End Users */
});
/* End Admin */

/* Prodi */
Route::middleware(['auth', 'verified', 'role:admin|superadmin|prodi'])->group(function () {
    /* Data */
    /* Data Dosen */
    // Route::post('data-dosen/import', [DataDosenController::class, 'importData'])->name('data-dosen.import');
    Route::resource('data-dosen', DataDosenController::class)->except('create', 'show', 'edit');
    /* Data Mahasiswa */
    Route::get('data-mahasiswa', [DataMahasiswaController::class, 'index'])->name('data-mahasiswa.index');
    Route::get('data-mahasiswa/get', [DataMahasiswaController::class, 'getMahasiswa'])->name('data-mahasiswa.get');
    /* Proposal TA */
    Route::get('data-proposal/get', [DataProposalTAController::class, 'getData'])->name('data-proposal.get');
    Route::get('data-proposal/{id}/dosen', [DataProposalTAController::class, 'editDosen'])->name('data-proposal.dosen');
    Route::patch('data-proposal/{id}/dosen', [DataProposalTAController::class, 'updateDosen'])->name('data-proposal.dosen.update');
    Route::get('data-proposal/export', [DataProposalTAController::class, 'export'])->name('data-proposal.export');
    Route::resource('data-proposal', DataProposalTAController::class);
    /* Seminar Hasil */
    Route::get('data-seminar-hasil/getdata', [DataSeminarHasilController::class, 'getData'])->name('data-seminar-hasil.getdata');
    Route::patch('data-seminar-hasil/{id}/status', [DataSeminarHasilController::class, 'status'])->name('data-seminar-hasil.status');
    Route::resource('data-seminar-hasil', DataSeminarHasilController::class);
    /* Pendadaran */
    Route::get('data-pendadaran/getdata', [DataPendadaranController::class, 'getData'])->name('data-pendadaran.getdata');
    Route::patch('data-pendadaran/{id}/lulus', [DataPendadaranController::class, 'setLulus'])->name('data-pendadaran.lulus');
    Route::resource('data-pendadaran', DataPendadaranController::class);
    /* End Data */
});
/* End Prodi */

/* Dosen */
Route::middleware(['auth', 'verified', 'role:dosen|superadmin'])->group(function () {
    /* Data */
    /* Mahasiswa Bimbingan */
    Route::get('mahasiswa-bimbingan', [MahasiswaBimbinganController::class, 'index'])->name('mahasiswa-bimbingan.index');
    Route::get('mahasiswa-bimbingan/get-data', [MahasiswaBimbinganController::class, 'getData'])->name('mahasiswa-bimbingan.getdata');
    /* Proposal TA */
    Route::get('proposal-mahasiswa/get', [ProposalTAMahasiswaController::class, 'getData'])->name('proposal-mahasiswa.get');
    Route::resource('proposal-mahasiswa', ProposalTAMahasiswaController::class);
    /* Seminar Hasil */
    Route::get('seminar-hasil-mahasiswa/get', [DosenSeminarHasilController::class, 'getData'])->name('seminar-hasil-mahasiswa.get');
    Route::resource('seminar-hasil-mahasiswa', DosenSeminarHasilController::class);
    /* Pendadaran */
    Route::get('pendadaran-mahasiswa/get', [DosenPendadaranController::class, 'getData'])->name('pendadaran-mahasiswa.get');
    Route::resource('pendadaran-mahasiswa', DosenPendadaranController::class);
    /* End Data */

    /* Filter Dashboard Dosen */
    Route::get('filter-dashboard-dosen/mhs-bimbingan/{id}', [HomeController::class, 'filterMhsBimbingan'])->name('filter-dashboard-dosen.filterMhsBimbingan');
    Route::get('filter-dashboard-dosen/mhs-bimbingan-lulus/{id}', [HomeController::class, 'filterMhsBimbinganLulus'])->name('filter-dashboard-dosen.filterMhsBimbinganLulus');
    Route::get('filter-dashboard-dosen/mhs-bimbingan-belum-lulus/{id}', [HomeController::class, 'filterMhsBimbinganBelumLulus'])->name('filter-dashboard-dosen.filterMhsBimbinganBelumLulus');
});
/* End Dosen */

/* Mahasiswa */
Route::middleware(['auth', 'verified', 'role:mahasiswa|superadmin'])->group(function () {
    /* Data */
    /* Data Mahasiswa */
    Route::resource('mahasiswa', DataController::class)->except('create', 'show', 'edit', 'destroy');
    /* Proposal TA */
    Route::resource('proposal', ProposalTAController::class);
    /* Seminar Hasil */
    Route::resource('seminar-hasil', SeminarHasilController::class);
    /* Pendadaran */
    Route::resource('pendadaran', PendadaranController::class);
    /* End Data */
});
/* End Mahasiswa */
