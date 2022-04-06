<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProposalTAExport;
use App\Http\Controllers\Controller;
use App\Http\Traits\FileTrait;
use App\Models\Dosen;
use App\Models\ProposalTA;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class DataProposalTAController extends Controller
{
    use FileTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dosens = Dosen::first();
        dd($dosens->proposal);
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
            'status' => 'in:diterima,ditolak',
            'tgl_acc' => 'required_if:status,diterima',
            'judul_ta' => 'required_if:status,diterima',
            'dosen_id_satu' => 'required_if:status,diterima',
            'dosen_id_dua' => 'required_if:status,diterima',
            'keterangan' => 'required_if:status,ditolak',
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
        } else if ($request->status == "diterima") {
            $proposal->status = $request->status;
            $proposal->tgl_acc = $request->tgl_acc;
            $proposal->judul_ta = $request->judul_ta;
            $proposal->dosen_id_satu = $request->dosen_id_satu;
            $proposal->dosen_id_dua = $request->dosen_id_dua;
            if ($request->keterangan) {
                $proposal->keterangan  = ucwords(htmlspecialchars($request->keterangan));
            } else {
                $proposal->keterangan = "Pendaftarakan Proposal Tugas Akhir Telah Diterima.";
            }
        }
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
                    return '<span class="badge bg-dark">Diterima</span>';
                } elseif ($row->status == 'ditolak') {
                    return '<span class="badge bg-danger">Ditolak</span>';
                } elseif ($row->status == 'selesai') {
                    return '<span class="badge bg-success">Selesai</span>';
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
                } elseif ($row->status == 'diterima' || $row->status == 'selesai') {
                    return '<a href="#modal" data-remote="' . route('data-proposal.show', $row->id) . '" data-bs-toggle="modal" data-bs-target="#modal" data-title="Detail Proposal Tugas Akhir (' . $row->mahasiswa_nim . ' - ' . ucwords($row->mahasiswa->nama) . ')" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-info"><i class="ti ti-eye"></i></a>';
                } else {
                    return '<a href="#modal" data-remote="' . route('data-proposal.edit', $row->id) . '" data-bs-toggle="modal" data-bs-target="#modal" data-title="Update Ajuan Tugas Akhir" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-dark"><i class="ti ti-pencil"></i></a>
                    <a href="#modal" data-remote="' . route('data-proposal.show', $row->id) . '" data-bs-toggle="modal" data-bs-target="#modal" data-title="Detail Proposal Tugas Akhir (' . $row->mahasiswa_nim . ' - ' . ucwords($row->mahasiswa->nama) . ')" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-info"><i class="ti ti-eye"></i></a>';
                }
            })
            ->rawColumns(['nim', 'nama', 'status', 'ket', 'btn'])
            ->make(true);
    }

    public function export()
    {
        return Excel::download(new ProposalTAExport, 'data-proposal-ta' . date('H:i:s') . '.xlsx');
    }
}
