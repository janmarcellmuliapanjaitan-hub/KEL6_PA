<?php
// app/Http/Controllers/Guest/ContactController.php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of contacts for guest.
     */
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->get();
        return view('guest.contacts.index', compact('contacts'));
    }
}