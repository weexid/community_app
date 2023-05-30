<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\ClubActivity;
use App\Models\MainCarousel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index () {

        $carousel = MainCarousel::get();

        $club = Club::select('club_title','club_tagline', 'slug', 'image', 'image_url' )
            ->orderBy('id', 'desc')
            ->take(4)
            ->get();


        $activity = ClubActivity::with(['club' => function ($query) {
            $query->select('id', 'club_title', 'slug');
            // jika select dari relasi harus sertakan PK (id)
        }])
            ->orderBy('id', 'desc')
            ->take(6)
            ->get();
        
        // setiap collection dari content akan di format non html tag, dan panjang karakter <= 150 words
        $activity->each(function($activity) {
            $activity->content = strip_tags($activity->content);
            $activity->content = Str::limit($activity->content, 150);
        });

        // $activityData = $activity->toArray();

        // return dd($activityData);

        return Inertia::render('Home/Index', [
            'carousel' => $carousel,
            'club' => $club,
            'activity' => $activity,
        ]);
    }
}
