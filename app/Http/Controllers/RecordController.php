<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Record;
use App\Tag;
use Illuminate\Http\Request;
use App\Feedback\FeedbackInterface as Feedback;

class RecordController extends Controller
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
        $records = Record::all();

        return view('records.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $prefilledContact = $request->get('prefilledContact');
        $contacts = Contact::all();
        $record = new Record();

        return view('records.create', compact('record', 'contacts', 'prefilledContact'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Feedback $feedback)
    {
        $record = Record::create($this->validateRequest());

        $record->addTags($request->get('tag_list'));

        $feedback->success('The record has been created');

        return redirect(route('contacts.edit', $record->contact->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Record $record)
    {
        //TODO:
        return redirect(route('contacts.edit', $record->contact->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function edit(Record $record)
    {
        $contacts = Contact::all();

        return view('records.edit', compact('record', 'contacts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Record $record, Feedback $feedback)
    {
        $record->update($this->validateRequest());

        $record->addTags($request->get('tag_list'));

        $feedback->success('The record has been updated');

        return redirect(route('contacts.edit', $record->contact->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record, Feedback $feedback)
    {
        $contactId = $record->contact->id;
        $record->delete();

        $feedback->success('The record has been deleted');

        return redirect(route('contacts.edit', $contactId));
    }

    protected function validateRequest()
    {
        return request()->validate([
            'title' => 'required',
            'description' => '',
            'contact_id' => 'required',
        ]);
    }
}
