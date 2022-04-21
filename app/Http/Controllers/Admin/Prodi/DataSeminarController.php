<?php

namespace App\Http\Controllers\Admin\Prodi;

use App\Http\Controllers\Controller;
use App\Models\SeminarHasil;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class DataSeminarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.data.seminarhasil.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $seminar = SeminarHasil::findOrFail($id);
        return view('admin.data.seminarhasil.edit', compact('seminar'));
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
            'keterangan' => 'required_if:status,ditolak'
        ]);
        $seminar_hasil = SeminarHasil::findOrFail($id);
        $seminar_hasil->status = strtolower(htmlspecialchars($request->status));
        if ($seminar_hasil->status == 'diterima') {
            $seminar_hasil->keterangan = 'pendaftarakan telah diterima, silahkan menunggu untuk jadwal sidang seminar hasil.';
            $seminar_hasil->tgl_acc = Carbon::parse();
            $seminar_hasil->proposal->status = 'selesai';
        } else {
            $seminar_hasil->keterangan = strtolower(htmlspecialchars($request->keterangan));
            $seminar_hasil->tgl_acc = null;
        }
        $seminar_hasil->proposal->save();
        $seminar_hasil->save();
        Alert::success('Berhasil', 'Status seminar hasil berhasil dirubah!');
        return redirect()->route('data-seminar.index');
    }

    public function getData()
    {
        $data = SeminarHasil::with('mahasiswa')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nim', function ($row) {
                return ucwords($row->mahasiswa->nim);
            })
            ->addColumn('nama', function ($row) {
                return ucwords($row->mahasiswa->nama);
            })
            ->addColumn('status', function ($row) {
                if ($row->status == 'selesai') {
                    return '<span class="badge bg-success">Selesai</span>';
                } elseif ($row->status == 'ditolak') {
                    return '<span class="badge bg-danger">Ditolak</span>';
                } elseif ($row->status == 'diterima') {
                    return '<span class="badge bg-dark">Diterima</span>';
                } else {
                    return '<span class="badge bg-info">Dikirm</span>';
                }
            })
            ->addColumn('btn', function ($row) {
                if ($row->status == 'ditolak') {
                    return '<a href="#modal" data-remote="' . route('detail-seminar', $row->id) . '" data-bs-toggle="modal" data-bs-target="#modal" data-title="Detail Data Seminar Hasil Tugas Akhir" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-info"><i class="bx bx-info-circle"></i></a>';
                } elseif ($row->status == 'diterima' || $row->status == 'selesai') {
                    return '<a href="#modal" data-remote="' . route('detail-seminar', $row->id) . '" data-bs-toggle="modal" data-bs-target="#modal" data-title="Detail Data Seminar Hasil Tugas Akhir" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-info"><i class="bx bx-info-circle"></i></a>';
                } else {
                    return '<a href="' . route('data-seminar.edit', $row->id) . '" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-dark"><i class="bx bx-pencil"></i></a>
                    <a href="#modal" data-remote="' . route('detail-seminar', $row->id) . '" data-bs-toggle="modal" data-bs-target="#modal" data-title="Detail Data Seminar Hasil Tugas Akhir" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-info"><i class="bx bx-info-circle"></i></a>';
                }
            })
            ->rawColumns(['nim', 'nama', 'status', 'btn'])
            ->make(true);
    }
}
