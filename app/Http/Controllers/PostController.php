<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::latest()->filter(request(['search', 'category', 'author']))->get()
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function create()
    {

        return view("posts.create");

    }

    public function store()
    {
        $slug = Str::slug(request()->title);
        $attributes = request()->validate([
            "title" => ["required", "min:3", "max:255"],
            "excerpt" => ["required", "min:3", "max:255"],
            "body" => ["required", "min:3", "max:255"],
            "category_id" => ["required", Rule::exists("categories", "id")] // check if it exists on "categories" table "id" column.

        ]);

        // we also need to pass user_id into the attributes.

        $attributes["user_id"] = auth()->id();
        $attributes["slug"] = $slug;


        Post::create($attributes);

        return redirect("/posts/$slug");
    }
}
