<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\PracticeArea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PracticeAreaController extends Controller
{
    public function index(\App\DataTables\PracticeAreaDataTable $dataTable)
    {
        return $dataTable->render('admin.practice-area.index');
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
            'image' => 'required|string', // contoh: "12.png"
        ]);

        $validated['id'] = (string) Str::uuid();

        PracticeArea::create($validated);

        return redirect()->route('admin.practice-area.index')
            ->with('success', 'Practice Area berhasil disimpan');
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
            'image' => 'nullable|string', // nama icon (bisa kosong biar tetap yang lama)
            'created_at' => 'nullable|date',
        ]);

        $practiceArea = PracticeArea::findOrFail($id);

        $practiceArea->update($validated);

        // Update created_at jika diisi manual
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
        $practiceArea->delete();

        return response()->json(['success' => 'Practice Area berhasil dihapus']);
    }
}
