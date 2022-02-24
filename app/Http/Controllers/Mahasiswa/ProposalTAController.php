<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Http\Traits\FileTrait;
use App\Models\Mahasiswa;
use App\Models\ProposalTA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ProposalTAController extends Controller
{
    use FileTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nim = Auth::user()->id;
        $mahasiswa = Mahasiswa::where('nim', '=', $nim)->first();
        if ($mahasiswa == null) {
            toast('Lengkapi data diri terlebih dahulu!', 'warning', 'top-right');
            return redirect()->route('mahasiswa.index');
        } else {
            $proposal = ProposalTA::where('mahasiswa_nim', '=', $nim)->first();
            return view('mahasiswa.data.proposalta.index', compact('mahasiswa', 'proposal'));
        }
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
        $messages = [
            'required' => ':Attribute wajib diisi.',
            'max' => ':Attribute maksimal 1MB',
            'mimetypes' => ':Attribute wajib berupa pdf',
        ];
        $request->validate([
            'id' => 'required|unique:proposalta,id',
            'nim' => 'required|unique:proposalta,mahasiswa_nim',
            'file_satu' => 'required|file|max:1024|mimetypes:application/pdf',
            'file_dua' => 'file|max:1024|mimetypes:application/pdf',
            'file_tiga' => 'file|max:1024|mimetypes:application/pdf',
        ], $messages);
        $proposal = new ProposalTA();
        $proposal->id = $request->id;
        $proposal->mahasiswa_nim = $request->nim;
        $proposal->file_satu = $this->upload($request, 'file_satu', 'proposal/file_satu', $request->nim);
        if ($request->file_dua != null) {
            $proposal->file_dua = $this->upload($request, 'file_dua', 'proposal/file_dua', $request->nim);
        }
        if ($request->file_tiga != null) {
            $proposal->file_tiga = $this->upload($request, 'file_tiga', 'proposal/file_tiga', $request->nim);
        }
        $proposal->keterangan = "pendaftaran telah dikirim, silahkan menunggu konfirmasi dari prodi.";
        $result = $proposal->save();
        if ($result) {
            toast('Ajuan proposal tugas akhir berhasil.', 'success', 'top-right');
            return redirect()->route('proposal.index');
        }
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
        return view('mahasiswa.data.proposalta.show', compact('proposal'));
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
            'id' => 'required',
            'nim' => 'required',
            'file_satu' => 'file|max:1024|mimetypes:application/pdf',
            'file_dua' => 'file|max:1024|mimetypes:application/pdf',
            'file_tiga' => 'file|max:1024|mimetypes:application/pdf',
        ]);
        $proposal = ProposalTA::findOrFail($id);
        if ($request->file_satu != null) {
            $proposal->file_satu = $this->upload($request, 'file_satu', 'proposal/file_satu', $request->nim);
        }
        if ($request->file_dua != null) {
            $proposal->file_dua = $this->upload($request, 'file_dua', 'proposal/file_dua', $request->nim);
        }
        if ($request->file_tiga != null) {
            $proposal->file_tiga = $this->upload($request, 'file_tiga', 'proposal/file_tiga', $request->nim);
        }
        if ($proposal->dosen_id_satu != null) {
            $proposal->status = "diperiksa";
        } else {
            $proposal->status = "dikirim";
        }
        $proposal->keterangan = "pendaftaran telah dikirim, silahkan menunggu konfirmasi dari prodi.";
        $result = $proposal->save();
        if ($result) {
            toast('Ajuan proposal tugas akhir berhasil dirubah.', 'success', 'top-right');
            return redirect()->route('proposal.index');
        }
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
}
