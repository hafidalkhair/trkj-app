<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\View\View;

class StructureController extends Controller
{
    public function index(): View
    {
        $leaders = Member::where('position', 'komisaris')
            ->orWhere('position', 'bendahara')
            ->orWhere('position', 'sekretaris')
            ->orderBy('display_order')
            ->get();

        $members = Member::where('position', 'anggota')
            ->orderBy('display_order')
            ->get();

        return view('pages.structure', [
            'leaders' => $leaders,
            'members' => $members,
        ]);
    }
}
