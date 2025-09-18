<?php

namespace App\Http\Controllers\Admin;

use App\Models\Home;
use App\Models\Stat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatController extends Controller
{
    public function index()
    {
        $stats = Stat::paginate(5);

        return view('admin.stat.index', compact('stats'));
    }

    public function storeStat(Request $request)
    {
        $request->validate([
            'label_id' => 'required|string|max:255',
            'label_en' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['label_id', 'label_en', 'value', 'status']);

        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->storeAs('stats', $filename, 'public');
            $data['image'] = $filename;
        }

        Stat::create($data);

        return redirect()->back()->with('success', 'Stat added successfully!');
    }

    public function updateStat(Request $request, $id)
    {
        $request->validate([
            'label_id' => 'required|string|max:255',
            'label_en' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $stat = Stat::findOrFail($id);
        $data = $request->only(['label_id', 'label_en', 'value', 'status']);

        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->storeAs('stats', $filename, 'public');
            $data['image'] = $filename;
        }

        $stat->update($data);

        return redirect()->back()->with('success', 'Stat updated successfully!');
    }

    public function deleteStat($id)
    {
        $stat = Stat::findOrFail($id);

        $stat->delete();

        return redirect()->back()->with('success', 'Stat deleted successfully!');
    }

}
