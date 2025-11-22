<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Member;
use App\Models\Photo;
use App\Models\ContactMessage;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // Ambil kategori terbaru + foto
        $latestPhotos = Category::with('photos')
            ->latest()
            ->take(3)
            ->get();

        // Ambil member yang ditampilkan
        $members = Member::orderBy('display_order')
            ->take(30)
            ->get();

        // Ambil testimoni terpilih
        $testimonials = ContactMessage::where('is_featured', true)
            ->latest()
            ->take(3)
            ->get();

        // ====== AUTO STATS ======
        $totalMembers      = Member::count();
        $totalCategories   = Category::count();
        $totalPhotos       = \App\Models\Photo::count();
        $totalTestimonials = ContactMessage::where('is_featured', true)->count();


        return view('pages.home', compact(
            'latestPhotos',
            'members',
            'testimonials',
            'totalMembers',
            'totalCategories',
            'totalPhotos',
            'totalTestimonials'
        ));
    }
}
