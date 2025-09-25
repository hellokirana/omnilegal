<?php

namespace App\Http\Controllers\Admin;

use App\Models\Stat;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\DataTables\StatDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class StatController extends Controller
{
    public function index(StatDataTable $dataTable)
    {
        return $dataTable->render('admin.slider.index');
    }

    public function create()
    {
        return view('admin.stat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'label_id' => 'nullable|string|max:255',
            'label_en' => 'nullable|string|max:255',
            'value' => 'required|string|max:255',
            'status' => 'required|in:0,1',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $validated['id'] = (string) Str::uuid();

        // Upload image jika ada
        if ($request->hasFile('image')) {
            $filename = $request->file('image')->hashName();
            $request->file('image')->storeAs('stat', $filename, 'public');
            $validated['image'] = $filename;
        }

        Stat::create($validated);

        Session::flash('success', 'Stat berhasil disimpan');
        return redirect()->route('admin.stat.index');
    }

    public function edit($id)
    {
        $stat = Stat::findOrFail($id);
        return view('admin.stat.edit', compact('stat'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'label_id' => 'nullable|string|max:255',
            'label_en' => 'nullable|string|max:255',
            'value' => 'required|string|max:255',
            'status' => 'required|in:0,1',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $stat = Stat::findOrFail($id);

        // Update image jika ada
        if ($request->hasFile('image')) {
            if ($stat->image) {
                Storage::disk('public')->delete('stat/' . $stat->image);
            }
            $filename = $request->file('image')->hashName();
            $request->file('image')->storeAs('stat', $filename, 'public');
            $validated['image'] = $filename;
        }

        $stat->update($validated);

        Session::flash('success', 'Stat berhasil diupdate');
        return redirect()->route('admin.stat.index');
    }

    public function destroy($id)
    {
        $stat = Stat::findOrFail($id);

        if ($stat->image) {
            Storage::disk('public')->delete('stat/' . $stat->image);
        }

        $stat->delete();

        return response()->json(['success' => 'Stat berhasil dihapus']);
    }
}
