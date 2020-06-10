<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Feedback\FeedbackInterface as Feedback;
use App\Tag;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;

class ContactController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::active()->paginate();

        return View::make('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Feedback $feedback)
    {
        $newContact = Contact::create($this->validateRequest());

        $newContact->addTags($request->get('tag_list'));

        $feedback->success('The contact has been created');

        return redirect(route('contacts.edit', $newContact->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //TODO: redirect to contact list for now
        return redirect('contacts');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        return View::make('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact, Feedback $feedback)
    {
        $contact->update($this->validateRequest());

        $contact->addTags($request->get('tag_list'));

        $feedback->success('The contact has been updated');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact, Feedback $feedback)
    {
        $contact->delete();

        $feedback->success('The contact has been deleted');

        return redirect('contacts');
    }

    protected function validateRequest()
    {
        return request()->validate([
            'name'      => 'required|min:3',
            'active'    => 'bool'
        ]);
    }
}
