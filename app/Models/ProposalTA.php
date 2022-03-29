<?php

namespace App\Models;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Pendadaran;
use App\Models\SeminarHasil;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalTA extends Model
{
    use HasFactory;
    protected $table = 'proposalta';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'integer';
    protected $fillable = [
        'id', 'mahasiswa_nim', 'file_satu', 'file_dua', 'file_tiga', 'judul_satu', 'judul_dua', 'judul_tiga', 'tgl_acc', 'dosen_id_satu', 'dosen_id_dua', 'judul_ta', 'status', 'keterangan'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_nim', 'nim');
    }
    public function dosen_satu()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id_satu', 'id');
    }
    public function dosen_dua()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id_dua', 'id');
    }
    public function semhas()
    {
        return $this->hasMany(SeminarHasil::class, 'proposalta_id', 'id');
    }
    public function pendadaran()
    {
        return $this->hasOne(Pendadaran::class, 'proposalta_id', 'id');
    }
}
