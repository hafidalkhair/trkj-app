<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $categories = Category::with(['photos' => function ($query) {
            $query->latest();
        }])->get();

        return view('pages.gallery', [
            'categories' => $categories,
        ]);
    }
}
