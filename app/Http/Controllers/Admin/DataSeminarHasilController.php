<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProposalTA;
use App\Models\SeminarHasil;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class DataSeminarHasilController extends Controller
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
        $seminar = SeminarHasil::findOrFail($id);
        return view('admin.data.seminarhasil.show', compact('seminar'));
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
            $seminar_hasil->tgl_acc = null;
            $seminar_hasil->proposal->status = 'selesai';
        } else {
            $seminar_hasil->keterangan = strtolower(htmlspecialchars($request->keterangan));
            $seminar_hasil->tgl_acc = null;
        }
        $seminar_hasil->proposal->save();
        $seminar_hasil->save();
        Alert::success('Berhasil', 'Status seminar hasil berhasil dirubah!');
        return redirect()->route('data-seminar-hasil.index');
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

    public function status(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:selesai',
        ]);
        $seminar_hasil = SeminarHasil::findOrFail($id);
        $seminar_hasil->status = strtolower(htmlspecialchars($request->status));
        $seminar_hasil->keterangan = 'seminar hasil telah selesai. silahkan persiapkan diri untuk pendadaran.';
        $seminar_hasil->tgl_acc = date(now());
        $seminar_hasil->save();
        Alert::success('Berhasil', 'Status seminar hasil berhasil dirubah!');
        return redirect()->route('data-seminar-hasil.index');
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
                    return '<a href="#modal" data-remote="' . route('data-seminar-hasil.show', $row->id) . '" data-bs-toggle="modal" data-bs-target="#modal" data-title="Detail Data Seminar Tugas Aakhir (' . $row->mahasiswa_nim . ' - ' . ucwords($row->mahasiswa->nama) . ')" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-info"><i class="ti ti-eye"></i></a>';
                } elseif ($row->status == 'diterima' || $row->status == 'selesai') {
                    return '<a href="#modal" data-remote="' . route('data-seminar-hasil.show', $row->id) . '" data-bs-toggle="modal" data-bs-target="#modal" data-title="Detail Data Seminar Tugas Aakhir (' . $row->mahasiswa_nim . ' - ' . ucwords($row->mahasiswa->nama) . ')" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-info"><i class="ti ti-eye"></i></a>';
                } else {
                    return '<a href="#modal" data-remote="' . route('data-seminar-hasil.edit', $row->id) . '" data-bs-toggle="modal" data-bs-target="#modal" data-title="Update Pendaftaram Seminar Hasil Tugas Akhir" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-dark"><i class="ti ti-pencil"></i></a>
                    <a href="#modal" data-remote="' . route('data-seminar-hasil.show', $row->id) . '" data-bs-toggle="modal" data-bs-target="#modal" data-title="Detail Data Seminar Hasil Tugas Akhir (' . $row->mahasiswa_nim . ' - ' . ucwords($row->mahasiswa->nama) . ')" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-info"><i class="ti ti-eye"></i></a>';
                }
            })
            ->rawColumns(['nim', 'nama', 'status', 'btn'])
            ->make(true);
    }
}
