<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Http\Traits\FileTrait;
use App\Models\Mahasiswa;
use App\Models\Pendadaran;
use App\Models\ProposalTA;
use App\Models\SeminarHasil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class PendadaranController extends Controller
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
        $seminar = SeminarHasil::where('mahasiswa_nim', '=', $nim)->first();
        if ($mahasiswa == null) {
            Alert::warning('Lengkapi data diri terlebih dahulu!');
            return redirect()->route('data-diri.index');
        }
        if ($seminar) {
            $statusSeminarSelesai = $seminar->status == 'selesai';
            $statusSeminar = $seminar->status == 'diterima';
            if ($statusSeminar || $statusSeminarSelesai) {
                $pendadaran = Pendadaran::where('proposalta_id', '=', $proposal->id)->first();
                return view('mahasiswa.data.pendadaran.index', compact('seminar', 'pendadaran', 'proposal'));
            } else {
                Alert::warning('Status Seminar Hasil belum selesai, silahkan selesaikan terlebih dahulu!');
                return redirect()->route('seminar.index');
            }
        } else {
            Alert::warning('Selesaikan Seminar Hasil terlebih dahulu!');
            return redirect()->route('seminar.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nim = auth()->user()->id;
        $proposal = ProposalTA::where('mahasiswa_nim', '=', $nim)->first();
        return view('mahasiswa.data.pendadaran.create', compact('proposal'));
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
            'mimes' => 'File :attribute harus berupa jpeg, jpg dan png.',
            'image' => 'File :attribute harus berupa gambar.',
        ];
        $request->validate([
            'id' => 'required|unique:pendadaran,id',
            'proposal_id' => 'required',
            'nim' => 'required',
            'krs' => 'required|file|max:1024|mimetypes:application/pdf',
            'transkip_nilai' => 'required|file|max:1024|mimetypes:application/pdf',
            'lmbr_konsultasi' => 'required|file|max:1024|mimetypes:application/pdf',
            'bebas_perkuliahan' => 'required|file|max:1024|mimetypes:application/pdf',
            'bebas_keuangan' => 'required|file|max:1024|mimetypes:application/pdf',
            'bebas_perpus' => 'required|file|max:1024|mimetypes:application/pdf',
            'bebas_lab' => 'required|file|max:1024|mimetypes:application/pdf',
            'act_program' => 'required|file|max:1024|mimetypes:application/pdf',
            'komp_lab' => 'required|file|max:1024|mimetypes:application/pdf',
            'toefl' => 'required|file|max:1024|mimetypes:application/pdf',
            'ijazah_terakhir' => 'required|file|max:1024|mimetypes:application/pdf',
            'ktp' => 'required|file|max:1024|mimetypes:application/pdf',
            'akte_kelahiran' => 'required|file|max:1024|mimetypes:application/pdf',
            'foto' => 'required|file|max:1024|mimetypes:image/jpeg,image/jpg,image/png',
            'judul_ta' => 'required',
        ], $messages);
        $nim = $request->nim;
        $file = new Pendadaran();
        $file->id = $request->id;
        $file->proposalta_id = $request->proposal_id;
        $file->mahasiswa_nim = $nim;
        $file->krs = $this->upload($request, 'krs', 'pendadaran/krs', $nim);
        $file->transkip_nilai = $this->upload($request, 'transkip_nilai', 'pendadaran/transkip_nilai', $nim);
        $file->lmbr_konsultasi = $this->upload($request, 'lmbr_konsultasi', 'pendadaran/lmbr_konsultasi', $nim);
        $file->bebas_perkuliahan = $this->upload($request, 'bebas_perkuliahan', 'pendadaran/bebas_perkuliahan', $nim);
        $file->bebas_keuangan = $this->upload($request, 'bebas_keuangan', 'pendadaran/bebas_keuangan', $nim);
        $file->bebas_perpus = $this->upload($request, 'bebas_perpus', 'pendadaran/bebas_perpus', $nim);
        $file->bebas_lab = $this->upload($request, 'bebas_lab', 'pendadaran/bebas_lab', $nim);
        $file->act_program = $this->upload($request, 'act_program', 'pendadaran/act_program', $nim);
        $file->komp_lab = $this->upload($request, 'komp_lab', 'pendadaran/komp_lab', $nim);
        $file->toefl = $this->upload($request, 'toefl', 'pendadaran/toefl', $nim);
        $file->ijazah_terakhir = $this->upload($request, 'ijazah_terakhir', 'pendadaran/ijazah_terakhir', $nim);
        $file->ktp = $this->upload($request, 'ktp', 'pendadaran/ktp', $nim);
        $file->akte_kelahiran = $this->upload($request, 'akte_kelahiran', 'pendadaran/akte_kelahiran', $nim);
        $file->foto = $this->upload($request, 'foto', 'pendadaran/foto', $nim);
        $file->judul_ta = strtolower(htmlspecialchars($request->judul_ta));
        $file->status = 'dikirim';
        $file->keterangan = 'silahkan bertemu bagian prodi teknik informatika untuk memberikan berkas tugas akhir yang sudah disetujui oleh dosen pembimbing. sebanyak 4 rangkap (1 rangkap asli).';

        $file->save();
        Alert::success('Berhasil', 'Data pendaftaran pendadaran berhasil ditambahkan!');
        return redirect()->route('pendadaran.index');
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
        return view('show.pendadaran', compact('pendadaran'));
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
        return view('mahasiswa.data.pendadaran.edit', compact('pendadaran'));
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
            'mimes' => 'File :attribute harus berupa jpeg, jpg dan png.',
            'image' => 'File :attribute harus berupa gambar.',
        ];
        $request->validate([
            'krs' => 'file|max:1024|mimetypes:application/pdf',
            'transkip_nilai' => 'file|max:1024|mimetypes:application/pdf',
            'lmbr_konsultasi' => 'file|max:1024|mimetypes:application/pdf',
            'bebas_perkuliahan' => 'file|max:1024|mimetypes:application/pdf',
            'bebas_keuangan' => 'file|max:1024|mimetypes:application/pdf',
            'bebas_perpus' => 'file|max:1024|mimetypes:application/pdf',
            'bebas_lab' => 'file|max:1024|mimetypes:application/pdf',
            'act_program' => 'file|max:1024|mimetypes:application/pdf',
            'komp_lab' => 'file|max:1024|mimetypes:application/pdf',
            'toefl' => 'file|max:1024|mimetypes:application/pdf',
            'ijazah_terakhir' => 'file|max:1024|mimetypes:application/pdf',
            'ktp' => 'file|max:1024|mimetypes:application/pdf',
            'akte_kelahiran' => 'file|max:1024|mimetypes:application/pdf',
            'foto' => 'max:1024|image|mimes:jpeg,png,jpg',
            'judul_ta' => 'required',
        ], $messages);
        $filePendadaran = Pendadaran::findOrFail($id);
        $nim = $filePendadaran->mahasiswa_nim;
        if ($request->hasFile('krs')) {
            File::delete('storage/' . $filePendadaran->krs);
            $filePendadaran->krs = $this->upload($request, 'krs', 'pendadaran/krs', $nim);
            $filePendadaran->update(['krs' => $filePendadaran->krs]);
        }
        if ($request->hasFile('transkip_nilai')) {
            File::delete('storage/' . $filePendadaran->transkip_nilai);
            $filePendadaran->transkip_nilai = $this->upload($request, 'transkip_nilai', 'pendadaran/transkip_nilai', $nim);
            $filePendadaran->update(['transkip_nilai' => $filePendadaran->transkip_nilai]);
        }
        if ($request->hasFile('lmbr_konsultasi')) {
            File::delete('storage/' . $filePendadaran->lmbr_konsultasi);
            $filePendadaran->lmbr_konsultasi = $this->upload($request, 'lmbr_konsultasi', 'pendadaran/lmbr_konsultasi', $nim);
            $filePendadaran->update(['lmbr_konsultasi' => $filePendadaran->lmbr_konsultasi]);
        }
        if ($request->hasFile('bebas_perkuliahan')) {
            File::delete('storage/' . $filePendadaran->bebas_perkuliahan);
            $filePendadaran->bebas_perkuliahan = $this->upload($request, 'bebas_perkuliahan', 'pendadaran/bebas_perkuliahan', $nim);
            $filePendadaran->update(['bebas_perkuliahan' => $filePendadaran->bebas_perkuliahan]);
        }
        if ($request->hasFile('bebas_keuangan')) {
            File::delete('storage/' . $filePendadaran->bebas_keuangan);
            $filePendadaran->bebas_keuangan = $this->upload($request, 'bebas_keuangan', 'pendadaran/bebas_keuangan', $nim);
            $filePendadaran->update(['bebas_keuangan' => $filePendadaran->bebas_keuangan]);
        }
        if ($request->hasFile('bebas_perpus')) {
            File::delete('storage/' . $filePendadaran->bebas_perpus);
            $filePendadaran->bebas_perpus = $this->upload($request, 'bebas_perpus', 'pendadaran/bebas_perpus', $nim);
            $filePendadaran->update(['bebas_perpus' => $filePendadaran->bebas_perpus]);
        }
        if ($request->hasFile('bebas_lab')) {
            File::delete('storage/' . $filePendadaran->bebas_lab);
            $filePendadaran->bebas_lab = $this->upload($request, 'bebas_lab', 'pendadaran/bebas_lab', $nim);
            $filePendadaran->update(['bebas_lab' => $filePendadaran->bebas_lab]);
        }
        if ($request->hasFile('act_program')) {
            File::delete('storage/' . $filePendadaran->act_program);
            $filePendadaran->act_program = $this->upload($request, 'act_program', 'pendadaran/act_program', $nim);
            $filePendadaran->update(['act_program' => $filePendadaran->act_program]);
        }
        if ($request->hasFile('komp_lab')) {
            File::delete('storage/' . $filePendadaran->komp_lab);
            $filePendadaran->komp_lab = $this->upload($request, 'komp_lab', 'pendadaran/komp_lab', $nim);
            $filePendadaran->update(['komp_lab' => $filePendadaran->komp_lab]);
        }
        if ($request->hasFile('toefl')) {
            File::delete('storage/' . $filePendadaran->toefl);
            $filePendadaran->toefl = $this->upload($request, 'toefl', 'pendadaran/toefl', $nim);
            $filePendadaran->update(['toefl' => $filePendadaran->toefl]);
        }
        if ($request->hasFile('ijazah_terakhir')) {
            File::delete('storage/' . $filePendadaran->ijazah_terakhir);
            $filePendadaran->ijazah_terakhir = $this->upload($request, 'ijazah_terakhir', 'pendadaran/ijazah_terakhir', $nim);
            $filePendadaran->update(['ijazah_terakhir' => $filePendadaran->ijazah_terakhir]);
        }
        if ($request->hasFile('ktp')) {
            File::delete('storage/' . $filePendadaran->ktp);
            $filePendadaran->ktp = $this->upload($request, 'ktp', 'pendadaran/ktp', $nim);
            $filePendadaran->update(['ktp' => $filePendadaran->ktp]);
        }
        if ($request->hasFile('akte_kelahiran')) {
            File::delete('storage/' . $filePendadaran->akte_kelahiran);
            $filePendadaran->akte_kelahiran = $this->upload($request, 'akte_kelahiran', 'pendadaran/akte_kelahiran', $nim);
            $filePendadaran->update(['akte_kelahiran' => $filePendadaran->akte_kelahiran]);
        }
        if ($request->hasFile('foto')) {
            File::delete('storage/' . $filePendadaran->foto);
            $filePendadaran->foto = $this->upload($request, 'foto', 'pendadaran/foto', $nim);
            $filePendadaran->update(['foto' => $filePendadaran->foto]);
        }
        $filePendadaran->status = 'dikirim';
        $filePendadaran->keterangan = 'silahkan bertemu bagian prodi teknik informatika untuk memberikan berkas tugas akhir yang sudah ditanda tangani oleh dosen pembimbing. sebanyak 4 rangkap (1 rangkap asli).';
        $filePendadaran->updated_at = date(now());
        $filePendadaran->save();

        Alert::success('Berhasil', 'Data pendaftaran pendadaran berhasil diperbaharui!');
        return redirect()->route('pendadaran.index');
    }
}
