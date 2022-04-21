<?php

namespace App\Http\Controllers\Admin\Prodi;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class DataDosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dosens = Dosen::select(['id', 'nama'])->get();
        return view('admin.data.datadosen.index', compact('dosens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.data.datadosen.create');
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
            /* Dosen Input DB $dosen->id*/
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
        Alert::success('Data dosen berhasil ditambahkan!');
        return redirect()->route('data-dosen.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('admin.data.datadosen.edit', compact('dosen'));
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
}
