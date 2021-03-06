<?php

namespace App\Http\Controllers\Admin\Prodi;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DataMahasiswaController extends Controller
{
    public function index()
    {
        return view('admin.data.datamahasiswa.index');
    }

    public function getData()
    {
        $data = Mahasiswa::all();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nama', function ($row) {
                return ucwords($row->nama);
            })
            ->addColumn('ttl', function ($row) {
                return ucwords($row->tpt_lahir) . ', ' . date('d F Y', strtotime($row->tgl_lahir));
            })
            ->addColumn('nohp', function ($row) {
                if ($row->no_hp == null) {
                    return '<strong>-</strong>';
                } else {
                    return ucwords($row->no_hp);
                }
            })
            ->addColumn('alamat', function ($row) {
                if ($row->alamat == null) {
                    return '<strong>-</strong>';
                } else {
                    return ucwords($row->alamat);
                }
            })
            ->addColumn('tgl_add', function ($row) {
                return date('d F Y', strtotime($row->created_at));
            })
            ->addColumn('tgl_update', function ($row) {
                return date('d F Y', strtotime($row->updated_at));
            })
            ->rawColumns(['nama', 'ttl', 'nohp', 'alamat', 'pem_utama', 'pem_pendamping', 'judul_ta', 'tgl_add', 'tgl_update'])
            ->make(true);
    }
}
