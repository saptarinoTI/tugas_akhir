<?php

namespace App\Http\Controllers\Show;

use App\Http\Controllers\Controller;
use App\Models\Pendadaran;
use App\Models\ProposalTA;
use App\Models\SeminarHasil;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function proposal($id)
    {
        $proposal = ProposalTA::findOrFail($id);
        return view('show.proposal', compact('proposal'));
    }

    public function seminar($id)
    {
        $seminar = SeminarHasil::findOrFail($id);
        return view('show.seminar', compact('seminar'));
    }

    public function pendadaran($id)
    {
        $pendadaran = Pendadaran::findOrFail($id);
        return view('show.pendadaran', compact('pendadaran'));
    }
}
