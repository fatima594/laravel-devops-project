<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use App\Http\Services\Image\ImageService;

class PostController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $posts = Post::with('category')->orderBy('updated_at', 'desc')->paginate(50);
        return view('admin.post.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.post.create', compact('categories'));
    }

    public function store(StorePostRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            // في store() و update()
           $imagePath = $this->imageService->fitAndSave($request->file('image'), 600, 400);

            if ($imagePath) {
                $validatedData['image'] = $imagePath;
            } else {
                return redirect()->back()->withErrors(['image' => 'فشل في معالجة الصورة.']);
            }
        }

        $post = Post::create([
            'title' => $validatedData['title'],
             'body' => nl2br($validatedData['body']),
             'image' => $validatedData['image'] ?? null,
            'image_alt' => $validatedData['image_alt'] ?? null, // ✅ تمت الإضافة هنا
            'category_id' => $validatedData['category_id'],
            'meta_title' => $validatedData['meta_title'] ?? null,
            'meta_description' => $validatedData['meta_description'] ?? null,
        ]);

        return redirect()->route('admin.post.index')->with('success', 'Post created successfully.');
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->with('category')->first();

        if (!$post) {
            return redirect()->url('/')->with('error', 'Post not found.');
        }

        return view('admin.post.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();

        return view('admin.post.edit', compact('post', 'categories'));
    }

    public function update(StorePostRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }

            $imagePath = $this->imageService->fitAndSave($request->file('image'), 800, 600);

            if ($imagePath) {
                $validatedData['image'] = $imagePath;
            } else {
                return redirect()->back()->withErrors(['image' => 'فشل في معالجة الصورة.']);
            }
        }

        $post->update([
            'title' => $validatedData['title'],
            'body' => nl2br($validatedData['body']),
            'category_id' => $validatedData['category_id'],
            'image' => $validatedData['image'] ?? $post->image,
            'image_alt' => $validatedData['image_alt'] ?? $post->image_alt, // ✅ تمت الإضافة هنا
            'meta_title' => $validatedData['meta_title'] ?? null,
            'meta_description' => $validatedData['meta_description'] ?? null,
        ]);

        return redirect()->route('admin.post.index')->with('success', 'Post updated successfully.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('admin.post.index')->with('success', 'Post deleted successfully.');
    }
}
