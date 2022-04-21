<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables;

class MahasiswaAPIController extends Controller
{
    public function index()
    {
        return view('admin.users.mahasiswaapi.index');
    }

    public function getData()
    {
        try {
            $response = Http::get('http://api.siakad.stitek.ac.id/siakadzone/mahasiswa');
            $data = $response->json();
            $data = $data['data'];
            $userdupe = array();
            foreach ($data as $index => $t) {
                if (isset($userdupe[$t["mhs_no"]])) {
                    unset($data[$index]);
                    continue;
                }
                $userdupe[$t["mhs_no"]] = true;
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('mhs_nama', function ($row) {
                    return ucwords(strtolower($row['mhs_nama']));
                })
                ->addColumn('ttl', function ($row) {
                    return ucwords(strtolower($row['mhs_tmplahir'])) . ', ' . date('d F Y', strtotime($row['mhs_tgllahir']));
                })
                ->rawColumns(['mhs_nama', 'ttl'])
                ->make(true);
        } catch (ConnectionException $e) {
            return $e;
        }
    }
}
