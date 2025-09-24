<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function index(\App\DataTables\TeamDataTable $dataTable)
    {
        return $dataTable->render('admin.team.index');
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position_id' => 'nullable|string|max:255',
            'position_en' => 'nullable|string|max:255',
            'description_id' => 'nullable|string',
            'description_en' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'status' => 'required|in:0,1',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $validated['id'] = (string) Str::uuid();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('team', 'public');
        }

        Team::create($validated);

        Session::flash('success', 'Team berhasil disimpan');
        return redirect()->route('admin.team.index');
    }

    public function edit($id)
    {
        $team = Team::findOrFail($id);
        return view('admin.team.edit', compact('team'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position_id' => 'nullable|string|max:255',
            'position_en' => 'nullable|string|max:255',
            'description_id' => 'nullable|string',
            'description_en' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'status' => 'required|in:0,1',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'created_at' => 'nullable|date',
        ]);

        $team = Team::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($team->image) {
                Storage::disk('public')->delete($team->image);
            }
            $validated['image'] = $request->file('image')->store('team', 'public');
        }

        $team->update($validated);

        if ($request->filled('created_at')) {
            $team->created_at = $request->created_at;
            $team->save();
        }

        Session::flash('success', 'Team berhasil diupdate');
        return redirect()->route('admin.team.index');
    }

    public function destroy($id)
    {
        $team = Team::findOrFail($id);

        if ($team->image) {
            Storage::disk('public')->delete($team->image);
        }

        $team->delete();

        return response()->json(['success' => 'Team berhasil dihapus']);
    }
}
