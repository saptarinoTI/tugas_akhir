<?php

namespace App\Models;

use App\Models\ProposalTA;
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
}
