<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
class AjaxContactController extends Controller
{
    //
    public function index()
    {
        return view('ajax-contact-form');  // validate bang ajax 
    }
    public function store(Request $request)
    {
        $contact = new Contact;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->description = $request->description;
        $contact->save();

        return response()->json(['success' => true]);
    }
}
