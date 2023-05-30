<?php

namespace App\Http\Controllers;

use App\Models\ClubActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClubActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function fetchActivity(){
        $activity = ClubActivity::with(['club' => function ($query) {
            $query->select('id', 'club_title', 'slug');
            // jika select dari relasi harus sertakan PK (id)
        }])
            ->orderBy('id', 'desc')
            ->paginate(6);

        // setiap collection dari content akan di format non html tag, dan panjang karakter <= 150 words
        $activity->each(function ($activity) {
            $activity->content = strip_tags($activity->content);
            $activity->content = Str::limit($activity->content, 150);
        });

        $activityData = $activity->toArray();

        return response()->json($activityData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ClubActivity $clubActivity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClubActivity $clubActivity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClubActivity $clubActivity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClubActivity $clubActivity)
    {
        //
    }
}
