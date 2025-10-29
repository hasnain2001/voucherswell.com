<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::all();
        return view('admin.language.index', compact('languages')); // ✅ fixed variable name
    }

    public function create()
    {
        return view('admin.language.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:languages,code',
            'flag' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        $language = new Language();
        $language->name = $request->name;
        $language->code = $request->code;
        $language->user_id = Auth::id();

        if ($request->hasFile('flag')) {
            $language->flag = $request->file('flag')->store('flags', 'public');
        }

        $language->status = $request->status;
        $language->save();

        return redirect()->route('admin.language.index')->with('success', 'Language created successfully.');
    }

    public function edit(Language $language)
    {
        return view('admin.language.edit', compact('language'));
    }

    public function update(Request $request, Language $language)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:languages,code,' . $language->id,
            'flag' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        $language->name = $request->name;
        $language->code = $request->code;
        $language->updated_id = Auth::id();

        if ($request->hasFile('flag')) {
            if ($language->flag && Storage::disk('public')->exists($language->flag)) {
                Storage::disk('public')->delete($language->flag);
            }
            $language->flag = $request->file('flag')->store('flags', 'public');
        }

        $language->status = $request->status;
        $language->save();

        return redirect()->route('admin.language.index')->with('success', 'Language updated successfully.');
    }

    public function destroy(Language $language)
    {
        if ($language->flag && Storage::disk('public')->exists($language->flag)) {
            Storage::disk('public')->delete($language->flag);
        }

        $language->delete();

        return redirect()->route('admin.language.index')->with('success', 'Language deleted successfully.');
    }
}
