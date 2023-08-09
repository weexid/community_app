<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClubRequest;
use App\Http\Requests\UpdateClubRequest;
use App\Models\Club;
use Carbon\Carbon;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use illuminate\Support\Str;

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
        return Inertia::render('Club/Add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClubRequest $request)
    {
        $title = $request->input('club_title');
        $tagline = $request->input('club_tagline');
        $description = $request->input('description');
        $image = $request->file('image');
        $fileName = null;
        $image_url = $request->input('image_url');

        if($request->hasFile('image')){
            $timestamp = time();
            $extension = $image->getClientOriginalExtension();
            $fileName = $timestamp. '.'.$extension;

            $image->storeAs('public/images/', $fileName, 'local');
        }else{
            if($image_url === null){
                // upload default image
                $defaultImg = public_path('/default/default.jpeg');
                $fileName = time(). '.jpeg';
                $destination = storage_path('app/public/images/'. $fileName);

                File::copy($defaultImg, $destination);
            }
        }

        Club::create([
            'club_title' => $title,
            'slug' => Str::slug($title),
            'club_tagline' => $tagline,
            'description' => $description,
            'image' => $fileName,
            'image_url' => $image_url,
        ]);

        return redirect()->route('clubs.index')->with('message', 'Successfully add new club');
    }

    /**
     * Display the specified resource.
     */
    public function show(Club $club)
    {   
        $club = $club->load(['carousel', 'members.role', 'activities']);

        $carousel = $club->carousel->map(function($carousel) {
            return [
                'image' => $carousel->image,
                'image_url' => $carousel->image_url,
                'heading' => $carousel->heading,
                'sub_heading' => $carousel->sub_heading,
                'cta_link' => $carousel->cta_link,
                'cta_text' => $carousel->cta_text,

            ];
        });

        $members = $club->members->map(function($member) {
            return [

                'id' => $member->id,
                'username' => $member->name,
                'email' => $member->name,
                'role' => $member->role->role_name,
            ];
        });

        $activities = $club->activities()->orderBy('title', 'asc')->get()
            ->map(function($activity) {
                $content = strip_tags($activity->content);
                $timestamp = Carbon::createFromFormat('Y-m-d H:i:s', $activity->created_at);

                return [
                    'id' => $activity->id,
                    'title' => $activity->title,
                    'content' => Str::limit($content, 150),
                    'slug' => $activity->slug,
                    'image' => $activity->image,
                    'date' => $timestamp->format('d-m-Y'),
                ];
            });
        
        return Inertia::render('Club/Club', [
            'club' => $club,
            'members' => $members,
            'activities' => $activities,
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
    public function update(UpdateClubRequest $request, Club $club)
    {
     
        $title = $request->validated('club_title');
        $tagline = $request->validated('club_tagline');
        $description = $request->validated('description');
        $club_img_url = $request->validated('image_url');
        $club_img = $request->validated('image');
        
        // validasi club title untuk update slug
        if($club->club_title !== $title){
            $club->club_title = $title;
            $club->slug = Str::slug($title);
        }
        $club->club_tagline = $tagline;
        $club->description = $description;


        if($request->hasFile('image')){
            $club_img_url = null;
            // hapus image yang lama di storage, berdasarkan nama file di database
            $old_img = $club->image;

            $exist = Storage::exists('public/images/'.$old_img);

            if($exist){
                Storage::delete('public/images/'.$old_img);
            }

            // set image_url dalam database menjadi null
            $club->image_url = null;

            // Buat unique file name dengan menambahkan timestamp + extension;
            $timestamp = time();
            $extension = $club_img->getClientOriginalExtension();
            $fileName = $timestamp. '.'.$extension;


            // Simpan image dalam storage dan simpan juga nama file dalam database
            $club_img->storeAs('public/images/', $fileName, 'local');
            $club->image = $fileName;

        }else{
            if($club_img_url){
                // $club_img->replace(null);
                // cek jika terdapat image pada storage berdasarkan nama filenya, jika ada hapus,
                $old_img = $club->image;

                $exist = Storage::exists('public/images/'.$old_img);

                if($exist){
                    Storage::delete('public/images/'.$old_img);
                }

                // set image menjadi null di database,
                $club->image = null;

                // set image_url berdasarkan request
                $club->image_url = $club_img_url;
            }
        }

        // database save
        $club->save();

        return redirect()->route('clubs.index')->with('message', 'Update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Club $club)
    {
        //
    }
}
