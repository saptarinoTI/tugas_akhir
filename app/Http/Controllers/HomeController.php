<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Pendadaran;
use App\Models\ProposalTA;
use App\Models\SeminarHasil;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Format;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('mahasiswa')) {
            return view('home.index');
        } elseif (auth()->user()->hasRole('dosen')) {
            $dosen = auth()->user()->id;
            $proposalProgres = ProposalTA::where([
                ['dosen_id_satu', '=', $dosen],
                ['status', '=', 'diterima'],
            ])
                ->orWhere([
                    ['dosen_id_dua', '=', $dosen],
                    ['status', '=', 'diterima'],
                ])->get();

            $semhasProgres = SeminarHasil::where('status', 'diterima')
                ->whereHas('proposal', function ($query) {
                    $query->where('dosen_id_satu', auth()->user()->id)
                        ->orWhere('dosen_id_dua', auth()->user()->id);
                })->get();

            $pendadaranProgres = Pendadaran::where('status', 'diterima')
                ->whereHas('proposal', function ($query) {
                    $query->where('dosen_id_satu', auth()->user()->id)
                        ->orWhere('dosen_id_dua', auth()->user()->id);
                })->get();

            return view('home.index', compact('proposalProgres', 'semhasProgres', 'pendadaranProgres'));
        } elseif (auth()->user()->hasRole('superadmin|admin|prodi')) {
            $pendadaran = Pendadaran::where('status', '=', 'lulus')->get();
            $totalMhsLulus = Pendadaran::where('status', 'lulus')->count();
            $totalMhsLulusThnIni = Pendadaran::where('status', 'lulus')->whereYear('tgl_lulus', date('Y'))->count();
            $totalMhsTepat = [];
            $totalMhsLambat = [];
            foreach ($pendadaran as $pend) {
                $nim = substr($pend->mahasiswa_nim, 0, 4);
                $tgl = substr($pend->tgl_lulus, 0, 4);
                $hasil = (int)$tgl - (int)$nim;
                if ($hasil < 5) {
                    $totalMhsTepat[] = 0;
                } else {
                    $totalMhsLambat[] = 0;
                }
            }


            $totalMhsTahun = Mahasiswa::whereYear('created_at', date('Y'))->count();
            $totalProposal = ProposalTA::where('status', 'dikirim')->count();
            $totalSemhas = SeminarHasil::where('status', 'dikirim')->count();
            $totalPend = Pendadaran::where('status', 'dikirim')->count();
            return view('home.index', compact('totalMhsLulus', 'totalMhsLulusThnIni', 'totalMhsTepat', 'totalMhsLambat', 'totalMhsTahun', 'totalProposal', 'totalSemhas', 'totalPend'));
        } else {
            return redirect()->route('login');
        }
    }

    public function filterMhsBimbingan($id)
    {
        $idDosen = auth()->user()->id;
        $mhsBimbinganTahun = ProposalTA::where('dosen_id_satu', $idDosen)->orWhere('dosen_id_dua', $idDosen)->whereYear('tgl_acc', $id)->count();
        return response($mhsBimbinganTahun);
    }

    public function filterMhsBimbinganLulus($id)
    {
        $mhsBimbinganLulus = Pendadaran::whereYear('tgl_lulus', '=', $id)->whereHas('proposal', function ($query) {
            $query->where('dosen_id_satu', auth()->user()->id)->orWhere('dosen_id_dua', auth()->user()->id);
        })->count();
        return response($mhsBimbinganLulus);
    }

    public function filterMhsBimbinganBelumLulus($id)
    {
        $mhsBimbinganBlmLulus = ProposalTA::where('dosen_id_satu', auth()->user()->id)->orWhere('dosen_id_dua', auth()->user()->id)->WhereYear('tgl_acc', $id)->whereHas('pendadaran', function ($query) {
            $query->where('tgl_lulus', NULL);
        })->count();
        return response($mhsBimbinganBlmLulus);
    }

    public function registerEmailGet()
    {
        // $email = auth()->user()->email;
        // if ($email == NULL) {
        return view('auth.register-email');
        // } else {
        //     return back();
        // }
    }

    public function registerEmailPost(Request $request)
    {
        $messages = [
            'required' => ':Attribute wajib diisi.',
            'email' => 'Masukkan email dengan benar.',
            'unique' => 'Email yang dimasukkan telah terdaftar.'
        ];
        $request->validate([
            'email' => 'required|email|unique:users,email'
        ], $messages);
        $id = auth()->user()->id;
        User::findOrFail($id)->update([
            'email' => $request->email,
        ]);
        Alert::success('Berhasil', 'Email berhasil ditambahkan!');
        return redirect()->route('verification.notice');
    }

    public function changePasswordGet()
    {
        return view('auth.change-password');
    }

    public function changePasswordPost(Request $request)
    {
        // dd($request->all());
        $messages = [
            'required' => ':Attribute wajib diisi.',
            'same' => 'Konfirmasi password tidak sama dengan password baru!.',
            'min' => ':Attribute minimal :min karakter.',
        ];
        $request->validate([
            'old_password' => ['required', new MatchOldPassword],
            'new_password' => ['required', 'min:4'],
            'konf_password' => ['same:new_password'],
        ], $messages);
        User::findOrFail(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
        Alert::success('sukses', 'Password berhasil dirubah!');
        return redirect()->back();
    }
}
