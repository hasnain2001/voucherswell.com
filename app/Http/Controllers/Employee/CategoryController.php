<?php

namespace App\Http\Controllers\Employee;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Language;


class CategoryController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::with('language')->get();
        return view('employee.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = language::orderBy('created_at', 'desc')->get();
        return view('employee.category.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'top_category' => 'nullable|integer',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'language_id' => 'required|exists:languages,id',
        ]);

        // Step 1: Create category record first (without image)
        $category = new Category();
        $category->user_id = Auth::id();
        $category->language_id = $request->language_id;
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->top_category = $request->top_category;
        $category->status = $request->status;
        $category->title = $request->title;
        $category->meta_keyword = $request->meta_keyword;
        $category->meta_description = $request->meta_description;
        $category->save(); // ✅ now we have $category->id

        // Step 2: Store image in folder named after category ID
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store("category/{$category->id}", 'public');
            $category->image = $path;
            $category->save(); // update image path
        }

        return redirect()->route('employee.category.index')->with('success', 'Category created successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $languages = language::orderBy('created_at', 'desc')->get();
        return view('employee.category.edit', compact('category', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $category->id,
            'top_category' => 'nullable|integer',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'title' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'language_id' => 'required|exists:languages,id',
        ]);

        // Keep old image path
        $imagePath = $category->image;

        // If new image uploaded
        if ($request->hasFile('image')) {
            // Delete old image (if exists)
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            // Store new image inside category/{id}/ folder
            $imagePath = $request->file('image')->store("category/{$category->id}", 'public');
        }

        // Update category
        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'top_category' => $request->top_category,
            'status' => $request->status,
            'image' => $imagePath,
            'title' => $request->title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'language_id' => $request->language_id,
            'updated_id' => Auth::id(),
        ]);

        return redirect()->route('employee.category.index')->with('success', 'Category updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
      public function destroy(Category $category)
    {
        if ($category->flag && Storage::disk('public')->exists($category->flag))
        {

            Storage::disk('public')->delete($category->flag);
        }

        $category->delete();

        return redirect()->route('employee.category.index')->with('success', 'Language deleted successfully.');
    }
    public function getCategoryById($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }
    public function deleteSelected(Request $request)
    {
        $ids = $request->input('ids');
        if ($ids) {
            Category::whereIn('id', $ids)->delete();
            return response()->json(['success' => 'Selected categories deleted successfully.']);
        }
        return response()->json(['error' => 'No categories selected for deletion.'], 400);
    }
    public function checkSlug(Request $request)
    {
        $slug = Str::slug($request->input('slug'));
        $exists = Category::where('slug', $slug)->exists();

        return response()->json([
            'available' => !$exists,
            'slug' => $slug
        ]);
    }
}
