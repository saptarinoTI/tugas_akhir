<?php

namespace App\Http\Controllers;

use App\Models\Pendadaran;
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
        $data = Pendadaran::where('status', '=', 'lulus')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('daftar_ta', function ($data) {
                return '<p style="margin: 0; font-size: 13px; font-weight: 500;" class="text-muted">' . ucwords($data->proposal->mahasiswa->nama) . ' (' . $data->created_at->format('Y') . ')</p>
                    <p style="margin: 2px 0; font-size: 14px; font-weight: 700;" class="text-dark">' . ucwords($data->proposal->judul_ta) . '</p>
                    <p style="margin: 0; font-size: 13px; font-weight: 500;" class="text-muted">' . ucwords($data->proposal->dosen_satu->nama) . '  |  ' . ucwords($data->proposal->dosen_dua->nama) . '</p>';
            })
            ->rawColumns(['daftar_ta'])
            ->make(true);
    }
}
