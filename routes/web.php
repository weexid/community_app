<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ClubActivityController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//         'can' => [
//             'isAdmin' => Gate::allows('isAdmin'),
//         ],
//     ]);
// });

Route::get('/', [HomeController::class, 'index']);

Route::get('/paginate/activities', [ClubActivityController::class, 'fetchActivity']);

Route::get('/search', [HomeController::class, 'search']);

Route::prefix('club')->group(function() {
    Route::get('/', [ClubController::class, 'index'])->name('clubs.index');
    Route::get('/create', [ClubController::class, 'create'])->name('club.create');
    Route::post('/store', [ClubController::class, 'store'])->name('club.store');
    Route::get('/{club}', [ClubController::class, 'show'])->name('club');
    Route::get('/edit/{club}', [ClubController::class, 'edit'])->name('club.edit');
    Route::put('/update/{club}', [ClubController::class, 'update'])->name('club.update');

});

Route::prefix('activity')->group(function() {
    Route::get('/', [ActivityController::class, 'index'])->name('activity.index');
    Route::get('/videos', [ActivityController::class, 'render_videos'])->name('acvitiy.videos');
    Route::get('/{activity:slug}', [ActivityController::class, 'show'])->name('activity.show');
    
    // create articles
    Route::get('/create', [ActivityController::class, 'create'])->name('activity.create');
    Route::post('/store', [ActivityController::class, 'store'])->name('activity.store');
    
    // create videos
    Route::get('/create-video', [ActivityController::class, 'create_video'])->name('activity.create.video');
    Route::post('/store-video', [ActivityController::class, 'store_video'])->name('activity.store.video');
});

Route::prefix('tag')->group(function() {
    Route::get('/{tag:tag_name}', [TagController::class, 'fetchTag'])->name('tag.fetch');
    Route::post('/store', [TagController::class, 'store'])->name('tag.store');
});


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified', 'admin.pres.only'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
