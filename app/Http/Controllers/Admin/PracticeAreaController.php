<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\PracticeArea;
use Illuminate\Http\Request;
use App\DataTables\ContactDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PracticeAreaController extends Controller
{
    public function index(ContactDataTable $dataTable)
    {
        return $dataTable->render('admin.inbox.index');
    }

    public function create()
    {
        return view('admin.practice-area.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_id' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_id' => 'nullable|string',
            'description_en' => 'nullable|string',
            'status' => 'required|in:0,1',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $validated['id'] = (string) Str::uuid();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('practice-area', 'public');
        }

        PracticeArea::create($validated);

        Session::flash('success', 'Practice Area berhasil disimpan');
        return redirect()->route('admin.practice-area.index');
    }

    public function edit($id)
    {
        $practiceArea = PracticeArea::findOrFail($id);
        return view('admin.practice-area.edit', compact('practiceArea'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title_id' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_id' => 'nullable|string',
            'description_en' => 'nullable|string',
            'status' => 'required|in:0,1',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'created_at' => 'nullable|date',
        ]);

        $practiceArea = PracticeArea::findOrFail($id);

        // Update image jika ada
        if ($request->hasFile('image')) {
            if ($practiceArea->image) {
                Storage::disk('public')->delete($practiceArea->image);
            }
            $validated['image'] = $request->file('image')->store('practice-area', 'public');
        }

        $practiceArea->update($validated);

        // Update created_at jika diisi
        if ($request->filled('created_at')) {
            $practiceArea->created_at = $request->created_at;
            $practiceArea->save();
        }

        Session::flash('success', 'Practice Area berhasil diupdate');
        return redirect()->route('admin.practice-area.index');
    }

    public function destroy($id)
    {
        $practiceArea = PracticeArea::findOrFail($id);

        if ($practiceArea->image) {
            Storage::disk('public')->delete($practiceArea->image);
        }

        $practiceArea->delete();

        return response()->json(['success' => 'Practice Area berhasil dihapus']);
    }
}
