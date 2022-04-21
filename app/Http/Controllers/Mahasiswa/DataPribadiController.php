<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DataPribadiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nim = Auth::user()->id;
        $mahasiswa = Mahasiswa::where('nim', '=', $nim)->first();
        return view('mahasiswa.data.mahasiswa.index', compact('mahasiswa', 'nim'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nim = Auth::user()->id;
        return view('mahasiswa.data.mahasiswa.create', compact('nim'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'unique' => ':Attribute telah terdaftar.', 'required' => 'Silahkan isi :attribute terlebih dahulu.',
            'numeric' => ':Attribute harus berupa angka.',
            'date' => 'Tanggal lahir yang anda input tidak valid.'
        ];
        $request->validate([
            'nim' => 'required|numeric|unique:mahasiswa,nim',
            'nama' => 'required',
            'no_hp' => 'required|numeric',
            'tpt_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required',
        ], $messages);
        $mahasiswa = new Mahasiswa();
        $mahasiswa->nim = strtolower(htmlspecialchars($request->nim));
        $mahasiswa->nama = strtolower(htmlspecialchars($request->nama));
        $mahasiswa->no_hp = strtolower(htmlspecialchars($request->no_hp));
        $mahasiswa->tpt_lahir = strtolower(htmlspecialchars($request->tpt_lahir));
        $mahasiswa->tgl_lahir = strtolower(htmlspecialchars($request->tgl_lahir));
        $mahasiswa->alamat = strtolower(htmlspecialchars($request->alamat));
        $mhs = $mahasiswa->save();

        Alert::success('Data diri mahasiswa berhasil ditambahkan!');
        return redirect()->route('data-diri.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.data.mahasiswa.edit', compact('mahasiswa'));
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
        $messages = [
            'unique' => ':Attribute telah terdaftar.', 'required' => 'Silahkan isi :attribute terlebih dahulu.',
            'numeric' => ':Attribute harus berupa angka.',
            'date' => 'Tanggal lahir yang anda input tidak valid.'
        ];
        $request->validate([
            'nim' => 'required|numeric',
            'nama' => 'required',
            'no_hp' => 'required|numeric',
            'tpt_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required',
        ], $messages);
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update([
            'nim' => strtolower(htmlspecialchars($request->nim)),
            'nama' => strtolower(htmlspecialchars($request->nama)),
            'no_hp' => strtolower(htmlspecialchars($request->no_hp)),
            'tpt_lahir' => strtolower(htmlspecialchars($request->tpt_lahir)),
            'tgl_lahir' => strtolower(htmlspecialchars($request->tgl_lahir)),
            'alamat' => strtolower(htmlspecialchars($request->alamat)),
            'updated_at' => date(now()),
        ]);
        if ($mahasiswa) {
            Alert::success('Berhasil', 'Data diri berhasil diubah!');
            return redirect()->route('data-diri.index');
        } else {
            Alert::error('Gagal', 'Data diri gagal diubah!');
            return redirect()->route('data-diri.index');
        }
    }
}
