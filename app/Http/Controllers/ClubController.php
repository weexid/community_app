<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clubs = Club::select('id', 'club_title', 'slug','image', 'image_url', DB::raw('(SELECT COUNT(*) FROM users WHERE users.club_id = clubs.id) as members_count'))
            ->get();


        return Inertia::render('Club/Index', [
            'clubs' => $clubs
        ]);
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
    public function show(Club $club)
    {   
        $club = $club->load('carousel');
        
        return Inertia::render('Club/DetailClub', [
            'club' => $club,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Club $club)
    {
        $club = $club->load('carousel');

        return Inertia::render('Club/Edit', [
            'club' => $club,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Club $club)
    {
        $title = $request->input('club_title');
        dd($title);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Club $club)
    {
        //
    }
}
