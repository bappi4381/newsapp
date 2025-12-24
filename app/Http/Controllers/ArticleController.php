<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Controller methods for article management would go here
    public function index()
    {
        // Logic to list articles
        $articles = Article::latest()->paginate(10);
        return view('articles.index', compact('articles'));
    }
    public function create()
    {
        // Logic to show article creation form
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('articles.create', compact('categories', 'subcategories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title'          => 'required|string|max:255',
            'slug'           => 'required|string|unique:articles,slug',
            'category_id'    => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'content'        => 'required|string',
            'description'    => 'nullable|string|max:500',
            'image'          => 'nullable|image|max:2048',
        ]);

        $data = $request->only([
            'title',
            'slug',
            'category_id',
            'subcategory_id',
            'content',
            'description',
            'author_id',
        ]);

        // Handle publish toggle
        $data['is_published'] = $request->has('is_published');
        $data['published_at'] = $data['is_published'] ? now() : null;

        // Upload image
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        Article::create($data);

        return redirect()
            ->route('articles.index')
            ->with('success', 'Article created successfully.');
    }
    public function edit(Article $article)
    {
        // Logic to show article edit form
    }
    public function update(Request $request, Article $article)
    {
        // Logic to update an existing article
    }
    public function destroy(Article $article)
    {
        // Logic to delete an article
    }
}
