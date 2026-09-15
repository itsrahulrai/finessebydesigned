<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;

class BlogController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $query = Blog::with(['blogCategory','admin'])->published()->latest('published_at');
        if ($request->filled('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }
        $blogs      = $query->paginate(9)->withQueryString();
        $categories = BlogCategory::withCount(['blogs' => fn($q) => $q->published()])->get();
        return view('frontend.blog.index', compact('blogs', 'categories'));
    }

    public function show(string $slug)
    {
        $blog    = Blog::with(['blogCategory','admin'])->published()->where('slug', $slug)->firstOrFail();
        $blog->increment('views');
        $related = Blog::published()->where('id', '!=', $blog->id)
            ->where('blog_category_id', $blog->blog_category_id)
            ->latest('published_at')->take(3)->get();
        return view('frontend.blog.show', compact('blog', 'related'));
    }
}
