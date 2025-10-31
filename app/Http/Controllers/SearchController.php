<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SearchController  extends Controller
{
      public function search(Request $request)
        {
            $query = strtolower(str_replace(' ', '-', $request->input('query')));
            $stores = Store::where('slug', 'like', "%$query%")->pluck('slug');
            $store = Store::where('slug', $query)->first();

            if ($store) {
                $formattedSlug = str_replace(' ', '-', $store->slug);
                return redirect()->route('store.detail', ['slug' => $formattedSlug]);
            }

            if ($request->ajax()) {
                return response()->json(['stores' => $stores]);
            }

            return redirect()->route('search_results', ['query' => $query]);
        }
      public function searchResults(Request $request) {
        $query = $request->input('query');

        // Fetch stores matching the query for autocomplete
        $stores = Store::where('name', 'like', "$query%")->paginate(20);
        $stores->appends(['query' => $query]);
        // Check if there is a single store matching the query exactly
        $store = Store::where('name', $query)->first();

        if ($store) {
            // If a single store is found, redirect to its details page
            return redirect()->route('admin.store.show', ['slug' => Str::slug($store->slug)]);
        }

        return view('front-end.search_result', ['stores' => $stores]);
    }
}
