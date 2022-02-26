<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\ProposalTA;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MahasiswaBimbinganController extends Controller
{
    public function index()
    {
        return view('dosen.data.mhsbimbingan.index');
    }

    public function getData()
    {
        $id_dosen = auth()->user()->id;
        $proposal = ProposalTA::where('status', 'diterima')
            ->where('dosen_id_satu', '=', $id_dosen)
            ->orWhere('dosen_id_dua', '=', $id_dosen)
            ->with(['mahasiswa', 'pendadaran'])
            ->get();
        return DataTables::of($proposal)
            ->addIndexColumn()
            ->addColumn('nim', function ($proposal) {
                return ucwords($proposal->mahasiswa->nim);
            })
            ->addColumn('nama', function ($proposal) {
                return ucwords($proposal->mahasiswa->nama);
            })
            ->addColumn('judul', function ($proposal) {
                return ucwords($proposal->judul_ta);
            })
            ->addColumn('pemb', function ($proposal) {
                if ($proposal->dosen_id_satu == auth()->user()->id) {
                    return 'Utama';
                } elseif ($proposal->dosen_id_dua == auth()->user()->id) {
                    return 'Pendamping';
                }
            })
            ->addColumn('tgl', function ($proposal) {
                return date('Y', strtotime($proposal->tgl_acc));
            })
            ->addColumn('status', function ($proposal) {
                if ($proposal->pendadaran->status == 'lulus') {
                    $thnDaftar = substr($proposal->mahasiswa->nim, 0, 4);
                    $thnLulus = date('Y', strtotime($proposal->pendadaran->tgl_lulus));
                    $waktuLulus = $thnLulus - $thnDaftar;
                    $hasilLulus = $waktuLulus - 4;
                    if ($waktuLulus <= 4) {
                        return '<p class="my-1 badge py-2 px-3 bg-success">Lulus</p>';
                    } else {
                        return '<p class="my-1 badge py-2 px-3 bg-danger"> + ' . $hasilLulus . ' tahun</p>';
                    }
                } elseif ($proposal->pendadaran->status == 'tidak_lulus') {
                    return 'Tidak Lulus';
                } else {
                    return 'Pengerjaan Skripsi';
                }
            })
            ->rawColumns(['nim', 'nama', 'judul', 'pemb', 'tgl', 'status'])
            ->make(true);
    }
}
