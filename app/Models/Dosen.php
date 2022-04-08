<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProposalTA;

class Dosen extends Model
{
    use HasFactory;
    protected $table = 'dosen';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'bigInteger';

    protected $fillable = [
        'id', 'nama'
    ];
    public function proposal()
    {
        return $this->hasMany(ProposalTA::class);
    }
}
