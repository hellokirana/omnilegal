<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(\App\DataTables\CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.category.index');
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_id' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:10',
        ]);

        $validated['id'] = (string) Str::uuid();

        Category::create($validated);

        Session::flash('success', 'Data berhasil disimpan');
        return redirect()->route('admin.category.index');
    }

    public function edit($id)
    {
        $data = Category::findOrFail($id);
        return view('admin.category.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title_id' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:10',
            'created_at' => 'nullable|date', // jika ingin bisa diubah
        ]);

        $category = Category::findOrFail($id);

        $category->update($validated);

        // Jika admin mengisi created_at, assign manual
        if ($request->filled('created_at')) {
            $category->created_at = $request->created_at;
            $category->save();
        }

        Session::flash('success', 'Data berhasil diupdate');
        return redirect()->route('admin.category.index');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['success' => 'Hapus data berhasil']);
    }
}
