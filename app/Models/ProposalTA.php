<?php

namespace App\Models;

use App\Models\Dosen\Dosen;
use App\Models\Mahasiswa;
use App\Models\Pendadaran\Pendadaran;
use App\Models\Seminar\Seminar;
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
        'id', 'mahasiswa_nim', 'file_satu', 'file_dua', 'file_tiga', 'tgl_acc', 'dosen_id_satu', 'dosen_id_dua', 'judul_ta', 'status', 'keterangan'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_nim', 'nim');
    }
    public function dosen_satu()
    {
        return $this->belongsTo('App\Models\Dosen', 'dosen_id_satu', 'id');
    }
    public function dosen_dua()
    {
        return $this->belongsTo('App\Models\Dosen', 'dosen_id_dua', 'id');
    }
    public function semhas()
    {
        return $this->hasMany('App\Models\SeminarHasil', 'proposalta_id', 'id');
    }
    public function pendadaran()
    {
        return $this->hasOne('App\Models\Pendadaran', 'proposalta_id', 'id');
    }
}
