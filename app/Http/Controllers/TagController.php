<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    public function fetchTag(Request $request){
        $tags =  Tag::where("tag_name", "LIKE", "%" . $request->tag . "%")
            ->withCount('activities')
            ->limit(5)
            ->get(['id', 'tag_name', 'activities_count'])
            ->makeHidden(['created_at', 'updated_at',]);

        return response()->json(["message" => "Sukses", "data" => $tags]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'tag' => "required|unique:tags,tag_name|max:100"
        ]);

        if($validator->passes()){
            $tag = Tag::create([
                "tag_name" => $request->tag,
            ]);
    
            return response()->json(["tag" => ["id" => $tag->id, "name" => $tag->tag_name]]);
        }

        return response()->json(["errors" => $validator->errors()], 422);

    }
}
