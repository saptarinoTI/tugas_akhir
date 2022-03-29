<?php

namespace App\Http\Controllers;

use App\Models\Pendadaran;
use App\Models\ProposalTA;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SkripsiController extends Controller
{
    public function index()
    {
        return view('guest.skripsi.index');
    }

    public function getData()
    {
        $proTA = Pendadaran::with(['proposal', 'mahasiswa'])->where('status', 'lulus')->get();
        // $proTA = ProposalTA::with(['mahasiswa', 'pendadaran', 'dosen_satu', 'dosen_dua'])->whereHas('pendadaran', function ($query) {
        //     $query->where('status', 'lulus');
        // })->get();
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
