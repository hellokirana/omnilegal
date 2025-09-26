<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
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
        $contact = Contact::findOrFail($id);

        return view('admin.career.show', compact('contact'));
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.career.index')->with('success', 'Pesan berhasil dihapus');
    }
}
