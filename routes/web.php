<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProjectController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\SettingsController;
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

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard',[\App\Http\Controllers\Controller::class,'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['web','auth','check.subscription'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/updateProfileSkills', [\App\Http\Controllers\UserController::class, 'updateProfileSkills'])->name('updateProfileSkills');
    Route::post('/updateProfile', [\App\Http\Controllers\UserController::class, 'updateProfile'])->name('updateProfile');
    Route::post('removeSkill/{skillId}',[\App\Http\Controllers\UserController::class,'removeSkill'])->name('removeSkill');
    Route::post('/account/create', [\App\Http\Controllers\UserController::class, 'createAccount'])->name('account.create');
    Route::get('/account/overview', [\App\Http\Controllers\UserController::class, 'accounts'])->name('account.overview');

    /// Projects
    Route::prefix('projects')->group(function () {
        Route::get('overview', [ProjectController::class, 'index'])->name('project.overview');
        Route::get('add/{uId}', function ($uId) {
            if ($uId != \Illuminate\Support\Facades\Auth::id()){
                abort(404);

            }else{
            return inertia::render('Projects/Add');
            }
        })->name('project.add');
//add
        Route::post('add', [ProjectController::class, 'add'])->name('project.addOne');
        Route::post('delete/{pId}', [ProjectController::class, 'destroy'])->name('project.delete');
        //content
        Route::prefix('content')->group(function (){
            Route::get('show/{pId}', [ContentController::class, 'overview'])->name('content.index');
            Route::get('add/{pId}', [ContentController::class, 'add'])->name('content.add');
            Route::get('add-foto/{pId}', [ContentController::class, 'addFoto'])->name('content.addFoto');
            Route::post('add-foto-store/{pId}', [ContentController::class, 'storeFoto'])->name('content.storeFoto');
//            Route::get('store-foto/', [ContentController::class, 'storeFoto'])->name('content.storeFoto');
            Route::post('add-text/{pId}', [ContentController::class, 'create'])->name('content.create');
            Route::get('/edit-text/{cId}', [ContentController::class, 'edit'])->name('content.edit');
            Route::post('/save-text/{cId}', [ContentController::class, 'save'])->name('content.save');
            Route::post('/delete/{cId}', [ContentController::class, 'destroy'])->name('content.delete');
            Route::post('/groupDelete/', [ContentController::class, 'groupDelete'])->name('content.groupDelete');
            Route::get('sort',[ContentController::class,'editSort'])->name('content.sort');
        });
    });
    /// Calendar
    Route::prefix('calendar')->group(function () {
        Route::get('index', [EventController::class,'index'])->name('calendar.overview');
        Route::post('add', [EventController::class,'add'])->name('calendar.add');
        Route::post('update/{eId}', [EventController::class,'update'])->name('calendar.update');
        Route::post('remove/{eId}', [EventController::class,'remove'])->name('calendar.remove');
        Route::get('events', [EventController::class,'getEvents'])->name('calendar.get');
    });
    Route::get('/trash', [\App\Http\Controllers\Controller::class, 'trash'])->name('trash');
    Route::post('/groupDelete', [\App\Http\Controllers\Controller::class, 'groupDelete'])->name('trash.groupDelete');
    Route::post('/restore/{pId}', [\App\Http\Controllers\Controller::class, 'restore'])->name('restore');
    Route::post('/force-delete/{pId}', [\App\Http\Controllers\Controller::class, 'forceDelete'])->name('forceDelete');

/// Settings
//Route::prefix('settings')->group(function () {
    Route::get('settings',[SettingsController::class,'settings'])->name('settings.overview');
    Route::post('settings/update-token',[SettingsController::class,'changeToken'])->name('settings.updateToken');
//});
});
Route::get('/test', function (){
    return view('test');
});
Route::get('/testApi',[\App\Http\Controllers\Controller::class,'steamApiTest'])->name('testSteamApi');
require __DIR__ . '/auth.php';
