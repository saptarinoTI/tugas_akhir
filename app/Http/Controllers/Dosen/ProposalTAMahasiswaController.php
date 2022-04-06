<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Http\Traits\FileTrait;
use App\Models\ProposalTA;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class ProposalTAMahasiswaController extends Controller
{
    use FileTrait;
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
        return view('dosen.data.proposalta.show', compact('proposal'));
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
        return view('dosen.data.proposalta.edit', compact('proposal'));
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
            'status' => 'required|in:diterima,ditolak',
            'tgl_acc' => 'required_if:status,diterima',
            'judul_ta' => 'required_if:status,diterima',
            'keterangan' => 'required',
        ]);
        $proposal = ProposalTA::findOrFail($id);
        if ($request->status == 'ditolak') {
            $proposal->status = 'ditolak';
            $this->deleteFile($proposal->file_satu);
            $proposal->file_satu = null;
            $this->deleteFile($proposal->file_dua);
            $proposal->file_dua = null;
            $this->deleteFile($proposal->file_tiga);
            $proposal->file_tiga = null;
        } else {
            $proposal->status = 'diproses';
        }
        if ($request->tgl_acc != null) {
            $proposal->tgl_acc = $request->tgl_acc;
        }
        $proposal->judul_ta = htmlspecialchars(strtolower($request->judul_ta));
        $proposal->keterangan = htmlspecialchars(strtolower($request->keterangan));
        $proposal->save();
        Alert::success('Berhasil', 'Data berhasil diubah');
        return redirect()->route('proposal-mahasiswa.index');
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
            // ->addColumn('status', function ($row) {
            //     if ($row->status == 'diterima') {
            //         return '<span class="badge bg-dark">Diterima</span>';
            //     } elseif ($row->status == 'ditolak') {
            //         return '<span class="badge bg-danger">Ditolak</span>';
            //     } elseif ($row->status == 'selesai') {
            //         return '<span class="badge bg-success">Selesai</span>';
            //     } else {
            //         return '<span class="badge bg-info">Dikirm</span>';
            //     }
            ->addColumn('status', function ($row) {
                // $now = date('Y-m-d');
                // $tgl = $row->tgl_acc;
                // $result = $tgl->diff($now);
                // return $result;
                $now = Carbon::parse();
                $tgl = Carbon::parse($row->tgl_acc);
                $result = $tgl->diffInDays($now);
                return ' <sup> + </sup> ' . $result . ' hari';
            })
            ->addColumn('btn', function ($row) {
                // if ($row->status == 'selesai' || $row->status == 'diterima') {
                return '<a href="#modal" data-remote="' . route('proposal-mahasiswa.show', $row->id) . '"
            data-bs-toggle="modal" data-bs-target="#modal"
            data-title="Detail Proposal Tugas Akhir (' . $row->id . ')" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-info"><i class="ti ti-eye"></i></a>';
                //     } else {
                //         return '<a href="#modal" data-remote="' . route('proposal-mahasiswa.edit', $row->id) . '"
                // data-bs-toggle="modal" data-bs-target="#modal"
                // data-title="Update Ajuan Proposal Tugas Akhir" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-dark"><i class="ti ti-pencil"></i></a>
                //     <a href="#modal" data-remote="' . route('proposal-mahasiswa.show', $row->id) . '"
                // data-bs-toggle="modal" data-bs-target="#modal"
                // data-title="Ajuan Proposal Tugas Akhir (' . $row->mahasiswa_nim . ' - ' . ucwords($row->mahasiswa->nama) . ')" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-info"><i class="ti ti-eye"></i></a>';
                //     };
            })
            ->rawColumns(['nim', 'nama', 'status', 'btn'])
            ->make(true);
    }
}
