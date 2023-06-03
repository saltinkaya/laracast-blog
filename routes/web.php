<?php

use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PostController::class, "index"])->name("home");


Route::get("/posts/{post:slug}", [PostController::class, "show"]);


/*
ROUTE::get("categories/{category:slug}", function (Category $category) {

    // {category:slug} defines how ROUTE MODEL BINDING will look for the id.
    // If you only define {category}, it will search for the slug,but couldn't find the ID.
    // If lost, refer to the 25th Episode of Laravel 101 with Jeffrey.

    return view("posts", [
        "posts" => $category->posts,
        "currentCategory" => $category,
        "categories" => Category::all()

    ]);


});*/

ROUTE::get("authors/{author:username}", function (User $author) {


    return view("posts.index", [
        "posts" => $author->posts
    ]);
}
);


Route::get("register", [RegisterController::class, "create"])->middleware("guest"); // form sayfası
Route::post("register", [RegisterController::class, "store"])->middleware("guest"); // create a user

Route::get("login", [SessionsController::class, "create"])->middleware("guest"); // only guests can reach it.
Route::post("logout", [SessionsController::class, "destroy"])->middleware("auth"); // you have to be authenticated.

Route::post("sessions", [SessionsController::class, "store"])->middleware("guest");


Route::post("posts/{post:slug}/comments", [PostCommentsController::class, "store"]);

