<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        $leaders = Member::whereIn('position', ['komisaris', 'sekretaris', 'bendahara'])
            ->orderBy('display_order')
            ->get();

        $totalMembers = Member::count();

        return view('pages.about', compact('leaders', 'totalMembers'));
    }
}
