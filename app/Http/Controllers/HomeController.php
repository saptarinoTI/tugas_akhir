<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Pendadaran;
use App\Models\ProposalTA;
use App\Models\SeminarHasil;
use App\Models\User;
use App\Rules\MatchOldPassword;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{
    public function index()
    {
        /* Mahasiswa */
        if (auth()->user()->hasRole('mahasiswa')) {
            return view('home.index');
        }

        /* Dosen */
        if (auth()->user()->hasRole('dosen')) {
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
        }

        /* Superadmin | Admin | Prodi */
        if (auth()->user()->hasRole('superadmin|admin|prodi')) {
            $mahasiswaLulus = Pendadaran::where('status', '=', 'lulus')->get();
            foreach ($mahasiswaLulus as $mhsLulus) {
                $nim = substr($mhsLulus->mahasiswa_nim, 0, 4);
                $tgl = substr($mhsLulus->tgl_lulus, 0, 4);
                $hasil = (int)$tgl - (int)$nim;
                ($hasil < 5) ? $resultMhsLulusTepat[] = 0 : $resultMhsLulusLambat[] = 0;
            }
            $proposalStatusSend = ProposalTA::where('status', 'dikirim')->count();
            $semhasStatusSend = SeminarHasil::where('status', 'dikirim')->count();
            $pendadaranStatusSend = Pendadaran::where('status', 'dikirim')->count();

            $mahasiswaLulusChart = (new LarapexChart)->donutChart()
                ->addData([
                    count($resultMhsLulusTepat),
                    count($resultMhsLulusLambat)
                ])
                ->setColors(['#ff5964', '#007e5d'])
                ->setLabels(['Lulusan Terlambat', 'Lulusan Tepat Waktu']);

            return view('home.index', compact('mahasiswaLulusChart', 'proposalStatusSend', 'semhasStatusSend', 'pendadaranStatusSend'));
        }

        return redirect()->route('login');
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
        $request->validate([
            'old_password' => ['required', new MatchOldPassword],
            'new_password' => ['required', 'min:4'],
            'konf_password' => ['same:new_password'],
        ],);
        User::findOrFail(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
        Alert::success('sukses', 'Password berhasil dirubah!');
        return redirect()->back();
    }

    public function skripsi()
    {
        return view('guest.skripsi.index');
    }

    public function skripsiGetData()
    {
        $proTA = Pendadaran::with(['proposal', 'mahasiswa'])->where('status', 'lulus')->get();
        return DataTables::of($proTA)
            ->addIndexColumn()
            ->addColumn('nim', function ($proTA) {
                return '<p style="margin: 0; font-size: 13px; font-weight: 500;" class="text-muted">' . ucwords($proTA->mahasiswa->nama) . ' (' . $proTA->created_at->format('Y') . ')</p>
                 <p style="margin: 2px 0; font-size: 14px; font-weight: 700;" class="text-dark">' . ucwords($proTA->judul_ta) . '</p>
                 <p style="margin: 0; font-size: 13px; font-weight: 500;" class="text-muted">' . ucwords($proTA->proposal->dosen_satu->nama) . '  |  ' . ucwords($proTA->proposal->dosen_dua->nama) . '</p>';
            })
            ->rawColumns(['nim'])
            ->make(true);
    }
}
