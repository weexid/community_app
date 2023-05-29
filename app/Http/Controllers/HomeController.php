<?php

namespace App\Http\Controllers;

use App\Models\MainCarousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index () {

        $carousel = MainCarousel::get();

        return Inertia::render('Home/Index', [
            'carousel' => $carousel,
        ]);
    }

    public function getLocalImagePath($filename) {
        $path = Storage::url('public/images' . $filename);

        if (Storage::exists('public/images' . $filename)) {
            // return $path;
            return response()->json(['message' => 'File Found !']);
        }

        return response()->json(['message' => 'File not found.'], 404);
    }
}
