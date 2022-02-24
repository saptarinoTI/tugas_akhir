<?php

namespace App\Models;

use App\Models\Dosen\Dosen;
use App\Models\Pembimbing\Pembimbing;
use App\Models\Pendadaran\Pendadaran;
use App\Models\Proposal\Proposal;
use App\Models\Seminar\Seminar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $keyType = 'integer';

    protected $fillable = [
        'nim', 'nama', 'no_hp', 'tpt_lahir', 'tgl_lahir', 'alamat',
    ];

    public function proposal()
    {
        return $this->hasOne(ProposalTA::class, 'mahasiswa_nim', 'nim');
    }

    // public function proposal_satu()
    // {
    //     return $this->hasOne(ProposalTA::class, 'mahasiswa_nim', 'nim');
    // }

    // public function proposal_dua()
    // {
    //     return $this->hasOne(ProposalTA::class, 'mahasiswa_nim', 'nim');
    // }
}
