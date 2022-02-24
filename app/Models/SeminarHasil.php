<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeminarHasil extends Model
{
    use HasFactory;
    protected $table = 'semhas';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'bigInteger';
    protected $fillable = [
        'id', 'proposalta_id', 'mahasiswa_nim', 'krs', 'transkip_nilai', 'laporan_kp', 'kartu_kuning', 'sk_keuangan', 'lmbr_konsultasi', 'judul_ta', 'status', 'tgl_acc', 'keterangan'
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
