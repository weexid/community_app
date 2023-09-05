<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\Article;
use App\Models\Club;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Support\Str;
use Inertia\Testing\AssertableInertia as Assert;

class UpdateArticleTest extends TestCase
{
    use RefreshDatabase;

    public function test_getUpdateData(): void
    {   
        // Buat club
        $club = Club::create([
                'club_title' => 'Club Melati',
                'club_tagline' => 'Jadilah Sewangi Melati',
                'description' => 'This club is sample purpose only',
                'slug' => Str::slug('Club Melati'),
                'image_url' => 'https://d1vbn70lmn1nqe.cloudfront.net/prod/wp-content/uploads/2022/08/18074743/Jarang-Disadari-Ini-X-Manfaat-Bunga-Melati-bagi-Kecantikan.jpg.webp',
        ]);

        $tag = ['Local Event', 'International Event', 'Charity'];

        for($i = 0; $i < count($tag); $i++){
            Tag::create([
                'tag_name' => $tag[$i],
            ]);
        }

        // Buat Activity
        $activity = Activity::create([
            'club_id' => $club->id,
            'title' => 'Mengunjungi Rumah Hantu',
            'slug' => Str::slug('Mengunjungi Rumah Hantu'),
            'description' => 'Rumah hantu di sungai Buto adalah salah satu objek spiritual terseram di Indonesia',
            'thumbnail' => 'default.jpeg',
            'type' => 'article',
        ]);

        // Buat Artikel berdasarkan activity tersebut
        $activity->article()->create([
            'content' => '[]',
        ]);

        // Tambahkan tag
        $activity->tags()->attach([1, 2, 3]);

        // Kunjungi url edit-artikel/slug
        // echo($activity->slug);
        $response = $this->get("/activity/edit-article/{$activity->slug}");
        
        // ekspektasi mengunjungi komponen Edit-Artikel
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Activity/EditArticle')
            ->has('activity', fn(Assert $page) => $page
                ->where('id', $activity->id)
                ->where('club_id', $activity->club_id)
                ->where('title', $activity->title)
                ->where('slug', $activity->slug)
                ->where('description', $activity->description)
                ->where('thumbnail', $activity->thumbnail)
                ->where('type', $activity->type)
                ->has('tags', $activity->tags->count())
                ->has('article') // Juga periksa bahwa ada properti 'tags'
            )
        );

    }
    /* 
    @test
    */
    public function test_update_article():void {
        // generate data
        $activity = Activity::factory()->has(Article::factory())->create(['title' => 'new title', 'slug' => 'new-title', 'description' => 'new description']);
        
        // siapkan file
        // $file = UploadedFile::fake()->create('example.jpg', 512);

        // siapkan data
        $update_data = [
            'title' => 'new title',
            'description' => 'cool description',
            'thumbnail' => null,
            'tags' => null,
            'content' => "[helloWorld]"
        ];

        // kunjungi route
        $response = $this->put(route('article.update', $activity->slug), $update_data);

        // assert code
        $response->assertStatus(200);


        // assert di database
        $this->assertDatabaseHas('activities', [
            'title' => $update_data['title'],
            'description' => $update_data['description'],
        ]);
        
        $this->assertDatabaseHas('articles', ['content' => $update_data['content']]);

    }

    public function test_update_tags(){
        $tags = Tag::factory(3)->create();
        $activity = Activity::factory()->has(Article::factory())->hasAttached($tags)->create();

        $tag1 = Tag::factory()->create();
        $tag2 = Tag::factory()->create();


        $update_data = [
            'title' => 'new title',
            'description' => 'cool description',
            'thumbnail' => null,
            'tags' => [$tag1->id, $tag2->id],
            'content' => "[helloWorld]"
        ];


        $this->put(route('article.update', $activity->slug), $update_data);

        // assert
        $this->assertDatabaseHas('activity_tags', [
            'activity_id' => $activity->id,
            'tag_id' => $tag1->id,
        ]);

        $this->assertDatabaseHas('activity_tags', [
            'activity_id' => $activity->id,
            'tag_id' => $tag2->id,
        ]);

        $this->assertDatabaseMissing('activity_tags', [
            'activity_id' => $activity->id,
            'tag_id' => $tags->first()->id,
        ]);

        $this->assertDatabaseMissing('activity_tags', [
            'activity_id' => $activity->id,
            'tag_id' => $tags->last()->id,
        ]);
    }

    public function test_update_thumbnail() {
        // Jalankan factory tanpa tags

        // siapkan data update dan gambar
        
        // upload image siapkan image faker

        // ambil nama file yang sudah di transformasi menjadi unik di controller

        // periksa bahwa thumbnail di database == nama file yang telah di transformasi

        // periksa apakah filelama sudah tidak ada di storage

        // periksa apakah filename yang baru sudah ada di storage

        // --------------------------------------------------------------- Harus di cek kembali
        // Jalankan factory untuk membuat artikel
        $activity = Activity::factory()->has(Article::factory())->create(['thumbnail' => 'new-img.jpg']);

        
        // Siapkan data update dan gambar
        $newThumbnail = UploadedFile::fake()->image('new_thumbnail.jpg');
        
        // data
        $update_data = [
            'title' => 'new title',
            'description' => 'cool description',
            'thumbnail' => $newThumbnail,
            'tags' => null,
            'content' => "[]"
        ];

        // Upload gambar dan ambil nama file yang sudah diubah menjadi unik di controller
        $res = $this->put(route('article.update', $activity->slug), $update_data);

        $res->assertStatus(200);

        // cek di database
        $this->assertDatabaseHas('activities', ['id' => $activity->id, 'thumbnail' => $newThumbnail->hashName()]);
        $this->assertDatabaseMissing('activities', ['id' => $activity->id, 'thumbnail' => 'new-img.jpg']);
        
        // cek di storage
        Storage::assertExists('public/images/' . $newThumbnail->hashName());
        Storage::assertMissing('public/images/' . 'new-img.jpg');
    }


    // negative test
    public function test_error_message_show_when_validation_failed(){
        // Buat Activity
        $activity = Activity::factory()->has(Article::factory())->create();

        // siapkan data dengan title kosong
        $data = [
            'title' => null,
            'description' => null,
            'thumbnail' => null,
            'tags' => null,
            'content' => '[]'
        ];
        // buat request put ke end point
        $response = $this->put(route('article.update', $activity->slug), $data);

        // assert error dari reuest validasi ?
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['title' => 'The title field is required.', 'description' => 'The description field is required.']);
    }
}
