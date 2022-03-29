<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Http\Traits\FileTrait;
use App\Models\Mahasiswa;
use App\Models\ProposalTA;
use App\Models\SeminarHasil;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;

class SeminarHasilController extends Controller
{
    use FileTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nim = auth()->user()->id;
        $mahasiswa = Mahasiswa::where('nim', '=', $nim)->first();
        $proposal = ProposalTA::where('mahasiswa_nim', '=', $nim)->first();
        if ($mahasiswa == null) {
            toast('Lengkapi data diri terlebih dahulu!', 'warning', 'top-right');
            return redirect()->route('mahasiswa.index');
        }
        if ($proposal) {
            $statusProposal = $proposal->status == 'diterima';
            if ($statusProposal) {
                $noSeminar = date('Y') . $nim;
                $seminar = SeminarHasil::where('proposalta_id', '=', $proposal->id)->first();
                return view('mahasiswa.data.seminarhasil.index', compact('proposal', 'seminar', 'noSeminar'));
            } else {
                toast('Selesaikan proposal tugas akhir terlebih dahulu!', 'warning', 'top-right');
                return redirect()->route('proposal.index');
            }
        } else {
            toast('Selesaikan proposal tugas akhir terlebih dahulu!', 'warning', 'top-right');
            return redirect()->route('proposal.index');
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
            'required' => 'Silahkan upload file terlebih dahulu!',
            'mimetypes' => 'Format file yang diperbolehkan adalah .pdf,',
            'max' => 'Ukuran file maksimal adalah 1MB',
        ];
        $request->validate([
            'id' => 'required|unique:semhas,id',
            'proposal_id' => 'required',
            'nim' => 'required',
            'krs' => 'required|file|max:1024|mimetypes:application/pdf',
            'transkip_nilai' => 'required|file|max:1024|mimetypes:application/pdf',
            'laporan_kp' => 'required|file|max:1024|mimetypes:application/pdf',
            'kartu_kuning' => 'required|file|max:1024|mimetypes:application/pdf',
            'sk_keuangan' => 'required|file|max:1024|mimetypes:application/pdf',
            'lmbr_konsultasi' => 'required|file|max:1024|mimetypes:application/pdf',
            'judul_ta' => 'required',
        ], $messages);
        $nim = $request->nim;
        $seminar_hasil = new SeminarHasil();
        $seminar_hasil->id = $request->id;
        $seminar_hasil->proposalta_id = $request->proposal_id;
        $seminar_hasil->mahasiswa_nim = $nim;
        $seminar_hasil->krs = $this->upload($request, 'krs', 'semhas/krs', $nim);
        $seminar_hasil->transkip_nilai = $this->upload($request, 'transkip_nilai', 'semhas/transkip_nilai', $nim);
        $seminar_hasil->laporan_kp = $this->upload($request, 'laporan_kp', 'semhas/laporan_kp', $nim);
        $seminar_hasil->kartu_kuning = $this->upload($request, 'kartu_kuning', 'semhas/kartu_kuning', $nim);
        $seminar_hasil->sk_keuangan = $this->upload($request, 'sk_keuangan', 'semhas/sk_keuangan', $nim);
        $seminar_hasil->lmbr_konsultasi = $this->upload($request, 'lmbr_konsultasi', 'semhas/lmbr_konsultasi', $nim);
        $seminar_hasil->judul_ta = $request->judul_ta;
        $seminar_hasil->keterangan = "silahkan bertemu prodi, untuk memberikan berkas tugas akhir yang sudah ditanda tangani oleh dosen pembimbing. sebanyak 1 rangkap asli + 3 rangkap fotocopy.";
        $seminar_hasil->status = 'dikirim';
        $seminar = $seminar_hasil->save();

