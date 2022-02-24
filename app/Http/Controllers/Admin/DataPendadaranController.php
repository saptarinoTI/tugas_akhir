<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendadaran;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class DataPendadaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.data.pendadaran.index');
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
        return view('admin.data.pendadaran.show', compact('pendadaran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pendadaran = Pendadaran::findOrFail($id);
        return view('admin.data.pendadaran.edit', compact('pendadaran'));
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
        $pendadaran = Pendadaran::findOrFail($id);
        $pendadaran->status = strtolower(htmlspecialchars($request->status));
        if ($pendadaran->status == 'diterima') {
            $pendadaran->keterangan = 'pendaftarakan telah diterima, silahkan menunggu untuk jadwal sidang pendadaran.';
            $pendadaran->tgl_lulus = null;
        } else {
            $pendadaran->keterangan = strtolower(htmlspecialchars($request->keterangan));
            $pendadaran->tgl_lulus = null;
        }
        $pendadaran->save();
        Alert::success('Berhasil', 'Status pendadaran tugas akhir berhasil dirubah!');
        return redirect()->route('data-pendadaran.index');
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

    public function setLulus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:lulus,tidak_lulus', 'tgl_lulus' => 'required_if:status,lulus']);
        $pendadaran = Pendadaran::findOrFail($id);
        $pendadaran->status = strtolower(htmlspecialchars($request->status));
        if ($request->status == 'lulus') {
            $pendadaran->status = $request->status;
            $pendadaran->keterangan = 'Selamat. Mahasiswa dinyatakan LULUS';
            $pendadaran->tgl_lulus = $request->tgl_lulus;
        } else {
            $pendadaran->status = $request->status;
            $pendadaran->keterangan = 'Mahasiswa dinyatakan TIDAK LULUS';
            $pendadaran->tgl_lulus = null;
        }
        $pendadaran->save();
        Alert::success('Berhasil', 'Status Pendadaran tugas akhir berhasil dirubah!');
        return redirect()->route('data-pendadaran.index');
    }

    public function getData()
    {
        $data = Pendadaran::all();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nim', function ($row) {
                return ucwords($row->mahasiswa->nim);
            })
            ->addColumn('nama', function ($row) {
                return ucwords($row->mahasiswa->nama);
            })
            ->addColumn('status', function ($row) {
                if ($row->status == 'lulus') {
                    return '<span class="badge bg-success">Lulus</span>';
                } elseif ($row->status == 'ditolak') {
                    return '<span class="badge bg-warning">Ditolak</span>';
                } elseif ($row->status == 'diterima') {
                    return '<span class="badge bg-dark">Diterima</span>';
                } elseif ($row->status == 'tidak_lulus') {
                    return '<span class="badge bg-danger">Tidak Lulus</span>';
                } else {
                    return '<span class="badge bg-info">Dikirm</span>';
                }
            })
            ->addColumn('btn', function ($row) {
                if ($row->status == 'ditolak' || $row->status == 'tidak_lulus') {
                    return '<a href="#modal" data-remote="' . route('data-pendadaran.show', $row->id) . '" data-bs-toggle="modal" data-bs-target="#modal" data-title="Detail Pendadaran Tugas Akhir (' . $row->mahasiswa_nim . ' - ' . ucwords($row->mahasiswa->nama) . ')" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-info"><i class="ti ti-eye"></i></a>';
                } elseif ($row->status == 'lulus') {
                    return '<a href="#modal" data-remote="' . route('data-pendadaran.show', $row->id) . '" data-bs-toggle="modal" data-bs-target="#modal" data-title="Detail Pendadaran Tugas Akhir (' . $row->mahasiswa_nim . ' - ' . ucwords($row->mahasiswa->nama) . ')" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-info"><i class="ti ti-eye"></i></a>';
                } else {
                    return '<a href="#modal" data-remote="' . route('data-pendadaran.edit', $row->id) . '" data-bs-toggle="modal" data-bs-target="#modal" data-title="Update Pendaftaram Pendadaran Tugas Akhir" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-dark"><i class="ti ti-pencil"></i></a>
                    <a href="#modal" data-remote="' . route('data-pendadaran.show', $row->id) . '" data-bs-toggle="modal" data-bs-target="#modal" data-title="Pendaftaran Pendadaran (' . $row->mahasiswa_nim . ' - ' . ucwords($row->mahasiswa->nama) . ')" class="my-1 btn btn-sm py-2 border-0 rounded-2 btn-info"><i class="ti ti-eye"></i></a>';
                }
            })
            ->rawColumns(['nim', 'nama', 'status', 'btn'])
            ->make(true);
    }
}
