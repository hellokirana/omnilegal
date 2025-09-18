<?php

namespace App\Http\Controllers\Admin;

use App\Models\Home;
use App\Models\Stat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentController extends Controller
{
    public function index()
    {
        $homes = Home::paginate(5);

        return view('admin.content.index', compact('homes'));
    }

    // ================== HOME ==================
    public function storeContent(Request $request)
    {
        $request->validate([
            'title_id' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_id' => 'required|string',
            'description_en' => 'required|string',
        ]);

        Home::create($request->only(['title_id', 'title_en', 'description_id', 'description_en']));

        return redirect()->back()->with('success', 'Text created successfully!');
    }

    public function updateContent(Request $request, $id)
    {
        $request->validate([
            'title_id' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_id' => 'required|string',
            'description_en' => 'required|string',
        ]);

        $home = Home::findOrFail($id);
        $home->update($request->only(['title_id', 'title_en', 'description_id', 'description_en']));

        return redirect()->back()->with('success', 'Text updated successfully!');
    }
}
