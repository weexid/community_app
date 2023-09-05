<?php

namespace App\Repository\Article;

use App\Http\Requests\Article\UpdateRequest;
use App\Models\Activity;
use App\Repository\Article\ArticleRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleRepository implements ArticleRepositoryInterface {
    public function updateArticle(Activity $activity, UpdateRequest $request)
    {
        if($activity->title !== $request['title']){
            $activity->title = $request['title'];
            $activity->slug = Str::slug($request['title']);
        }

        $activity->description = $request['description'];
        
        // update article
        $article = $activity->article();
        if($article && $request['content']){
            $article->update([
                'content' => $request['content'],
            ]);
        }

        // jika terdapat tag yg dikirim maka update tag
        $tags = $request['tags'];
        if($tags !== null && count($tags) > 0) {
            $activity->tags()->sync([]);
            $activity->tags()->attach($tags);
        }

        // update thumbnail
        $file = $request->file('thumbnail');
        $newFileName = '';
        if($file){
            // cari file name saat ini pada activity->thumbnail
            $oldFileName = $activity->thumbnail;

            // cek pada storage apakah nama file tersebut ada?
            if($oldFileName && Storage::disk('public')->exists('images/' . $oldFileName)){
                // jika ada hapus file berdasarkan nama filenya
                Storage::disk('public')->delete('images/'.$oldFileName);    
            }

            // hasFile name pada file yang di upload  dan simpen ke newFileName variabel
            $newFileName = $file->hashName();

            // Store image as new file name ke storage/app/public/images
            $file->storeAs('public/images/', $newFileName, 'local');
            
            // simpan ke database
            $activity->thumbnail = $newFileName;

        }

        
        $activity->save();
    }
}