<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\ProposalTA;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class DataProposalTAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.data.proposalta.index');
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
        $proposal = ProposalTA::findOrFail($id);
        return view('admin.data.proposalta.show', compact('proposal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proposal = ProposalTA::findOrFail($id);
        $dosens = Dosen::all();
        $dosenSelect = Dosen::where('id', $proposal->dosen_id_satu)->first();
        return view('admin.data.proposalta.edit', compact('proposal', 'dosens', 'dosenSelect'));
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
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'penguji_prota' => 'required',
        ]);
        $proposal = ProposalTA::findOrFail($id);
        $proposal->dosen_id_satu = $request->penguji_prota;
        $proposal->status = 'diperiksa';
        $proposal->keterangan = "ajuan proposal tugas akhir sedang diperiksa oleh dosen penguji";
        $proposal->save();
        Alert::success('Berhasil', 'Data berhasil diperbarui');
        return redirect()->route('data-proposal.index');
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

    public function editDosen($id)
    {
        $proposal = ProposalTA::findOrFail($id);
        $dosens = Dosen::all();
        return view('admin.data.proposalta.editDosen', compact('proposal', 'dosens'));
    }

    public function updateDosen(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'dosen_id_satu' => 'required',
            'dosen_id_dua' => 'required',
            'judul_ta' => 'required',
        ]);
        $proposal = ProposalTA::findOrFail($id);
        $proposal->dosen_id_dua = $request->dosen_id_dua;
        $proposal->status = 'diterima';
        $proposal->save();
        Alert::success('Berhasil', 'Data berhasil diperbarui');
        return redirect()->route('data-proposal.index');
    }

    public function getData()
    {
        $data = ProposalTA::all();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nim', function ($row) {
                return ucwords($row->mahasiswa->nim);
            })
            ->addColumn('nama', function ($row) {
                return ucwords($row->mahasiswa->nama);
            })
            ->addColumn('status', function ($row) {
                if ($row->status == 'diterima') {
                    return '<span class="badge bg-success">Diterima</span>';
                } elseif ($row->status == 'ditolak') {
                    return '<span class="badge bg-danger">Ditolak</span>';
                } elseif ($row->status == 'diproses') {
                    return '<span class="badge bg-dark">Diproses</span>';
                } elseif ($row->status == 'diperiksa') {
                    return '<span class="badge bg-warning">Diperiksa</span>';
                } else {
                    return '<span class="badge bg-info">Dikirm</span>';
                }
            })
            ->addColumn('ket', function ($row) {
                return ucwords($row->keterangan);
            })
            ->addColumn('btn', function ($row) {
                if ($row->status == 'ditolak') {
                    return '<a href="#modal" data-remote="' . route('data-proposal.show', $row->id) . '" data-bs-toggle="modal" data-bs-target="#modal" data-title="Detail Proposal Tugas Akhir (' . $row->mahasiswa_nim . ' - ' . ucwords($row->mahasiswa->nama) . ')" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-info"><i class="ti ti-eye"></i></a>';
                } elseif ($row->status == 'diproses') {
                    return '<a href="#modal" data-remote="' . route('data-proposal.dosen', $row->id) . '" data-bs-toggle="modal" data-bs-target="#modal" data-title="Update Ajuan Tugas Akhir" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-dark"><i class="ti ti-pencil"></i></a>';
                } elseif ($row->status == 'diterima') {
                    return '<a href="#modal" data-remote="' . route('data-proposal.show', $row->id) . '" data-bs-toggle="modal" data-bs-target="#modal" data-title="Detail Proposal Tugas Akhir (' . $row->mahasiswa_nim . ' - ' . ucwords($row->mahasiswa->nama) . ')" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-info"><i class="ti ti-eye"></i></a>';
                } else {
                    return '<a href="#modal" data-remote="' . route('data-proposal.edit', $row->id) . '" data-bs-toggle="modal" data-bs-target="#modal" data-title="Update Ajuan Tugas Akhir" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-dark"><i class="ti ti-pencil"></i></a>
                    <a href="#modal" data-remote="' . route('data-proposal.show', $row->id) . '" data-bs-toggle="modal" data-bs-target="#modal" data-title="Detail Proposal Tugas Akhir (' . $row->mahasiswa_nim . ' - ' . ucwords($row->mahasiswa->nama) . ')" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-info"><i class="ti ti-eye"></i></a>';
                }
            })
            ->rawColumns(['nim', 'nama', 'status', 'ket', 'btn'])
            ->make(true);
    }
}
