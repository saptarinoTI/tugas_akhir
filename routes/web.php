<?php

use App\Http\Controllers\Admin\MahasiswaAPIController;
use App\Http\Controllers\Admin\Prodi\DataDosenController;
use App\Http\Controllers\Admin\Prodi\DataLulusanMahasiswaController;
use App\Http\Controllers\Admin\Prodi\DataMahasiswaController;
use App\Http\Controllers\Admin\Prodi\DataPendadaranController;
use App\Http\Controllers\Admin\Prodi\DataProposalController;
use App\Http\Controllers\Admin\Prodi\DataSeminarController;
use App\Http\Controllers\Admin\UserLoginController;
use App\Http\Controllers\Dosen\PendadaranMahasiswaController;
use App\Http\Controllers\Dosen\ProposalMahasiswaController;
use App\Http\Controllers\Dosen\SeminarMahasiswaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Mahasiswa\DataPribadiController;
use App\Http\Controllers\Mahasiswa\PendadaranController;
use App\Http\Controllers\Mahasiswa\ProposalController;
use App\Http\Controllers\Mahasiswa\SeminarController;
use App\Http\Controllers\Show\DetailController;
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

/* Dashboard */
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(['auth', 'verified']);
Route::get('/register-email', [HomeController::class, 'registerEmailGet'])->name('register.getEmail')->middleware(['auth']);
Route::post('/register-email', [HomeController::class, 'registerEmailPost'])->name('register.postEmail')->middleware(['auth']);

/* Auth Future */
Route::middleware(['auth', 'verified'])->group(function () {
    /* Detail Show */
    // Proposal
    Route::get('detail-proposal/{id}', [DetailController::class, 'proposal'])->name('detail-proposal');
    // Seminar
    Route::get('detail-seminar/{id}', [DetailController::class, 'seminar'])->name('detail-seminar');
    // Pendadaran
    Route::get('detail-pendadaran/{id}', [DetailController::class, 'pendadaran'])->name('detail-pendadaran');
    /* End Detail Show */

    /*  Change Password */
    Route::get('/password/change', [HomeController::class, 'changePasswordGet'])->name('password-change.get');
    Route::patch('/password/change', [HomeController::class, 'changePasswordPost'])->name('password-change.post');
    /*  End Change Password */
});
/* End Auth Future */

/* Guest */
// List Judul Skripsi
Route::get('skripsi', [HomeController::class, 'skripsi'])->name('skripsi.index');
Route::get('skripsi/getdata', [HomeController::class, 'skripsiGetData'])->name('skripsi.getData');
/* End Guest */

/* Admin */
Route::middleware(['auth', 'verified', 'role:admin|superadmin'])->group(function () {
    /* Users */
    // UserLogin 
    Route::get('user-login/get-user-login', [UserLoginController::class, 'getData'])->name('user-login.getdata');
    Route::resource('user-login', UserLoginController::class)->except(['show', 'edit', 'update']);
    // MahasiswaAPI 
    Route::get('mahasiswa-api', [MahasiswaAPIController::class, 'index'])->name('mahasiswa-api.index');
    Route::get('mahasiswa-api/getdata', [MahasiswaAPIController::class, 'getData'])->name('mahasiswa-api.getData');
    /* End Users */
});
/* End Admin */

/* Admin | Prodi */
Route::middleware(['auth', 'verified', 'role:admin|superadmin|prodi'])->group(function () {
    /* Data */
    // Dosen
    Route::resource('data-dosen', DataDosenController::class)->except(['show']);

    // Mahasiswa
    Route::get('data-mahasiswa', [DataMahasiswaController::class, 'index'])->name('data-mahasiswa.index');
    Route::get('data-mahasiswa/getdata', [DataMahasiswaController::class, 'getData'])->name('data-mahasiswa.getData');

    // Proposal
    Route::get('data-proposal/getdata', [DataProposalController::class, 'getData'])->name('data-proposal.getData');
    Route::get('data-proposal/export', [DataProposalController::class, 'exportMahasiswa'])->name('data-proposal.export');
    Route::resource('data-proposal', DataProposalController::class)->except(['create', 'store', 'show', 'destroy']);

    // Seminar
    Route::get('data-seminar/getdata', [DataSeminarController::class, 'getData'])->name('data-seminar.getData');
    Route::resource('data-seminar', DataSeminarController::class)->except(['create', 'store', 'show', 'destroy']);

    // Pendadaran
    Route::get('data-pendadaran/getData', [DataPendadaranController::class, 'getData'])->name('data-pendadaran.getData');
    Route::put('data-pendadaran/{id}/lulus', [DataPendadaranController::class, 'setLulus'])->name('data-pendadaran.setLulus');
    Route::resource('data-pendadaran', DataPendadaranController::class);
    /* End Data */

    /* Lulusan */
    // Mahasiswa
    Route::get('mahasiswa-lulusan', [DataLulusanMahasiswaController::class, 'index'])->name('mahasiswa-lulusan.index');
    Route::get('mahasiswa-lulusan/getdata', [DataLulusanMahasiswaController::class, 'getData'])->name('mahasiswa-lulusan.getData');
    Route::get('mahasiswa-lulusan/{id}', [DataLulusanMahasiswaController::class, 'show'])->name('mahasiswa-lulusan.show');
    /* End Lulusan */
});
/* End Admin | Prodi */

/* Mahasiswa */
Route::middleware(['auth', 'verified', 'role:mahasiswa'])->group(function () {
    /* Data */
    // Data Pribadi
    Route::resource('data-diri', DataPribadiController::class)->except(['show', 'destroy']);

    // Proposal
    Route::resource('proposal', ProposalController::class)->except(['destroy']);

    // Seminar Hasil
    Route::resource('seminar', SeminarController::class)->except(['destroy']);

    // Pendadaran
    Route::resource('pendadaran', PendadaranController::class)->except(['destroy']);

    /* End Data */
});
/* End Mahasiswa */

/* Dosen */
Route::middleware(['auth', 'verified', 'role:dosen|superadmin'])->group(function () {
    /* Bimbingan */
    // Proposal
    Route::get('proposal-mahasiswa/getdata', [ProposalMahasiswaController::class, 'getData'])->name('proposal-mahasiswa.getData');
    Route::resource('proposal-mahasiswa', ProposalMahasiswaController::class)->except(['create', 'store', 'edit', 'update', 'destroy']);

    // Seminar
    Route::get('seminar-mahasiswa/getdata', [SeminarMahasiswaController::class, 'getData'])->name('seminar-mahasiswa.getData');
    Route::resource('seminar-mahasiswa', SeminarMahasiswaController::class)->except(['create', 'store', 'edit', 'update', 'destroy']);

    // Pendadaran
    Route::get('pendadaran-mahasiswa/getdata', [PendadaranMahasiswaController::class, 'getData'])->name('pendadaran-mahasiswa.getData');
    Route::resource('pendadaran-mahasiswa', PendadaranMahasiswaController::class)->except(['create', 'store', 'edit', 'update', 'destroy']);

    /* End Bimbingan */
});
/* End Dosen */