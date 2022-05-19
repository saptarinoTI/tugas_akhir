<?php

namespace App\Http\Controllers\Admin\Prodi;

use App\Exports\ProposalTAExport;
use App\Http\Controllers\Controller;
use App\Http\Traits\FileTrait;
use App\Models\Dosen;
use App\Models\ProposalTA;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class DataProposalController extends Controller
{
    use FileTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.data.proposal.index');
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
        return view('admin.data.proposal.edit', compact('proposal', 'dosens',));
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
        // dd($request->all());
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'status' => 'in:diterima,ditolak,perbaikan',
            'tgl_acc' => 'required_if:status,diterima,perbaikan',
            'judul_ta' => 'required_if:status,diterima,perbaikan',
            'dosen_id_satu' => 'required_if:status,diterima,perbaikan',
            'dosen_id_dua' => 'required_if:status,diterima,perbaikan',
            'keterangan' => 'required_if:status,ditolak,perbaikan',
        ]);
        $proposal = ProposalTA::findOrFail($id);
        if ($request->status === "ditolak") {
            $this->deleteFile($proposal->file_satu);
            $proposal->file_satu = null;
            $proposal->judul_satu = null;
            $this->deleteFile($proposal->file_dua);
            $proposal->file_dua = null;
            $proposal->judul_dua = null;
            $this->deleteFile($proposal->file_tiga);
            $proposal->file_tiga = null;
            $proposal->judul_tiga = null;
            $proposal->status = $request->status;
            $proposal->keterangan = ucwords(htmlspecialchars($request->keterangan));
        } else if ($request->status == "diterima" || $request->status == "perbaikan") {
            $proposal->status = $request->status;
            $proposal->tgl_acc = $request->tgl_acc;
            $proposal->judul_ta = $request->judul_ta;
            $proposal->dosen_id_satu = $request->dosen_id_satu;
            $proposal->dosen_id_dua = $request->dosen_id_dua;
            if ($request->keterangan) {
                $proposal->keterangan  = ucwords(htmlspecialchars($request->keterangan));
            } else {
                $proposal->keterangan = "pendaftarakan proposal tugas akhir telah diterima.";
            }
        }
        $proposal->save();
        Alert::success('Berhasil', 'Data berhasil diperbarui');
        return redirect()->route('data-proposal.index');
    }

    public function getData()
    {
        $data = ProposalTA::with(['mahasiswa'])->get();
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
                    return '<div class="badge bg-dark"><span class="small">Diterima</span></div>';
                } elseif ($row->status == 'ditolak') {
                    return '<div class="badge bg-danger"><span class="small">Ditolak</span></div>';
                } elseif ($row->status == 'perbaikan') {
                    return '<div class="badge bg-warning"><span class="small">Perbaikan</span></div>';
                } elseif ($row->status == 'selesai') {
                    return '<div class="badge bg-success"><span class="small">Selesai</span></div>';
                } else {
                    return '<div class="badge bg-info"><span class="small">Dikirim</span></div>';
                }
            })
            ->addColumn('ket', function ($row) {
                return ucwords($row->keterangan);
            })
            ->addColumn('btn', function ($row) {
                if ($row->status == 'ditolak') {
                    return '<a href="#modal" data-remote="' . route('detail-proposal', $row->id) . '" data-bs-toggle="modal" data-bs-target="#modal" data-title="Detail Proposal Tugas Akhir" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-info"><i class="bx bx-info-circle"></i></a>';
                } elseif ($row->status == 'diterima' || $row->status == 'selesai' || $row->status == 'perbaikan') {
                    return '<a href="#modal" data-remote="' . route('detail-proposal', $row->id) . '" data-bs-toggle="modal" data-bs-target="#modal" data-title="Detail Proposal Tugas Akhir" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-info"><i class="bx bx-info-circle"></i></a>';
                } else {
                    return '<a href="' . route('data-proposal.edit', $row->id) . '" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-dark"><i class="bx bx-pencil"></i></a>
                    <a href="#modal" data-remote="' . route('detail-proposal', $row->id) . '" data-bs-toggle="modal" data-bs-target="#modal" data-title="Detail Proposal Tugas Akhir" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-info"><i class="bx bx-info-circle"></i></a>';
                }
            })
            ->rawColumns(['nim', 'nama', 'status', 'ket', 'btn'])
            ->make(true);
    }

    public function exportMahasiswa()
    {
        return Excel::download(new ProposalTAExport, 'data-proposal-ta' . date('|d-m-Y | H:i:s') . '.xlsx');
    }
}
