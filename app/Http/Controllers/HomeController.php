<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Member;
use App\Models\ContactMessage;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $latestPhotos = Category::with('photos')->latest()->take(3)->get();
        $members = Member::orderBy('display_order')->take(6)->get();
        $testimonials = ContactMessage::featured()->latest()->take(3)->get();

        return view('pages.home', compact('latestPhotos', 'members', 'testimonials'));
    }
}
