<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Article;
use App\Models\Club;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // send articles only on activity, and videos will be send with json response
        $articles = Activity::with(['tags:id,tag_name', 'club:id,club_title,slug'])
            ->select('id', 'club_id', 'title', 'slug', 'description', 'thumbnail', 'type', 'description', 'created_at')
            ->where('type', '=', 'article')
            ->orderByDesc('created_at')
            ->paginate(8);

        $articles->each(function ($article){
            $article->description = strip_tags($article->description);
            $article->description = Str::limit($article->description, 100);

            $article->tags = $article->tags->take(2);

            return $article;
        });

        
        $article_proceed = $articles->toArray();

        return Inertia::render('Activity/Index', [
            'articles' => $article_proceed,
            'msg' => $request->message,
        ]);

    }

    public function render_videos(){
        $videos = Activity::with(['video:id,activity_id,video_src', 'tags:id,tag_name', 'club:id,club_title,slug'])
            ->select('id','club_id', 'title', 'thumbnail', 'type', 'created_at')
            ->where('type', '=', 'video')
            ->orderByDesc('created_at')
            ->paginate(8);

        return response()->json($videos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Activity/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'title' => 'required|string|unique:activities,title',
                'description' => 'required|string',
                'thumbnail' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'content' => 'required|string',
                'tags' => 'array',
            ]
        );

        if($validator->passes()){
            $filename = '';
            $file = $request->file('thumbnail');

            if($file){
                $timestamp = time();
                $extention = $file->getClientOriginalExtension();

                $filename = $timestamp.'.'.$extention;

                $file->storeAs('public/images/', $filename, 'local');
            }else{
                $defaultImg = public_path('/default/default.jpeg');
                $filename = time(). '.jpeg';
                $destination = storage_path('app/public/images/'. $filename);

                File::copy($defaultImg, $destination);
                
            }

            // Upload to database
            $user = User::first();
            $club_id = $user->club_id;
            $title = $request->title;
            $slug = Str::slug($request->title);

            
            $activity = Activity::create([
                'club_id' => $club_id,
                'title' => $title,
                'slug' => $slug,
                'description' => $request->description,
                'thumbnail' => $filename, //Ada masalah disini ! ternyata di activity belum
                'type' => 'article',
            ]);

            $activity->article()->create([
                'content' => $request->content,
            ]);

            $activity->tags()->attach($request->tags);

            return response()->json(["message" => "Success Added New Articles"]);
        }

            return response()->json(['errors' => $validator->errors()], 422);
    }

    public function create_video(Request $request){
        return Inertia('Activity/CreateVideo');
    }

    public function store_video(Request $request){
        // validasi request
        $validator = Validator::make($request->all(), [

            'title' => 'required|string|unique:activities,title',
            'description' => 'required|string',
            'ytCode' => 'required|string',
            'tags' => 'array',
        ]);

        if($validator->passes()){
            // params
            $user = User::find(2);
            $club_id = $user->club_id;
            $title = $request->title;
            $slug = Str::slug($title);

            // create new activity
            $activity = Activity::create([
                'club_id' => $club_id,
                'title' => $title,
                'slug' => $slug,
                'description' => $request->description,
                'thumbnail' => $request->ytCode, //Ada masalah disini ! ternyata di activity belum
                'type' => 'video',
            ]);

            // create new video
            $activity->video()->create([
                'video_src' => $request->ytCode,
            ]);

            // insert new tag
            $activity->tags()->attach($request->tags);

            // response
            return response()->json(["message" => "Success Add New Video!"]);
        }

        return response()->json(['errors' => $validator->errors()], 422);

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {   
        return Inertia::render('Activity/Show', [
            'activities' => $activity,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        //
    }
}
