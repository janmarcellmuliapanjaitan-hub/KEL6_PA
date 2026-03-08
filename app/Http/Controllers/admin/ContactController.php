<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->get();
        return view('admin.contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('admin.contacts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'no_telepon'=>'required',
            'alamat'=>'required',
            'jadwal'=>'required'
        ]);

        Contact::create($request->all());
        return redirect()->route('admin.contacts.index')->with('success','Kontak berhasil ditambahkan');
    }

    public function edit(Contact $contact)
    {
        return view('admin.contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'email'=>'required|email',
            'no_telepon'=>'required',
            'alamat'=>'required',
            'jadwal'=>'required'
        ]);

        $contact->update($request->all());
        return redirect()->route('admin.contacts.index')->with('success','Kontak berhasil diupdate');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')->with('success','Kontak berhasil dihapus');
    }
}