        if ($seminar) {
            Alert::success('Berhasil', 'Data pendaftaran seminar hasil berhasil ditambahkan!',);
            return redirect()->route('seminar-hasil.index');
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
        $seminar = SeminarHasil::findOrFail($id);
        return view('mahasiswa.data.seminarhasil.show', compact('seminar'));
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
        $messages = [
            'required' => 'Silahkan upload file terlebih dahulu!',
            'mimetypes' => 'Format file yang diperbolehkan adalah .pdf,',
            'max' => 'Ukuran file maksimal adalah 1MB',
        ];
        $request->validate([
            'krs' => 'file|max:1024|mimetypes:application/pdf',
            'transkip_nilai' => 'file|max:1024|mimetypes:application/pdf',
            'laporan_kp' => 'file|max:1024|mimetypes:application/pdf',
            'kartu_kuning' => 'file|max:1024|mimetypes:application/pdf',
            'sk_keuangan' => 'file|max:1024|mimetypes:application/pdf',
            'lmbr_konsultasi' => 'file|max:1024|mimetypes:application/pdf',
            'judul_ta' => 'required',
        ], $messages);
        $seminar = SeminarHasil::findOrFail($id);
        $nim = $seminar->mahasiswa_nim;
        if ($request->hasFile('krs')) {
            File::delete('storage/' . $seminar->krs);
            $file_request = $request->file('krs');
            $extension = $file_request->extension();
            $save_file = $file_request->storeAs('semhas/krs', $nim . '.' . $extension, 'public');
            $seminar->update(['krs' => $save_file]);
        }
        if ($request->hasFile('transkip_nilai')) {
            File::delete('storage/' . $seminar->transkip_nilai);
            $file_request = $request->file('transkip_nilai');
            $extension = $file_request->extension();
            $save_file = $file_request->storeAs('semhas/transkip_nilai', $nim . '.' . $extension, 'public');
            $seminar->update(['transkip_nilai' => $save_file]);
        }
        if ($request->hasFile('laporan_kp')) {
            File::delete('storage/' . $seminar->laporan_kp);
            $file_request = $request->file('laporan_kp');
            $extension = $file_request->extension();
            $save_file = $file_request->storeAs('semhas/laporan_kp', $nim . '.' . $extension, 'public');
            $seminar->update(['laporan_kp' => $save_file]);
        }
        if ($request->hasFile('kartu_kuning')) {
            File::delete('storage/' . $seminar->kartu_kuning);
            $file_request = $request->file('kartu_kuning');
            $extension = $file_request->extension();
            $save_file = $file_request->storeAs('semhas/kartu_kuning', $nim . '.' . $extension, 'public');
            $seminar->update(['kartu_kuning' => $save_file]);
        }
        if ($request->hasFile('sk_keuangan')) {
            File::delete('storage/' . $seminar->sk_keuangan);
            $file_request = $request->file('sk_keuangan');
            $extension = $file_request->extension();
            $save_file = $file_request->storeAs('semhas/sk_keuangan', $nim . '.' . $extension, 'public');
            $seminar->update(['sk_keuangan' => $save_file]);
        }
        if ($request->hasFile('lmbr_konsultasi')) {
            File::delete('storage/' . $seminar->lmbr_konsultasi);
            $file_request = $request->file('lmbr_konsultasi');
            $extension = $file_request->extension();
            $save_file = $file_request->storeAs('semhas/lmbr_konsultasi', $nim . '.' . $extension, 'public');
            $seminar->update(['lmbr_konsultasi' => $save_file]);
        }
        $seminar->judul_ta = $request->judul_ta;
        $seminar->status = 'dikirim';
        $seminar->keterangan = 'silahkan bertemu bagian prodi teknik informatika untuk memberikan berkas tugas akhir yang sudah ditanda tangani oleh dosen pembimbing. sebanyak 1 rangkap asli + 3 rangkap fotocopy.';
        $seminar->updated_at = date(now());
        $seminar->save();
        Alert::success('Berhasil', 'Data seminar berhasil diubah!');
        return redirect()->route('seminar-hasil.index');
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
