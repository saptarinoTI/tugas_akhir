<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\ProposalTA;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ProposalMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dosen.data.proposalta.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proposal = ProposalTA::findOrFail($id);
        return view('show.proposal', compact('proposal'));
    }

    public function getData()
    {
        $dosen = Auth::user()->id;
        $data = ProposalTA::where([
            ['dosen_id_satu', '=', $dosen],
            ['status', '=', 'diterima'],
        ])
            ->orWhere([
                ['dosen_id_dua', '=', $dosen],
                ['status', '=', 'diterima'],
            ])->with('mahasiswa')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nim', function ($row) {
                return ucwords($row->mahasiswa->nim);
            })
            ->addColumn('nama', function ($row) {
                return ucwords($row->mahasiswa->nama);
            })
            ->addColumn('status', function ($row) {
                $now = Carbon::parse();
                $tgl = Carbon::parse($row->tgl_acc);
                $result = $tgl->diffInDays($now);
                return ' <sup> + </sup> ' . $result . ' hari';
            })
            ->addColumn('btn', function ($row) {
                return '<a href="#modal" data-remote="' . route('proposal-mahasiswa.show', $row->id) . '"
            data-bs-toggle="modal" data-bs-target="#modal"
            data-title="Detail Proposal Tugas Akhir (' . $row->id . ')" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-info"><i class="bx bx-info-circle"></i></a>';
            })
            ->rawColumns(['nim', 'nama', 'status', 'btn'])
            ->make(true);
    }
}
