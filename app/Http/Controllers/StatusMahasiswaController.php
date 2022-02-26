<?php

namespace App\Http\Controllers;

use App\Models\Pendadaran;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StatusMahasiswaController extends Controller
{
    public function index()
    {
        return view('home.status-mahasiswa.index');
    }

    public function show($id)
    {
        $pendadaran = Pendadaran::findOrFail($id);
        return view('home.status-mahasiswa.show', compact('pendadaran'));
    }

    public function getData()
    {
        $lulus = Pendadaran::where('status', 'lulus')->with('mahasiswa')->get();
        return DataTables::of($lulus)
            ->addIndexColumn()
            ->addColumn('nim', function ($row) {
                return ucwords($row->mahasiswa->nim);
            })
            ->addColumn('nama', function ($row) {
                return ucwords($row->mahasiswa->nama);
            })
            ->addColumn('thn_lulus', function ($row) {
                return date('Y', strtotime($row->tgl_lulus));
            })
            ->addColumn('status', function ($row) {
                $thnDaftar = substr($row->mahasiswa->nim, 0, 4);
                $thnLulus = date('Y', strtotime($row->tgl_lulus));
                $waktuLulus = $thnLulus - $thnDaftar;
                $hasilLulus = $waktuLulus - 4;
                if ($waktuLulus <= 4) {
                    return '<p class="my-1 badge py-2 px-3 bg-success">Lulus</p>';
                } else {
                    return '<p class="my-1 badge py-2 px-3 bg-danger">Lulus + ' . $hasilLulus . ' tahun</p>';
                }
            })
            ->addColumn('aksi', function ($row) {
                return '<a href="#modal" data-remote="' . route('mahasiswa-lulus.show', $row->id) . '" data-bs-toggle="modal" data-bs-target="#modal" data-title="Detail Lulusan Mahasiswa Teknik Informatika" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-info"><i class="ti ti-eye"></i></a>';
            })
            ->rawColumns(['nim', 'nama', 'thn_lulus', 'status', 'aksi'])
            ->make(true);
    }
}
