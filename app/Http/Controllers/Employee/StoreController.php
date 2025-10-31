<?php

namespace App\Http\Controllers\Employee;
use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Language;
use App\Models\Category;
use App\Models\Network;
use App\Models\Coupon;

class StoreController extends Controller
{
       /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get all languages that have stores
        $languages = Language::whereHas('stores')->get();

        $selectedLanguage = $request->input('language_id');

        // Build the stores query
        $query = Store::select('id', 'slug', 'name', 'category_id',  'network_id', 'image', 'created_at', 'status',  'updated_at', 'language_id')
            ->with('language', 'network')
            ->when($selectedLanguage, function($query) use ($selectedLanguage) {
                return $query->where('language_id', $selectedLanguage);
            })
            ->orderBy('created_at', 'desc');

        // If AJAX request, return only partial view
        if ($request->ajax()) {
            $stores = $query->limit(200)->get();

            return response()->json([
                'html' => view('employee.stores.partials.store-list', compact('stores'))->render()
            ]);
        }

        // Otherwise, return full view
        $stores = $query->get();

        return view('employee.stores.index', compact('stores', 'languages', 'selectedLanguage'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $categories = Category::orderBy('created_at', 'desc')->get();
        $networks = Network::orderBy('created_at', 'desc')->get();
        $languages = language::orderBy('created_at', 'desc')->get();
        return view('employee.stores.create', compact('categories', 'networks', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     */


public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:stores,slug',
        'status' => 'required|boolean',
        'url' => 'required|url',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'title' => 'nullable|string|max:255',
        'meta_keyword' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string|max:255',
        'content' => 'nullable|string',
        'about' => 'nullable|string',
        'description' => 'required|string',
        'language_id' => 'required|exists:languages,id',
        'category_id' => 'required|exists:categories,id',
        'network_id' => 'nullable|exists:networks,id',
        'top_store' => 'nullable|boolean',
        'destination_url' => 'nullable|url',
    ]);

    // Step 1: Create store record first (without image)
    $store = new Store();
    $store->user_id = Auth::id();
    $store->language_id = $request->language_id;
    $store->category_id = $request->category_id;
    $store->network_id = $request->network_id;
    $store->top_store = $request->top_store;
    $store->destination_url = $request->destination_url;
    $store->name = $request->name;
    $store->slug = $request->slug;
    $store->status = $request->status;
    $store->title = $request->title;
    $store->meta_keyword = $request->meta_keyword;
    $store->meta_description = $request->meta_description;
    $store->content = $request->content;
    $store->about = $request->about;
    $store->description = $request->description;
    $store->url = $request->url;
    $store->save(); // ✅ We now have $store->id

    // Step 2: Handle image upload (after ID is known)
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $storeNameSlug = Str::slug($request->slug);
        $imageName = $storeNameSlug . '.' . $image->getClientOriginalExtension();

        // Store image in storage/app/public/stores/{id}/
        $path = $image->storeAs("stores", $imageName, 'public');

        // Update store image path
        $store->image = $path;
        $store->save();
    }

    return redirect()->route('employee.store.show', $store->id)->with('success', 'Store created successfully.');
}


    /**
     * Display the specified resource.
     */
        public function show(Store $store)
        {

            if (!$store) {
                abort(404);
            }

            // Get related coupons
            $coupons = Coupon::with('store')
                ->where('store_id', $store->id)
                ->orderByRaw('CAST(`order` AS SIGNED) ASC')
                ->get();
            $stores = Store::orderBy('created_at', 'desc')->get();
            $languages = language::orderBy('created_at', 'desc')->get();

            return view('employee.stores.show', compact('store', 'coupons', 'stores', 'languages'));
        }


    /**
     * Show the form for editing the specified resource.
     */
        public function edit(Store $store)
        {
            $categories = Category::orderBy('created_at', 'desc')->get();
            $networks = Network::orderBy('created_at', 'desc')->get();
            $languages = Language::orderBy('created_at', 'desc')->get();

            return view('employee.stores.edit', compact('store', 'categories', 'networks', 'languages'));
        }


    /**
     * Update the specified resource in storage.
     */


    public function update(Request $request, Store $store)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:stores,slug,' . $store->id,
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'title' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'about' => 'nullable|string',
            'description' => 'nullable|string',
            'language_id' => 'required|exists:languages,id',
            'category_id' => 'required|exists:categories,id',
            'network_id' => 'nullable|exists:networks,id',
            'top_store' => 'nullable|boolean',
            'destination_url' => 'nullable|url',
            'url' => 'required|url',
        ]);

        // 🖼 Handle image upload
        $imagePath = $store->image; // Keep old image by default

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($store->image && Storage::disk('public')->exists($store->image)) {
                Storage::disk('public')->delete($store->image);
            }

            // Save new image in storage/app/public/stores/{id}/
               $image = $request->file('image');
        $storeNameSlug = Str::slug($request->slug);
        $imageName = $storeNameSlug . '.' . $image->getClientOriginalExtension();

        // Store image in storage/app/public/stores/{id}/
        $imagePath = $image->storeAs("stores", $imageName, 'public');
        }

        // 🧾 Update store data
        $store->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status,
            'image' => $imagePath,
            'title' => $request->title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'content' => $request->content,
            'about' => $request->about,
            'description' => $request->description,
            'language_id' => $request->language_id,
            'category_id' => $request->category_id,
            'network_id' => $request->network_id,
            'top_store' => $request->top_store,
            'destination_url' => $request->destination_url,
            'url' => $request->url,
            'updated_id' => Auth::id(),
        ]);

        return redirect()
            ->route('employee.store.show', $store->id)
            ->with('success', 'Store updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $stores = Store::findOrFail($id);
        // Delete the image if it exists
      if ($stores->image && Storage::disk('public')->exists($stores->image))
        {

            Storage::disk('public')->delete($stores->image);
        }
        // Delete the store
        $stores->delete();
        return redirect()->route('employee.store.index')->with('success', 'Store deleted successfully.');
    }

    /**
     * Remove the selected resources from storage.
     */
     public function deleteSelected(Request $request)
        {
            $ids = $request->input('ids');
            if ($ids) {
                foreach ($ids as $id) {
                    $store = Store::findOrFail($id);
                    // Delete the image if it exists
                        if ($store->image && Storage::disk('public')->exists($store->image))
                        {

                        Storage::disk('public')->delete($store->image);
                        }
                    // Delete related coupons
                    $store->coupons()->delete();
                    // Delete the store
                    $store->delete();
                }
                return redirect()->route('employee.store.index')->with('success', 'Selected stores deleted successfully.');
            } else {
                return redirect()->route('employee.store.index')->with('error', 'No stores selected for deletion.');
            }
        }
}
