<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendadaran extends Model
{
    use HasFactory;
    protected $table = 'pendadaran';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'bigInteger';
    protected $fillable = [
        'id', 'proposalta_id', 'mahasiswa_nim', 'krs', 'transkip_nilai', 'lmbr_konsultasi', 'bebas_perkuliahan', 'bebas_keuangan', 'bebas_perpus', 'bebas_lab', 'act_program', 'komp_lab', 'toefl', 'ijazah_terakhir', 'ktp', 'akte_kelahiran', 'foto', 'status', 'tgl_lulus', 'judul_ta', 'keterangan'
    ];
    public function proposal()
    {
        return $this->belongsTo('App\Models\ProposalTa', 'proposalta_id', 'id');
    }
    public function mahasiswa()
    {
        return $this->belongsTo('App\Models\Mahasiswa', 'mahasiswa_nim', 'nim');
    }
}
