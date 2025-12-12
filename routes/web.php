<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;



Auth::routes();
//home route
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//blogs route
route::resource('blogs', BlogController::class)->middleware('admin');
route::delete('soft_delete/{id}', [BlogController::class, 'Softdelete'])->name('soft.delete')->middleware('admin');
route::get('status', [BlogController::class, 'status'])->name('status')->middleware('admin');
route::get('restore/{id}', [BlogController::class, 'restore'])->name('restore')->middleware('admin');

//categories route
route::resource('categories', CategoryController::class)->middleware('admin');



//هذا ال route للسماح للصورة بالعرض 
Route::get('/blog-image/{filename}', function ($filename) {

    $absolutePath = storage_path('app/private/uploads/' . $filename);
    if (!file_exists($absolutePath)) {
        abort(404);
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $absolutePath);
    finfo_close($finfo);

    return response(file_get_contents($absolutePath), 200)
        ->header('Content-Type', $mimeType);

})->name('blog.image.show');

// راوت الاضافة الى المفضلة

Route::post('/blog/{blog}/favor', [BlogController::class, 'toggleFavor'])
    ->middleware('auth')
    ->name('blog.favor.toggle');


route::get('favors', [BlogController::class, 'myFavors'])->middleware('auth')->name('favors');


route::get('back_blogs_index', [HomeController::class, 'back_blogs_index'])->name('backBlogsIndex');
route::get('back_categories_index', [HomeController::class, 'back_categories_index'])->name('backCategoriesIndex');