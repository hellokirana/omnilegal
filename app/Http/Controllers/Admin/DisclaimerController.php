<?php

namespace App\Http\Controllers\Admin;

use App\Models\Disclaimer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\DisclaimerDataTable;
use Illuminate\Support\Facades\Session;

class DisclaimerController extends Controller
{
    // Tampilkan semua disclaimer
    public function index(DisclaimerDataTable $dataTable)
    {
        return $dataTable->render('admin.disclaimer.index');
    }

    // Form tambah disclaimer
    public function create()
    {
        return view('admin.disclaimer.create');
    }

    // Simpan disclaimer baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description_id' => 'nullable|string',
            'description_en' => 'nullable|string',
        ]);

        $validated['id'] = (string) Str::uuid();

        Disclaimer::create($validated);

        Session::flash('success', 'Disclaimer berhasil disimpan');
        return redirect()->route('admin.disclaimer.index');
    }

    // Form edit disclaimer
    public function edit($id)
    {
        $disclaimer = Disclaimer::findOrFail($id);
        return view('admin.disclaimer.edit', compact('disclaimer'));
    }

    // Update disclaimer
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'description_id' => 'nullable|string',
            'description_en' => 'nullable|string',
        ]);

        $disclaimer = Disclaimer::findOrFail($id);

        $disclaimer->update($validated);

        Session::flash('success', 'Disclaimer berhasil diupdate');
        return redirect()->route('admin.disclaimer.index');
    }

    // Hapus disclaimer
    public function destroy($id)
    {
        $disclaimer = Disclaimer::findOrFail($id);
        $disclaimer->delete();

        return response()->json(['success' => 'Disclaimer berhasil dihapus']);
    }
}
