<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StoryController extends Controller
{
    // List semua cerita
    public function index()
    {
        $stories = Story::with(['user', 'region'])->latest()->paginate(10);
        return view('admin.stories.index', compact('stories'));
    }

    // Form tambah cerita
    public function create()
    {
        $regions = \App\Models\Region::orderBy('name')->get();
        return view('admin.stories.create', compact('regions'));
    }

    // Simpan cerita baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'region_id' => 'required|exists:regions,id',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['slug'] = Str::slug($validated['title']);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('stories', 'public');
        }

        Story::create($validated);

        return redirect()->route('admin.stories.index')
            ->with('success', 'Cerita berhasil ditambahkan!');
    }

    // Form edit cerita
    public function edit(Story $story)
    {
        $regions = \App\Models\Region::orderBy('name')->get();
        return view('admin.stories.edit', compact('story', 'regions'));
    }

    // Update cerita
    public function update(Request $request, Story $story)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'region_id' => 'required|exists:regions,id',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($story->image) {
                Storage::disk('public')->delete($story->image);
            }
            $validated['image'] = $request->file('image')->store('stories', 'public');
        }

        $story->update($validated);

        return redirect()->route('admin.stories.index')
            ->with('success', 'Cerita berhasil diupdate!');
    }

    // Delete cerita
    public function destroy(Story $story)
    {
        // Delete image
        if ($story->image) {
            Storage::disk('public')->delete($story->image);
        }

        $story->delete();

        return redirect()->route('admin.stories.index')
            ->with('success', 'Cerita berhasil dihapus!');
    }
}