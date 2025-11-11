<?php

namespace App\Http\Controllers\Employee;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\language;
use App\Models\Store;
use Illuminate\Support\Str;
 use Illuminate\Support\Facades\Storage;
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with('language','updatedby')->orderBy('created_at', 'desc')->get();
        return view('employee.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        $languages = language::orderBy('created_at', 'desc')->get();
        $stores = Store::orderBy('created_at', 'desc')->get();
        return view('employee.blog.create', compact('categories', 'languages', 'stores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug',
            'title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'content' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'nullable|boolean',
            'language_id' => 'nullable|exists:languages,id',
            'store_id' => 'nullable|exists:stores,id',
        ]);

        $blog = new Blog();
        $blog->user_id = Auth::id();
        $blog->language_id = $request->input('language_id', 1);
        $blog->store_id = $request->input('store_id', 1);
        $blog->name = $request->name;
        $blog->slug = $request->slug;
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->meta_description = $request->meta_description;
        $blog->meta_keyword = $request->meta_keyword;
        $blog->status = $request->input('status', 0);
        $blog->category_id = $request->category_id;

        // Temporarily save to get blog ID for folder path
        $blog->save();


           if ($request->hasFile('image')) {
        $image = $request->file('image');
        $storeNameSlug = Str::slug($request->slug);
        $imageName = $storeNameSlug . '.' . $image->getClientOriginalExtension();

        $path = $image->storeAs("blogs", $imageName, 'public');

        // Update store image path
        $blog->image = $path;
        $blog->save();
    }

        return redirect()->route('employee.blog.index')->with('success', 'Blog created successfully.');
    }


    /**
     * Display the specified resource.
     */
  public function show(Blog $blog)
    {
        if (!$blog)
             {
                abort(404);
            }

        // Get store$store where store_id matches the store's ID
        $store = Store::with('user')
                    ->where('category_id', $blog->category_id)  // Changed from $title to $store->id
                    ->get();

        return view('employee.blog.show', compact('blog', 'store'));
    }


    /**
     * Show the form for editing the specified resource.
     */

        public function edit(Blog $blog)
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        $languages = language::orderBy('created_at', 'desc')->get();
        $stores = Store::orderBy('created_at', 'desc')->get();

       return view('employee.blog.edit', compact('blog', 'categories', 'languages', 'stores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug,' . $blog->id,
            'title' => 'required|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'language_id' => 'nullable|exists:languages,id',
            'store_id' => 'nullable|exists:stores,id',
            'status' => 'nullable|boolean',
        ]);

        // 🖼 Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }
            $imagePath = $request->file('image')->store("blogs", 'public');
            $blog->image = $imagePath;
        }

        // 📝 Update all other fields
        $blog->updated_id = Auth::id();
        $blog->language_id = $request->language_id ?? $blog->language_id;
        $blog->store_id = $request->store_id ?? $blog->store_id;
        $blog->name = $request->name;
        $blog->slug = $request->slug;
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->meta_description = $request->meta_description;
        $blog->meta_keyword = $request->meta_keyword;
        $blog->status = $request->input('status', 0);
        $blog->category_id = $request->category_id;
        $blog->save();

        return redirect()->route('employee.blog.index')->with('success', 'Blog updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        // Delete the image file if it exists
         if ($blog->image && Storage::disk('public')->exists($blog->image))
        {

            Storage::disk('public')->delete($blog->image);
        }
        $blog->delete();
        return redirect()->route('employee.blog.index')->with('success', 'Blog deleted successfully.');
    }
         public function deleteSelected(Request $request)
        {
            $ids = $request->input('ids');
            if ($ids) {
                foreach ($ids as $id) {
                    $blog = Blog::findOrFail($id);
                    // Delete the image if it exists
                        if ($blog->image && Storage::disk('public')->exists($blog->image))
                        {

                        Storage::disk('public')->delete($blog->image);
                        }
                    // Delete related coupons
                    $blog->coupons()->delete();
                    // Delete the blog
                    $blog->delete();
                }
                return redirect()->route('employee.blog.index')->with('success', 'Selected blogs deleted successfully.');
            } else {
                return redirect()->route('employee.blog.index')->with('error', 'No stores selected for deletion.');
            }
        }

}
