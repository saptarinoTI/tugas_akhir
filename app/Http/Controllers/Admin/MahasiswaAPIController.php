<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class MahasiswaAPIController extends Controller
{
    public function index()
    {
        return view('admin.users.mahasiswaapi.index');
    }

    public function store()
    {
        $response = Http::get('http://api.siakad.stitek.ac.id/siakadzone/mahasiswa');
        $responseData = $response->json();
        $datas = $responseData['data'];

        foreach ($datas as $data) {
            $user = User::where('id', '=', $data['mhs_no'])->first();
            if (!$user) {
                $mahasiswa = new User;
                $mahasiswa->id = $data['mhs_no'];
                $mahasiswa->name = ucwords(strtolower($data['mhs_nama']));
                $mahasiswa->password = Hash::make('12345678');
                $mahasiswa->save();
                $mahasiswa->assignRole('mahasiswa');
            }
        }
        Alert::success('Berhasil', 'Data login mahasiswa berhasil ditambahkan.');
        return redirect()->route('mahasiswa-api.index');
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
        }
    }
}
