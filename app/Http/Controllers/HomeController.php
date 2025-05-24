<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Member;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $latestPhotos = Category::with(['photos' => function ($query) {
            $query->latest()->take(6);
        }])->take(3)->get();

        $members = Member::orderBy('display_order')
            ->where('position', 'komisaris')
            ->orWhere('position', 'bendahara')
            ->orWhere('position', 'sekretaris')
            ->take(3)
            ->get();

        return view('pages.home', [
            'latestPhotos' => $latestPhotos,
            'members' => $members,
        ]);
    }
}
