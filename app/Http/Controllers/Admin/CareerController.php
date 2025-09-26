<?php

namespace App\Http\Controllers\Admin;

use App\Models\Career;
use Illuminate\Http\Request;
use App\DataTables\CareerDataTable;
use App\Http\Controllers\Controller;
class CareerController extends Controller
{
    public function index(CareerDataTable $dataTable)
    {
        return $dataTable->render('admin.career.index');
    }

    public function show($id)
    {
        $career = Career::findOrFail($id);

        return view('admin.career.show', compact('career'));
    }

    public function destroy($id)
    {
        $career = Career::findOrFail($id);
        $career->delete();

        return redirect()->route('admin.career.index')->with('success', 'Pesan berhasil dihapus');
    }
}
