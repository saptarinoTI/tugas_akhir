<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\DosenImport;
use App\Imports\DosensImport;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class DataDosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dosens = Dosen::all();
        return view('admin.data.datadosen.index', compact('dosens'));
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
        $request->validate([
            'id_dosen' => 'required|unique:dosen,id|numeric',
            'nama' => 'required',
        ]);
        DB::transaction(function () use ($request) {
            /* Dosen Input DB */
            $dosen = new Dosen();
            $dosen->id =  strtolower(htmlspecialchars($request->id_dosen));
            $dosen->nama =  strtolower(htmlspecialchars($request->nama));
            $dosen->save();
            /* User Input DB */
            $user = new User();
            $user->id = $dosen->id;
            $user->name = $dosen->nama;
            $user->password = Hash::make('12345678');
            $user->save();
            $user->assignRole('dosen');
        });
        Alert::success('Data dosen pembimbing berhasil ditambahkan!');
        return redirect()->route('data-dosen.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'id_dosen' => 'required',
            'nama' => 'required',
        ]);
        DB::transaction(function () use ($request, $id) {
            /* Dosen Input DB */
            $dosen = Dosen::findOrFail($id);
            $dosen->nama =  strtolower(htmlspecialchars($request->nama));
            $dosen->save();
            /* User Input DB */
            $user = User::findOrFail($dosen->id);
            $user->name = $dosen->nama;
            $user->save();
        });
        Alert::success('Data dosen pembimbing berhasil diubah!');
        return redirect()->route('data-dosen.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();
        $user = User::findOrFail($id);
        $user->delete();
    }

    public function importData(Request $request)
    {
        $messages = [
            'required' => 'Silahkan pilih file excel terlebih dahulu.',
        ];
        $request->validate([
            'importexcel' => 'required',
        ], $messages);
        $extensions = array("xls", "xlsx");
        $result = array($request->file('importexcel')->getClientOriginalExtension());

        if (in_array($result[0], $extensions)) {
            // Do something when Succeeded
            Excel::import(new DosensImport, $request->file('importexcel'));
            Alert::success('Berhasil', 'Data dosen pembimbing berhasil ditambahkan');
            return back();
        } else {
            // Do something when it fails
            Alert::error('Gagal', 'Silahkan upload file excel dengan ekstensi xlsx atau xls');
            return back();
        }
    }
}
