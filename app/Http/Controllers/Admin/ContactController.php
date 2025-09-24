<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\DataTables\ContactDataTable;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    // Tampilkan semua pesan
    public function index(ContactDataTable $dataTable)
    {
        return $dataTable->render('admin.inbox.index');
    }

    // Tampilkan detail pesan
    public function show($id)
    {
        $contact = Contact::findOrFail($id);

        // Bisa ditambahkan fitur mark as read
        $contact->update(['status' => 'read']);

        return view('admin.inbox.show', compact('contact'));
    }

    // Hapus pesan
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('inbox.index')->with('success', 'Pesan berhasil dihapus');
    }
}
