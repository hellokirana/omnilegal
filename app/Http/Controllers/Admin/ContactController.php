<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\DataTables\ContactDataTable;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index(ContactDataTable $dataTable)
    {
        return $dataTable->render('admin.inbox.index');
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);

        return view('admin.inbox.show', compact('contact'));
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.inbox.index')->with('success', 'Pesan berhasil dihapus');
    }
}
