<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Pendadaran;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PendadaranMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dosen.data.pendadaran.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pendadaran = Pendadaran::findOrFail($id);
        return view('show.pendadaran', compact('pendadaran'));
    }

    public function getData()
    {
        $data = Pendadaran::where('status', 'diterima')
            ->whereHas('proposal', function ($query) {
                $query->where('dosen_id_satu', auth()->user()->id)
                    ->orWhere('dosen_id_dua', auth()->user()->id);
            })->with('mahasiswa')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nim', function ($row) {
                return ucwords($row->mahasiswa->nim);
            })
            ->addColumn('nama', function ($row) {
                return ucwords($row->mahasiswa->nama);
            })
            ->addColumn('btn', function ($row) {
                return '<a href="#modal" data-remote="' . route('pendadaran-mahasiswa.show', $row->id) . '"
            data-bs-toggle="modal" data-bs-target="#modal"
            data-title="Ajuan Proposal Tugas Akhir (' . $row->mahasiswa_nim . ' - ' . ucwords($row->mahasiswa->nama) . ')" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-info"><i class="bx bx-info-circle"></i></a>';
            })
            ->rawColumns(['nim', 'nama', 'btn'])
            ->make(true);
    }
}
