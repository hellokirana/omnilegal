<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\NewsDataTable;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(NewsDataTable $dataTable)
    {
        return $dataTable->render('admin.news.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'title_id' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:255',
            'content_id' => 'nullable|string',
            'content_en' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'image_caption' => 'nullable|string|max:255',
            'document_id' => 'nullable|file|mimes:pdf,doc,docx',
            'document_en' => 'nullable|file|mimes:pdf,doc,docx',
            'status' => 'required|in:0,1',
        ]);

        $validated['id'] = (string) Str::uuid();

        if ($request->hasFile('image')) {
            $filename = $request->file('image')->hashName();
            $request->file('image')->storeAs('news', $filename, 'public');
            $validated['image'] = $filename;
        }

        // Upload documents
        if ($request->hasFile('document_id')) {
            $validated['document_id'] = $request->file('document_id')->store('news', 'public');
        }

        if ($request->hasFile('document_en')) {
            $validated['document_en'] = $request->file('document_en')->store('news', 'public');
        }

        News::create($validated);

        return redirect()->route('admin.news.index')->with('success', 'News created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'title_id' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:255',
            'content_id' => 'nullable|string',
            'content_en' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'image_caption' => 'nullable|string|max:255',
            'document_id' => 'nullable|file|mimes:pdf,doc,docx',
            'document_en' => 'nullable|file|mimes:pdf,doc,docx',
            'status' => 'required|in:0,1',
            'created_at' => 'nullable|date', // tambahkan validasi created_at
        ]);

        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete('news/' . $news->image);
            }
            $filename = $request->file('image')->hashName();
            $request->file('image')->storeAs('news', $filename, 'public');
            $validated['image'] = $filename;
        }

        // Update documents
        if ($request->hasFile('document_id')) {
            if ($news->document_id) {
                Storage::disk('public')->delete($news->document_id);
            }
            $validated['document_id'] = $request->file('document_id')->store('news', 'public');
        }

        if ($request->hasFile('document_en')) {
            if ($news->document_en) {
                Storage::disk('public')->delete($news->document_en);
            }
            $validated['document_en'] = $request->file('document_en')->store('news', 'public');
        }

        // Update fields biasa
        $news->update($validated);

        // Assign created_at manual jika diisi
        if ($request->filled('created_at')) {
            $news->created_at = $request->created_at;
            $news->save(); // hanya save created_at, updated_at otomatis ter-update tapi tidak kita edit manual
        }

        return redirect()->route('admin.news.index')->with('success', 'News updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        if ($news->image) {
            Storage::disk('public')->delete('news/' . $news->image);
        }
        if ($news->document_id) {
            Storage::disk('public')->delete($news->document_id);
        }
        if ($news->document_en) {
            Storage::disk('public')->delete($news->document_en);
        }

        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'News deleted successfully.');
    }
}
