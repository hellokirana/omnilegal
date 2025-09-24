<?php

namespace App\Http\Controllers\Admin;

use App\Models\Website;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class WebsiteController extends Controller
{
    public function index(\App\DataTables\WebsiteDataTable $dataTable)
    {
        return $dataTable->render('admin.website.index');
    }

    public function create()
    {
        return view('admin.website.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'url' => 'nullable|url|max:255',
            'nama' => 'nullable|string|max:255',
            'caption' => 'nullable|string|max:255',
            'favicon' => 'nullable|image|mimes:png,ico,jpg,jpeg',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,webp',
            'maps' => 'nullable|string',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'address_id' => 'nullable|string',
            'address_en' => 'nullable|string',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'x' => 'nullable|string|max:50',
        ]);

        $validated['id'] = (string) Str::uuid();

        if ($request->hasFile('favicon')) {
            $validated['favicon'] = $request->file('favicon')->store('website', 'public');
        }

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('website', 'public');
        }

        Website::create($validated);

        Session::flash('success', 'Website berhasil disimpan');
        return redirect()->route('admin.website.index');
    }

    public function edit($id)
    {
        $website = Website::findOrFail($id);
        return view('admin.website.edit', compact('website'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'url' => 'nullable|url|max:255',
            'nama' => 'nullable|string|max:255',
            'caption' => 'nullable|string|max:255',
            'favicon' => 'nullable|image|mimes:png,ico,jpg,jpeg',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,webp',
            'maps' => 'nullable|string',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'address_id' => 'nullable|string',
            'address_en' => 'nullable|string',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'x' => 'nullable|string|max:50',
            'created_at' => 'nullable|date',
        ]);

        $website = Website::findOrFail($id);

        if ($request->hasFile('favicon')) {
            if ($website->favicon) {
                Storage::disk('public')->delete($website->favicon);
            }
            $validated['favicon'] = $request->file('favicon')->store('website', 'public');
        }

        if ($request->hasFile('logo')) {
            if ($website->logo) {
                Storage::disk('public')->delete($website->logo);
            }
            $validated['logo'] = $request->file('logo')->store('website', 'public');
        }

        $website->update($validated);

        if ($request->filled('created_at')) {
            $website->created_at = $request->created_at;
            $website->save();
        }

        Session::flash('success', 'Website berhasil diupdate');
        return redirect()->route('admin.website.index');
    }

    public function destroy($id)
    {
        $website = Website::findOrFail($id);

        if ($website->favicon) {
            Storage::disk('public')->delete($website->favicon);
        }

        if ($website->logo) {
            Storage::disk('public')->delete($website->logo);
        }

        $website->delete();

        return response()->json(['success' => 'Website berhasil dihapus']);
    }
}
