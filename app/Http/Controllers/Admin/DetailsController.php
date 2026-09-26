<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;


class DetailsController extends Controller
{
    public function indexByCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->paginate(10); // استخدام العلاقة

        return view('layouts.posts', compact('category', 'posts'));
    }



    /**
     * Display a specific blog and its category.
     */
    public function show($slug)
    {

        $post = Post::with(['category' ])->where('slug', $slug)->firstOrFail();
        $relatedPosts = Post::where('category_id' , $post->category_id)
            ->where('slug', '!=', $slug)
            ->limit(3)->take(5)->get()
            ->unique('slug');

        $categories = Category::all();
        $posts = Post::whereHas('category' ,function ($query){
            $query->whereIn('name' ,[
        'Learning Laravel',
        'Laravel Errors & Solutions',
        'English for Developers'
    ]);
        })->get();
        $networkingposts = Post::whereHas('category', function ($query) {
          $query->where('name', 'networking');
           })->latest()->take(5)->get();

        return view('layouts.single-post', compact('post', 'relatedPosts', 'categories', 'posts','networkingposts' ));
    }


    public function showpost($slug)
        {
            $category = Category::where('slug', $slug)->firstOrFail();

            $posts = $category->posts()->latest()->paginate(50);

            return view('layouts.showpost', compact( 'category', 'posts'));
        }

        public function networks(){
            $networkposts = Post::whereHas('category' , function ($query){
             $query->where('name' , "networking");
            })->latest()->paginate(20);

            return view('layouts.network' , compact('networkposts'));
        }


}
