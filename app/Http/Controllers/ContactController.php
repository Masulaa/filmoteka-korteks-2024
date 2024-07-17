<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Show the contact form.
     *
     * @return \Illuminate\View\View
     */
    public function show(): \Illuminate\View\View
    {
        return view('contact.contact_form');
    }

    /**
     * Submit the contact form.
     *
     * @param ContactRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(ContactRequest $request): \Illuminate\Http\RedirectResponse
    {
        Mail::to('my@mail.com')->send(new ContactMail($request->name, $request->email, $request->content));

        return redirect()->route('home');
    }
}