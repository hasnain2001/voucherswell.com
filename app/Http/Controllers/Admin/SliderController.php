<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\language;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Exports\SlidersExport;
use App\Models\Store;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Slider::with('language')
            ->orderBy('sort_order', 'asc');

        // Status filter
        if ($request->has('status')) {
            $status = $request->status === 'active' ? 1 : 0;
            $query->where('status', $status);
        }

        // Language filter
        if ($request->has('language')) {
            $query->whereHas('language', function($q) use ($request) {
                $q->where('code', $request->language);
            });
        }

        // Get all languages for filter dropdown
        $languages = Language::all();

        // Paginate results (15 items per page by default)
        $sliders = $query->paginate($request->per_page ?? 15)
            ->appends($request->query());

        return view('admin.slider.index', compact('sliders', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = language::orderBy('created_at','desc')->get();
        $stores = Store::orderBy('created_at','desc')->get();
        return view('admin.slider.create',compact('languages','stores'));
    }

    /**
     * Store a newly created resource in storage.
     */


public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'subtitle' => 'nullable|string|max:2255',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'link' => 'nullable|url',
        'status' => 'required|boolean',
        'sort_order' => 'required|integer',
        'button_text' => 'nullable|string|max:50',
        'store_id' => 'required|exists:stores,id',
        'language_id' => 'required|exists:languages,id',
    ]);



    // ✅ Save to database
    $slider = new Slider();
    $slider->language_id = $request->language_id;
    $slider->store_id = $request->store_id;
    $slider->title = $request->title;
    $slider->subtitle = $request->subtitle;
    $slider->link = $request->link;
    $slider->status = $request->status;
    $slider->sort_order = $request->sort_order;
    $slider->button_text = $request->button_text;
    $slider->save();

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $storeNameSlug = Str::slug($request->title);
        $imageName = $storeNameSlug . '.' . $image->getClientOriginalExtension();

        // Store image in storage/app/public/stores/{id}/
        $path = $image->storeAs("slider", $imageName, 'public');

        // Update store image path
        $slider->image = $path;
        $slider->save();
    }
    return redirect()->route('admin.slider.index')->with('success', 'Slider created successfully.');
}



    public function edit(Slider $slider)
    {
        $languages = language::orderBy('created_at', 'desc')->get();
        $stores = Store::orderBy('created_at','desc')->get();
        return view('admin.slider.edit', compact('slider', 'languages','stores'));
    }



public function update(Request $request, Slider $slider)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'subtitle' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'link' => 'nullable|url',
        'status' => 'required|boolean',
        'sort_order' => 'required|integer',
        'button_text' => 'nullable|string|max:50',
        'store_id' => 'required|exists:stores,id',
        'language_id' => 'required|exists:languages,id',
    ]);

    // 🖼 Handle image upload
    $imagePath = $slider->image; // Keep old image by default

    if ($request->hasFile('image')) {
        // Delete old image if it exists
        if ($slider->image && Storage::disk('public')->exists($slider->image)) {
            Storage::disk('public')->delete($slider->image);
        }

        // Store new image in storage/app/public/slider/
        $image = $request->file('image');
        $sliderNameSlug = Str::slug($request->title);
        $imageName = $sliderNameSlug . '.' . $image->getClientOriginalExtension();

        // Store the image and get its path
        $imagePath = $image->storeAs('slider', $imageName, 'public');
    }

    // ✅ Update attributes
    $slider->language_id = $request->language_id ?? $slider->language_id;
    $slider->store_id = $request->store_id ?? $slider->store_id;
    $slider->title = $request->title;
    $slider->subtitle = $request->subtitle;
    $slider->link = $request->link;
    $slider->status = $request->status;
    $slider->sort_order = $request->sort_order;
    $slider->button_text = $request->button_text;
    $slider->image = $imagePath;

    $slider->save();

    return redirect()->route('admin.slider.index')->with('success', 'Slider updated successfully.');
}


    public function destroy(Slider $slider)
    {
        // ✅ Delete the image from storage if it exists
        if ($slider->image && Storage::exists('public/slider/' . $slider->image)) {
            Storage::delete('public/slider/' . $slider->image);
        }

        // ✅ Delete the database record
        $slider->delete();

        return redirect()->route('admin.slider.index')->with('success', 'Slider deleted successfully.');
    }
    public function deleteSelected(Request $request)
    {
        $ids = $request->input('ids');
        if ($ids) {
            foreach ($ids as $id) {
                $slider = Slider::findOrFail($id);
                // Delete the image if it exists
                if ($slider->image && Storage::disk('public')->exists($slider->image)) {
                    Storage::disk('public')->delete($slider->image);
                }
                // Delete the slider
                $slider->delete();
            }
        }
         return redirect()->route('admin.slider.index')->with('success', 'Slider deleted selected successfully.');
        }
    public function export(Request $request)
    {
        $query = Slider::query();

        // Apply filters same as index method
        if ($request->has('status')) {
            $status = $request->status === 'active' ? 1 : 0;
            $query->where('status', $status);
        }

        if ($request->has('language')) {
            $query->whereHas('language', function($q) use ($request) {
                $q->where('code', $request->language);
            });
        }

        $sliders = $query->get();

        $fileName = 'sliders-'.now()->format('Y-m-d').'.csv';
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = [
            'ID',
            'Title',
            'Image',
            'Status',
            'Link',
            'Sort Order',
            'Language',
            'Created At'
        ];

        $callback = function() use($sliders, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($sliders as $slider) {
                fputcsv($file, [
                    $slider->id,
                    $slider->title,
                    $slider->image ? asset('uploads/slider/'.$slider->image) : 'No Image',
                    $slider->status ? 'Active' : 'Inactive',
                    $slider->link,
                    $slider->sort_order,
                    $slider->language->name ?? 'N/A',
                    $slider->created_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
