<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\Description;
use Illuminate\Http\Request;
use App\DataTables\DescriptionDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DescriptionController extends Controller
{
    // Index pakai DataTable
    public function index(DescriptionDataTable $dataTable)
    {
        return $dataTable->render('admin.description.index');
    }

    // Form create
    public function create()
    {
        return view('admin.description.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'about_id' => 'nullable|string',
            'about_en' => 'nullable|string',
            'short_about_id' => 'nullable|string',
            'short_about_en' => 'nullable|string',
            'team_id' => 'nullable|string',
            'team_en' => 'nullable|string',
            'career_id' => 'nullable|string',
            'career_en' => 'nullable|string',
            'service_id' => 'nullable|string',
            'service_en' => 'nullable|string',
            'practice_id' => 'nullable|string',
            'practice_en' => 'nullable|string',
            'disclaimer_id' => 'nullable|string',
            'disclaimer_en' => 'nullable|string',
        ]);

        $validated['id'] = (string) Str::uuid();

        Description::create($validated);

        Session::flash('success', 'Description berhasil disimpan');
        return redirect()->route('admin.description.index');
    }

    // Form edit
    public function edit($id)
    {
        $description = Description::findOrFail($id);
        return view('admin.description.edit', compact('description'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'about_id' => 'nullable|string',
            'about_en' => 'nullable|string',
            'short_about_id' => 'nullable|string',
            'short_about_en' => 'nullable|string',
            'team_id' => 'nullable|string',
            'team_en' => 'nullable|string',
            'career_id' => 'nullable|string',
            'career_en' => 'nullable|string',
            'service_id' => 'nullable|string',
            'service_en' => 'nullable|string',
            'practice_id' => 'nullable|string',
            'practice_en' => 'nullable|string',
            'disclaimer_id' => 'nullable|string',
            'disclaimer_en' => 'nullable|string',
            'created_at' => 'nullable|date',
        ]);

        $description = Description::findOrFail($id);

        $description->update($validated);

        // Update created_at jika diisi
        if ($request->filled('created_at')) {
            $description->created_at = $request->created_at;
            $description->save();
        }

        Session::flash('success', 'Description berhasil diupdate');
        return redirect()->route('admin.description.index');
    }

    // Hapus data
    public function destroy($id)
    {
        $description = Description::findOrFail($id);
        $description->delete();

        return response()->json(['success' => 'Description berhasil dihapus']);
    }
}
