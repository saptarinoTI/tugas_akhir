<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Pendadaran;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PendadaranController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        return view('dosen.data.pendadaran.show', compact('pendadaran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
                // if ($row->status == 'selesai' || $row->status == 'diterima') {
                return '<a href="#modal" data-remote="' . route('pendadaran-mahasiswa.show', $row->id) . '"
            data-bs-toggle="modal" data-bs-target="#modal"
            data-title="Ajuan Proposal Tugas Akhir (' . $row->mahasiswa_nim . ' - ' . ucwords($row->mahasiswa->nama) . ')" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-info"><i class="ti ti-eye"></i></a>';
                //     } else {
                //         return '<a href="#modal" data-remote="' . route('proposal-mahasiswa.edit', $row->id) . '"
                // data-bs-toggle="modal" data-bs-target="#modal"
                // data-title="Update Ajuan Proposal Tugas Akhir" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-dark"><i class="ti ti-pencil"></i></a>
                //     <a href="#modal" data-remote="' . route('proposal-mahasiswa.show', $row->id) . '"
                // data-bs-toggle="modal" data-bs-target="#modal"
                // data-title="Ajuan Proposal Tugas Akhir (' . $row->mahasiswa_nim . ' - ' . ucwords($row->mahasiswa->nama) . ')" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-info"><i class="ti ti-eye"></i></a>';
                //     };
            })
            ->rawColumns(['nim', 'nama', 'btn'])
            ->make(true);
    }
}
