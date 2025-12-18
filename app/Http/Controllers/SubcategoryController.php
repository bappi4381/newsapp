<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
     public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required',
        ]);
        
        $slug = Str::slug($request->name);
        Subcategory::create([
            'category_id' => $request->category_id,
            'slug' => $slug,
            'name' => $request->name,
        ]);

        return back()->with('success', 'Subcategory created successfully.');
    }

    // Delete subcategory
    public function destroy($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->delete();

        return back()->with('success', 'Subcategory deleted successfully.');
    }
    /**
     * Get subcategories by category ID (for AJAX requests)
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function getCategoriesByType(Request $request)
    {
        $request->validate([
            'type' => 'required|in:article,blog',
        ]);
        $categories = Category::where('type', $request->type)->get();
        return response()->json($categories);
    }
    public function getSubcategories(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
        ]);

        $subcategories = Subcategory::where('category_id', $request->category_id)->get();

        return response()->json($subcategories);
    }
}
