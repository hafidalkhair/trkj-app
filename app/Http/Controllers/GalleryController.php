<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        // Tetap ambil semua (get) agar search & pagination di Alpine.js lancar
        $categories = Category::withCount('photos')
            ->with(['photos' => function ($query) {
                $query->latest();
            }])
            ->latest() 
            ->get(6);

        return view('pages.gallery', [
            'categories' => $categories,
        ]);
    }
}
