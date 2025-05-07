<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller{
public function create()
{
    return view('admin.contacts.index');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'message' => 'required|string',
    ]);

    Contact::create($request->all());

    return redirect()->back()->with('success', 'Message sent successfully!');
}

public function index()
{
    $contacts = Contact::latest()->paginate(10);
    return view('admin.contacts.index', compact('contacts'));
}

public function show(Contact $contact)
{
    return view('admin.contacts.show', compact('contact'));
}

public function edit(Contact $contact)
{
    return view('admin.contacts.edit', compact('contact'));
}

public function update(Request $request, Contact $contact)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'message' => 'required|string',
    ]);

    $contact->update($request->all());
    return redirect()->route('contacts.index')->with('success', 'Contact updated.');
}

public function destroy(Contact $contact)
{
    $contact->delete();
    return redirect()->route('contacts.index')->with('success', 'Contact deleted.');
}
}