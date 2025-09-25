<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index(\App\DataTables\ServiceDataTable $dataTable)
    {
        return $dataTable->render('admin.service.index');
    }

    public function create()
    {
        return view('admin.service.create');
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

        Service::create($validated);

        return redirect()->route('admin.service.index')
            ->with('success', 'Service berhasil ditambahkan');
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.service.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title_id' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_id' => 'nullable|string',
            'description_en' => 'nullable|string',
            'status' => 'required|in:0,1',
            'image' => 'nullable|string', // cukup simpan "12.png"
            'created_at' => 'nullable|date',
        ]);

        $service = Service::findOrFail($id);

        // langsung update data (image adalah string, tidak upload file)
        $service->update($validated);

        // Update created_at jika diisi
        if ($request->filled('created_at')) {
            $service->created_at = $request->created_at;
            $service->save();
        }

        Session::flash('success', 'Service berhasil diupdate');
        return redirect()->route('admin.service.index');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return response()->json(['success' => 'Service berhasil dihapus']);
    }
}
